<?php

class Request
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var boolean|string
     */
    private $prefix = false;

    /**
     * @var boolean|object
     */
    private $data = false;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $params;

    public function __construct()
    {
        $this->url = $this->path_info();

        if (isset($_GET['page'])) {
            if (is_numeric(($_GET['page']))) {
                if ($_GET['page'] > 0) {
                    $this->page = round($_GET['page']);
                }
            }
        }

        if (!empty($_POST)) {
            $this->data = new stdClass();
            foreach ($_POST as $key => $value) {
                $this->data->$key = $value;
            }
        }
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get page
     *
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Get prefix
     *
     * @return boolean|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Get data
     *
     * @return boolean|object
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set data
     *
     * @param object
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    /**
     * Get controller
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Set controller
     *
     * @param string $controller
     */
    public function setController($controller)
    {
        $this->controller = $controller;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set action
     *
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * Get params
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set params
     *
     * @param array $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    public function path_info()
    {
        if (!empty($_SERVER['PATH_INFO'])) {
            return $_SERVER['PATH_INFO'];
        } elseif (isset($_SERVER['REQUEST_URI'])) {
            $uri = str_replace(BASE_URL.'/', '', $_SERVER['REQUEST_URI']);
        } elseif (isset($_SERVER['PHP_SELF']) && isset($_SERVER['SCRIPT_NAME'])) {
            $uri = str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['PHP_SELF']);
        } elseif (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
            $uri = $_SERVER['HTTP_X_REWRITE_URL'];
        } elseif ($var = env('argv')) {
            $uri = $var[0];
        }

        if (strpos($uri, '?') !== false) {
            $uri = parse_url($uri, PHP_URL_PATH);
        }

        if (empty($uri) || $uri == '/' || $uri == '//') {
            return '/';
        }

        return $uri;
    }
}
