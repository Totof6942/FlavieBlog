<?php

class CommentsController extends Controller
{
    public function moderator_index()
    {
        $this->loadModel('Comment');

        $commentsPage = 20;

        $d['comments'] = $this->Comment->find(array(
            'fields' => 'comments.id as id, DATE_FORMAT(comments.created, \'%d/%m/%Y\') as created, articles.id as article_id, articles.slug as article_slug, articles.title as article_title, users.login as user_login, users.name as user_name',
            'join'   => array(
                'articles' => 'articles.id = comments.article_id',
                'users'    => 'users.id = comments.user_id',
            ),
            'order'  => array(
                'sc'    => 'DESC',
                'field' => 'comments.created',
            ),
            'limit'  => ($commentsPage * ($this->request->getPage() - 1)).','.$commentsPage
        ));

        $d['total'] = $this->Comment->findCount(null);

        // On calcul le nombre de pages
        $d['nbPages'] = ceil($d['total'] / $commentsPage);

        // On envoi le tout à la vue
        $this->set($d);
    }

    public function moderator_delete($id)
    {
        $this->loadModel('Comment');
        $this->Comment->delete($id);
        $this->session->setFlash('Le commentaire a bien été supprimé.');
        $this->redirect('moderator/comments/index');
    }
}
