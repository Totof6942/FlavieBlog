<?php

class Router
{
    /**
     * @var array
     */
    private static $routes = array();

    /**
     * @var array
     */
    private static $prefixes = array();

    /**
     * Ajoute un prefix au Routing
     *
     * @param string $url    URL visée par la modification
     * @param string $prefix Prefix à utiliser
     */
    public static function prefix($url, $prefix)
    {
        self::$prefixes[$url] = $prefix;
    }

    /**
      * Permet de parser une url
      *
      * @param string  $url     Url à parser
      * @param Request $request Eléments de la requète
      *
      * @return boolean Retourne true
      */
    public static function parse($url, $request)
    {
        $url = trim($url, '/');

        if (empty($url)) {
            $url = Router::$routes[0]['url'];
        } else {
            $match = false;
            foreach (Router::$routes as $v) {
                if (!$match && preg_match($v['redirreg'], $url, $match)) {
                    $url = $v['origin'];
                    foreach ($match as $k => $v) {
                        $url = str_replace(':'.$k.':', $v, $url);
                    }
                    $match = true;
                }
            }
        }

        $params = explode('/', $url);

        if (in_array($params[0], array_keys(self::$prefixes))) {
            $request->setPrefix(self::$prefixes[$params[0]]);
            array_shift($params);
        }

        $request->setController($params[0]);
        $request->setAction(isset($params[1]) ? $params[1] : 'index');

        foreach (self::$prefixes as $k => $v) {
            if (0 === strpos($request->getAction(), $v.'_')) {
                $request->setPrefix($v);
                $request->setAction(str_replace($v.'_', '', $request->getAction()));
            }
        }

        $request->setParams(array_slice($params, 2));

        return true;
    }

    /**
      * Permet de connecter une url à une action particulière
      *
      * @param string $redir URL renvoyée au client
      * @param string $url   URL réelle
      */
    public static function connect($redir, $url)
    {
        $r = array();
        $r['params'] = array();
        $r['url'] = $url;

        $r['originreg'] = preg_replace('/([a-z0-9]+):([^\/]+)/', '${1}:(?P<${1}>${2})', $url);
        $r['originreg'] = str_replace('/*', '(?P<args>/?.*)', $r['originreg']);
        $r['originreg'] = '/^'.str_replace('/', '\/', $r['originreg']).'$/';
        $r['origin'] = preg_replace('/([a-z0-9]+):([^\/]+)/', ':${1}:', $url);
        $r['origin'] = str_replace('/*', ':args:', $r['origin']);

        $params = explode('/',$url);

        foreach ($params as $k=>$v) {
            if (strpos($v,':')) {
                $p = explode(':', $v);
                $r['params'][$p[0]] = $p[1];
            }
        }

        $r['redirreg'] = $redir;
        $r['redirreg'] = str_replace('/*', '(?P<args>/?.*)', $r['redirreg']);

        foreach ($r['params'] as $k => $v) {
            $r['redirreg'] = str_replace(":$k", "(?P<$k>$v)", $r['redirreg']);
        }

        $r['redirreg'] = '/^'.str_replace('/', '\/', $r['redirreg']).'$/';

        $r['redir'] = preg_replace('/:([a-z0-9]+)/', ':${1}:', $redir);
        $r['redir'] = str_replace('/*', ':args:', $r['redir']);

        self::$routes[] = $r;
    }

    /**
      * Permet de générer une url client à partir d'une url originale
      *
      * @param string $url URL originale
      *
      * @return string Retourne l'URL au format client
      */
    public static function url($url = '')
    {
        trim($url, '/');

        foreach (self::$routes as $v) {
            if (preg_match($v['originreg'], $url, $match)) {
                $url = $v['redir'];

                foreach ($match as $k => $w) {
                    $url = str_replace(":$k:", $w, $url);
                }
            }
        }

        foreach (self::$prefixes as $k => $v) {
            if (strpos($url, $v) === 0) {
                $url = str_replace($v, $k, $url);
            }
        }

        return BASE_URL.'/'.$url;
    }

    /**
      * Permet de construire une url à partir du dossier root (utiles pour CSS / JS / IMG)
      *
      * @param string $url URL visée
      *
      * @return string
      */
    public static function webroot($url)
    {
        trim($url, '/');

        return BASE_URL.'/'.$url;
    }
}
