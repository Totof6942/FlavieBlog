<?php

class ArticlesController extends Controller
{
    /**
     * @var int
     */
    private $articlesPage = 10;

    /**
     * Affiche 10 articles par page (page principale du blog)
     */
    public function index()
    {
        $this->loadModel('Article');

        $conditions = array('online' => 1);
        $d['articles']  = $this->Article->find(array(
            'fields'     => 'articles.id as id, articles.slug as slug, articles.title as title, articles.content as content, DATE_FORMAT(articles.created, \'%d/%m/%Y\') as created, categories.id as category_id, categories.name as category_name, categories.slug as category_slug, users.id as user_id, users.login as user_login, users.name as user_name ',
            'join'       => array(
                'categories' => 'categories.id = articles.category_id',
                'users'      => 'users.id = articles.user_id',
            ),
            'conditions' => $conditions,
            'order'      => array(
                'sc'    => 'DESC',
                'field' => 'articles.id',
            ),
            'limit'      => ($this->articlesPage * ($this->request->getPage() - 1)).','.$this->articlesPage
        ));

        $d['total'] = $this->Article->findCount($conditions);
        $d['nbPages'] = ceil($d['total'] / $this->articlesPage);

        if (1 == $this->request->getPage()) {
            $d['title'] = 'Derniers articles';
        }

        $this->set($d);
    }

    /**
     * Permet d'afficher les articles d'une catégorie
     *
     * @param string $slug Slug de la catégorie visée
     */
    public function category($slug)
    {
        $this->loadModel('Category');

        $category = $this->Category->findFirst(array(
            'conditions' => array('slug' => $slug),
            'fields'     => 'id, name'
        ));

        if (empty($category)) {
            $this->e404('Cette catégorie n\'existe pas, ou n\'existe plus.');
        }

        $this->loadModel('Article');

        $conditions = array(
            'online'      => 1,
            'category_id' => $category->id,
        );

        $d['articles'] = $this->Article->find(array(
            'conditions' => $conditions,
            'fields'     => 'articles.id as id, articles.slug as slug, articles.title as title, articles.content as content, DATE_FORMAT(articles.created, \'%d/%m/%Y\') as created, categories.id as category_id, categories.name as category_name, categories.slug as category_slug, users.id as user_id, users.login as user_login, users.name as user_name ',
            'join'       => array(
                'categories' => 'categories.id = articles.category_id',
                'users'      => 'users.id = articles.user_id',
            ),
            'order'      => array(
                'sc'    => 'DESC',
                'field' => 'articles.id',
            ),
            'limit'      => ($this->articlesPage * ($this->request->getPage() - 1)).','.$this->articlesPage
        ));

        $d['total'] = $this->Article->findCount($conditions);
        $d['nbPages'] = ceil($d['total'] / $this->articlesPage);
        $d['title'] = $category->name;

        $this->set($d);
        $this->render('index');
    }

    /**
     * Permet d'afficher les articles d'un utilisateur
     *
     * @param string $login Login de l'utilisateur visé
     */
    public function user($login)
    {
        $this->loadModel('User');

        $user = $this->User->findFirst(array(
            'conditions' => array('login' => $login),
            'fields'     => 'id, name'
        ));

        if (empty($user)) {
            $this->e404('Cet utilisateur n\'existe pas ou n\'existe plus.');
        }

        $this->loadModel('Article');

        $conditions = array('online' => 1, 'user_id' => $user->id);

        $d['articles'] = $this->Article->find(array(
            'conditions' => $conditions,
            'fields'     => 'articles.id as id, articles.slug as slug, articles.title as title, articles.content as content, DATE_FORMAT(articles.created, \'%d/%m/%Y\') as created, categories.id as category_id, categories.name as category_name, categories.slug as category_slug, users.id as user_id, users.login as user_login, users.name as user_name ',
            'join'       => array(
                'categories' => 'categories.id = articles.category_id',
                'users'      => 'users.id = articles.user_id',
            ),
            'order' => array(
                'sc'    => 'DESC',
                'field' => 'articles.id',
            ),
            'limit' => ($this->articlesPage * ($this->request->getPage() - 1)).','.$this->articlesPage
        ));

        $d['total'] = $this->Article->findCount($conditions);
        $d['nbPages'] = ceil($d['total'] / $this->articlesPage);
        $d['title'] = $user->name;

        $this->set($d);
        $this->render('index');
    }

    /**
     * Affiche l'article dont l'id est passé en paramètre
     *
     * @param int    $id
     * @param string $slug
     */
    public function view($id, $slug)
    {
        $this->loadModel('Article');

        $d['article']  = $this->Article->findFirst(array(
            'fields'     => 'articles.id as id, articles.slug as slug, articles.title as title, articles.content as content, DATE_FORMAT(articles.created, \'%d/%m/%Y\') as created, categories.id as category_id, categories.name as category_name, categories.slug as category_slug, users.id as user_id, users.name as user_name ',
            'join'       => array(
                'categories' => 'categories.id = articles.category_id',
                'users'      => 'users.id = articles.user_id',
            ),
            'conditions' => array(
                'articles.id'     => $id,
                'articles.online' => 1,
            )
        ));

        if (empty($d['article'])) {
            $this->e404('Cet article n\'existe pas ou n\'existe plus.');
        }

        if ($slug != $d['article']->slug) {
            $this->redirect("articles/view/id:$id/slug:".$d['article']->slug, 301);
        }

        $this->set($d);
    }

    /**
     * Affiche la liste des articles dans l'administration des articles
     */
    public function author_index()
    {
        $conditions = null;

        if (isset($_GET['login']) && !empty($_GET['login'])) {
            $login = $_GET['login'];

            $this->loadModel('User');

            $user = $this->User->findFirst(array('conditions' => array('login' => $login)));

            if (!empty($user)) {
                $conditions = array('user_id' => $user->id);
            }
        }

        $this->loadModel('Article');

        $d['articles']   = $this->Article->find(array(
            'fields'     => 'articles.id as id, articles.title as title, DATE_FORMAT(articles.created, \'%d/%m/%Y\') as created, DATE_FORMAT(articles.modified, \'%d/%m/%Y\') as modified, articles.online online, categories.name as category, users.id as user_id, users.name as user_name',
            'join'       => array(
                'categories' => 'categories.id = articles.category_id',
                'users'      => 'users.id = articles.user_id',
            ),
            'conditions' => $conditions,
            'order'      => array(
                'sc'    => 'DESC',
                'field' => 'articles.id',
            ),
            'limit'      => ($this->articlesPage * ($this->request->getPage() - 1)).','.$this->articlesPage
        ));

        $d['total'] = $this->Article->findCount($conditions);
        $d['publied'] =  $this->Article->findCount(array('online' => 1));
        $d['nbPages'] = ceil($d['total'] / $this->articlesPage);

        $this->set($d);
    }

    /**
     * Permet de supprimer un article
     *
     * @param int $id Id de l'article à supprimer
     */
    public function author_delete($id)
    {
        $this->loadModel('Article');
        $this->Article->delete($id);

        $this->session->setFlash('L\'article a bien été supprimé.');

        $this->redirect('author/articles/index');
    }

    /**
     * Permet d'éditer (ou d'ajouter) un article
     *
     * @param int $id Id de l'article à éditer
     */
    public function author_edit($id = null)
    {
        $this->loadModel('Article');

        $d['id'] = null;

        if ($this->request->getData()) {
            $data = $this->request->getData();

            if ($this->Article->validates($data)) {
                if ($data->id == null) {
                    $data->created = date('Y-m-d h:i:s');
                    $data->user_id = $this->session->user('id');
                } else {
                    $data->modified = date('Y-m-d h:i:s');
                }

                if (empty($data->slug)) {
                    $data->slug = normalize($data->title);
                } else {
                    $data->slug = normalize($data->slug);
                }

                $this->Article->save($data);

                if ($data->id == null) {
                    $this->session->setFlash('L\'article a été ajouté avec succès.');
                } else {
                    $this->session->setFlash('L\'article a bien été modifié.');
                }

                $this->redirect('author/articles/index');
            } else {
                $this->session->setFlash('Merci de corriger vos informations.', 'error');
            }
        } else {
            if ($id) {
                $this->request->setData($this->Article->findFirst(array('conditions' => array('id' => $id))));

                $d['id'] = $id;
            }
        }

        $this->loadModel('Category');

        $d['categories'] = $this->Category->findList(array('order' => array('sc' => 'ASC', 'field' => 'name')));

        $this->set($d);
    }
}
