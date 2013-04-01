<?php

class CategoriesController extends Controller
{
    /**
      * Permet d'obtenir la liste des catégories pour la sidebare du frontoffice
      *
      * @return array Retourne la liste des catégories
      */
    public function getCategories()
    {
        $this->loadModel('Category');

        $select = 'SELECT COUNT(id) FROM articles WHERE categories.id = category_id AND online = 1';
        $categories = $this->Category->find(array(
            'fields'     => 'id, name, slug, ('.$select.') AS nbArticles',
            'conditions' => array('('.$select.') >' => '1'),
            'order'      => array('sc' => 'ASC', 'field' => 'name')
        ));

        return $categories;
    }

    /**
      * Affiche la liste des catégories dans l'administration des catégories
      */
    public function author_index()
    {
        $this->loadModel('Category');

        $conditions = null;

        $d['categories'] = $this->Category->find(array(
            'fields'     => 'id, name, description, (SELECT COUNT(id) FROM articles WHERE categories.id = category_id) AS nbArticles',
            'conditions' => $conditions
        ));

        $this->set($d);
    }

    /**
      * Supprime une catégorie à condition qu'elle ne contienne aucun article
      *
      * @param int $id Id de la catégorie à supprimer
      */
    public function author_delete($id)
    {
        $this->loadModel('Article');

        $count = $this->Article->findCount(array('category_id' => $id));

        if ($count > 0) {
            $this->session->setFlash('La catégorie ne peut pas être supprimée car elle contient des articles.', 'error');
        } else {
            $this->loadModel('Category');
            $this->Category->delete($id);

            $this->session->setFlash('La catégorie a bien été supprimé.');
        }

        $this->redirect('author/categories/index');
    }

    /**
      * Permet de modifier ou de créer une catégorie d'articles
      *
      * @param int $id Id de la catégorie dans le cas d'une édition
      */
    public function author_edit($id = null)
    {
        $this->loadModel('Category');

        $d['id'] = null;

        if ($this->request->getData()) {
            $data = $this->request->getData();

            if ($this->Category->validates($data)) {

                if (empty($data->slug)) {
                    $data->slug = normalize($data->name);
                } else {
                    $data->slug = normalize($data->slug);
                }

                $this->Category->save($data);

                if ($data->id == null) {
                    $this->session->setFlash('La catégorie a bien été ajoutée.');
                } else {
                    $this->session->setFlash('La catégorie a bien été modifié.');
                }

                $this->redirect('author/categories/index');
            } else {
                $this->session->setFlash('Merci de corriger vos informations. ', 'error');
            }
        } else {
            if ($id) {
                $this->request->setData($this->Category->findFirst(array('conditions' => array('id' => $id))));
                $d['id'] = $id;
            }
        }

        $this->set($d);
    }
}
