<?php

class GroupsController extends Controller
{
    /**
     * Liste les différents groupes d'utilisateurs sur la page d'accueil des groupes de l'administration
     */
    public function admin_index()
    {
        $this->loadModel('Group');

        $conditions = null;

        $select = 'SELECT COUNT(id) FROM users WHERE groups.id = group_id';
        $d['groupes']    = $this->Group->find(array(
            'fields'     => 'id, name, level, ('.$select.') as nbUsers',
            'conditions' => $conditions,
            'order'      => array('sc' => 'DESC', 'field' => 'level')
        ));

        $d['total'] = $this->Group->findCount($conditions);

        $this->set($d);
    }

    /**
     * Permet de supprimer un groupe d'utilisateur (à condition qu'il n'y ai aucun utilisateur dans ce groupe)
     *
     * @param int $id Id du groupe à supprimer
     */
    public function admin_delete($id)
    {
        $this->loadModel('User');
        $count = $this->User->findCount(array('group_id' => $id));

        if ($count > 0) {
            $this->session->setFlash('Le groupe ne peut pas être supprimé car il y a des utilisateurs assignés à ce groupe.');
        } else {
            $this->loadModel('Group');
            $this->Group->delete($id);
            $this->session->setFlash('Le groupe a bien été supprimé.');
        }

        $this->redirect('admin/groups/index');
    }

    /**
     * Permet d'éditer ou d'ajouter un groupe d'utilisateur
     *
     * @param int $id Id de groupe dans le cas d'une édition
     */
    public function admin_edit($id = null)
    {
        $this->loadModel('Group');

        $d['id'] = null;

        if ($this->request->getData()) {
            $data = $this->request->getData();

            if ($this->Group->validates($data)) {
                $this->Group->save($data);

                if ($data->id == null) {
                    $this->session->setFlash('Le groupe a bien été ajouté.');
                } else {
                    $this->session->setFlash('Le groupe a bien été modifié.');
                }

                $this->redirect('admin/groups/index');
            } else {
                $this->session->setFlash('Merci de corriger vos informations. ', 'error');
            }
        } else {
            if ($id) {
                $this->request->setData($this->Group->findFirst(array('conditions' => array('id' => $id))));
                $d['id'] = $id;
            }
        }

        $d['levels'] = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10);

        $this->set($d);
    }
}
