<?php

class MenusController extends Controller
{
    /**
     * @var array
     */
    private $levels = array(5 => 'moderator', 7 => 'author', 9 => 'admin');

    /**
     * Permet de créer la sidebare de l'administration en fonction du niveau d'accès de l'utilisateur
     *
     * @param string $controller Controleur
     *
     * @return array Retourne un tableau contenant les informations nécessaire à la création du menu
     */
    public function getSidebare($controller)
    {
        $this->loadModel('Menu');

        $menus = $this->Menu->find(array(
            'fields'     => 'name, controller, action, level',
            'conditions' => array(
                'level <'    => $this->session->user('level'),
                'type'       => 'side',
                'controller' => $controller
            ),
            'order'      => array(
                'sc'    => 'ASC',
                'field' => 'ordre',
            )
        ));

        $result = array();

        foreach ($menus as $key => $value) {
            $result[$key] = array(
                'name' => $value->name,
                'slug' => $value->controller.'_'.$value->action,
                'url'  => $this->levels[$value->level].DS.$value->controller.DS.$value->action
            );
        }

        return $result;
    }

    /**
     * Permet de créer le menu de l'administration en fonction du niveau d'accès de l'utilisateur
     *
     * @return array Retourne un tableau contenant les informations nécessaire à la création du menu
     */
    public function getMenu()
    {
        $this->loadModel('Menu');

        $menus = $this->Menu->find(array(
            'fields'     => 'name, controller, action, level',
            'conditions' => array(
                'level <' => $this->session->user('level'),
                'type'    => 'nav',
            ),
            'order'      => array(
                'sc'    => 'ASC',
                'field' => 'ordre',
            )
        ));

        $result = array();

        foreach ($menus as $key => $value) {
            $result[$key] = array(
                'name' => $value->name,
                'slug' => $value->controller,
                'url'  => $this->levels[$value->level].DS.$value->controller.DS.$value->action
            );
        }

        return $result;
    }
}
