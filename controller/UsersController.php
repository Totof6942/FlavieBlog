<?php

class UsersController extends Controller
{
    public function login()
    {
        if ($this->request->getData()) {
            $data = $this->request->getData();

            $data->password = encrypt($data->password);

            $this->loadModel('User');

            $user = $this->User->findFirst(array(
                'fields'     => 'users.id as id, users.login as login, groups.level as level',
                'join'       => array('groups' => 'groups.id = users.group_id'),
                'conditions' => array('login' => $data->login, 'password' => $data->password
            )));

            if (!empty($user)) {
                if ($user->level < 2) {
                    $this->session->setFlash('Ce compte utilisateur a été bannis, connexion impossible.', 'error');
                } else {
                    $this->session->write('user', $user);
                    $this->session->setFlash('Vous êtes maintenant connecté.');
                }
            } else {
                $this->session->setFlash('Le couple identifiant / mot de passe est incorect.', 'error');
            }

            $this->request->getData()->password = '';
        }

        if ($this->session->isLogged()) {
            $this->redirect('');
        }
    }

    public function logout()
    {
        unset($_SESSION['user']);
        $this->session->setFlash('Vous ête mainenant déconnecté');
        $this->redirect('/');
    }

    public function admin_index()
    {
        $this->loadModel('User');

        $d['users'] = $this->User->find(array(
            'fields' => 'users.id as id, users.login as login, users.name as name, users.email as email, groups.name as group_name',
            'join'   => array('groups' => 'groups.id = users.group_id')
        ));

        $d['total'] = $this->User->findCount(null);

        $this->set($d);
    }

    public function view($login)
    {
        $this->loadModel('User');

        $d['user']  = $this->User->findFirst(array(
            'fields'     => 'users.id as id, users.login as login, users.name as name, users.avatar as avatar, groups.name as group_name',
            'join'       => array('groups' => 'groups.id = users.group_id'),
            'conditions' => array('users.login' => $login)
        ));

        if (empty($d['user'])) {
            $this->e404('Cet utilisateur n\'existe pas ou n\'existe plus.');
        }

        $this->loadModel('Article');
        $d['nbArticles'] = $this->Article->findCount(array(
            'user_id' => $d['user']->id
        ));

        $this->set($d);
    }

    public function admin_delete($id)
    {
        $this->loadModel('User');

        $user = $this->User->findFirst(array(
            'fields'     => 'users.name as name, groups.level as level',
            'join'       => array('groups' => 'groups.id = users.group_id'),
            'conditions' => array('users.id' => $id)
        ));

        if (empty($user)) {
            $this->session->setFlash('L\'utilisateur que vous vous voulez supprimer ne semble pas exister.', 'error');
        } else {
            if ($user->level >= $this->session->user('level')) {
                $this->session->setFlash('Vous ne pouvez pas supprimer un utilisateur plus gradé que vous ou de même rang, Muhahaha !', 'error');
            } else {
                $this->User->delete($id);
                $this->session->setFlash('L\'utilisateur a bien été supprimé.');
            }
        }

        $this->redirect('admin/users/index');
    }

    public function admin_edit($id = null)
    {
        $this->loadModel('User');
        $this->loadModel('Group');
        $d['id'] = null;

        if ($this->request->getData()) {
            $data = $this->request->getData();

            if ($this->User->validates($data)) {

                $level = $this->Group->findFirst(array(
                    'fields'     => 'level',
                    'conditions' => array('id' => $data->group_id)
                ));

                if ($level->level > $this->session->user('level')) {
                    if (empty($data->id)) {
                        $this->session->setFlash('Vous ne pouvez pas créer un utilisateur plus gradé que vous l\'êtes.', 'error');
                    } else {
                        $this->session->setFlash('Vous ne pouvez pas vous mettre dans un groupe de grade plus élevé que le votre', 'error');
                    }
                    $this->redirect('admin/users/index');
                }

                if (!empty($data->password)) {
                    $data->password = encrypt($data->password);
                } else {
                    unset($data->password);
                }

                unset($data->confirmation);

                if (!empty($_FILES['avatar']['name'])) {
                    $dossier =  WEBROOT.DS.'img'.DS.'Avatars'.DS;

                    $retour = Images::uploadImg('avatar', $dossier, strtolower($data->login));

                    if ($retour['errors'] == null) {
                        $data->avatar = $retour['name'];

                        Images::miniature($dossier, $dossier, $retour['name'], 38, 38);
                    } else {
                        $data->avatar = 'no-photo.png';
                    }
                } else {
                    if ($data->id != null) {
                        unset($data->avatar);
                    } else {
                        $data->avatar = 'no-photo.png';
                    }
                }

                $this->User->save($data);

                if (empty($data->id)) {
                    $this->session->setFlash('L\'utilisateur a bien été ajouté.');
                } else {
                    $this->session->setFlash('L\'utilisateur a bien été modifié.');
                }

                $this->redirect('admin/users/index');
            } else {
                $this->session->setFlash('Merci de corriger vos informations. ', 'error');
            }
        } else {
            if ($id) {
                $this->request->setData($this->User->findFirst(array('conditions' => array('id' => $id))));
                $d['id'] = $id;
            }
        }

        if (!empty($this->request->getData()->password)) {
            $this->request->getData()->password = '';
        }

        $d['groups'] = $this->Group->findList(array('order' => array('sc' => 'DESC', 'field' => 'level')));

        $this->set($d);
    }
}
