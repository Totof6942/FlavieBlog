<?php

class Controller
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var array
     */
    protected $vars = array();

    /**
     * @var string
     */
    protected $layout = 'default';

    /**
     * @var boolean
     */
    protected $rendered = false;

    /**
      * Constructeur
      *
      * @param Request|null $request Objet request de notre application
      */
    public function __construct($request = null)
    {
        $this->session = new Session();
        $this->form = new Form($this);

        if ($request) {
            $this->request = $request;

            require ROOT.DS.'config'.DS.'hook.php';
        }
    }

    /**
     * Get request
     *
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
      * Permet de rendre une vue
      *
      * @param string $view Fichier à rendre (chemin depuis view ou nom de la vue)
      */
    public function render($view)
    {
        if ($this->rendered) {
            return false;
        }

        extract($this->vars);

        if (strpos($view, '/') === 0) {
            $view = ROOT.DS.'view'.$view.'.php';
        } else {
            $view = ROOT.DS.'view'.DS.$this->request->getController().DS.$view.'.php';
        }

        ob_start();
        require($view);
        $content_for_layout = ob_get_clean();
        require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php';
        $this->rendered = true;
    }

    /**
      * Permet de passer une ou plusieurs variable à la vue
      *
      * @param string $key   nom de la variable OU tableau de variables
      * @param string $value Valeur de la variable
      */
    public function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->vars += $key;
        } else {
            $this->vars[$key] = $value;
        }
    }

    /**
      * Permet de charger un model
      *
      * @param string $name Nom du model à charger
      */
    public function loadModel($name)
    {
        if (!isset($this->$name)) {
            $file = ROOT.DS.'model'.DS.$name.'.php';
            require_once($file);
            $this->$name = new $name();

            if (isset($this->form)) {
                $this->$name->form = $this->form;
            }
        }
    }

    /**
      * Permet de gérer les erreurs 404
      *
      * @param string $message Message à afficher
      */
    public function e404($message)
    {
        header('HTTP/1.0 404 Not Found');
        $this->set('message', $message);
        $this->render('/errors/404');
        die();
    }

    /**
      * Permet d'appeler un controleur depuis une vue
      * @param string     $controller Controleur à appeler
      * @param string     $action Action du contoller à appeler
      * @param array|null $params Paramètres éventuels à foutrnir à l'action
      *
      * @return Retourne l'action demandées du controleur demandé
      */
    public function request($controller, $action, $params = null)
    {
        $controller .= 'Controller';
        require_once ROOT.DS.'controller'.DS.$controller.'.php';
        $c = new $controller();

        if (!empty($params)) {
            return $c->$action($params);
        }

        return $c->$action();
    }

    /**
      * Permet la redirection d'une page
      *
      * @param srting   $url  Url de redirection
      * @param int|null $code Code d'erreur éventuel pour les header http
      */
    public function redirect($url, $code = null)
    {
        if (301 == $code) {
            header('HTTP/1.1 301 Moved Permanently');
        }

        header('Location: '.Router::url($url));
        die();
    }
}
