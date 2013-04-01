<?php

class Dispatcher
{
    /**
     * @var Request
     */
    private $request;

    /**
      * Fonction principale du dispatcher
      * Charge le controller en fonction du routing
      */
    public function __construct()
    {
        $this->request = new Request();

        Router::parse($this->request->getUrl(), $this->request);

        $controller = $this->loadController();

        $action = $this->request->getAction();

        if ($this->request->getPrefix()) {
            $action = $this->request->getPrefix().'_'.$action;
        }

        if (!in_array($action, array_diff(get_class_methods($controller), get_class_methods('Controller')))) {
            $this->error('La page que vous demandez n\'existe pas ou n\'existe plus.');
        }

        call_user_func_array(array($controller, $action), $this->request->getParams());

        $controller->render($action);
    }

    /**
      * Permet de générer une page d'erreur en cas de problème au niveau du routing (page inexistante)
      *
      * @param string $message Message d'erreur à afficher
      */
    public function error($message)
    {
        $controller = new Controller($this->request);
        $controller->session = new Session();
        $controller->e404($message);
    }

    /**
      * Permet de charger le controleur en fonction de la requête utilisateur
      *
      * @return object Retourne une instance du controleur demandé
      */
    public function loadController()
    {
        $name = ucfirst($this->request->getController()).'Controller';
        $file = ROOT.DS.'controller'.DS.$name.'.php';

        if (!file_exists($file)) {
            $this->error('La page que vous demandez n\'existe pas ou n\'existe plus.');
        }

        require $file;

        $controller = new $name($this->request);

        return $controller;
    }
}
