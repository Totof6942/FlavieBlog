<?php

class Session
{
    public function __construct()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Permet de définir une notification à afficher
     *
     * @param string $message Message que doit afficher la notification
     * @param string $type    Type de la notification (success, error, attention, information)
     */
    public function setFlash($message, $type = 'success')
    {
        $_SESSION['flash'] = array(
            'message' => $message,
            'type'    => $type
        );
    }

    /**
     * Permet d'afficher des notifications sur les pages
     *
     * @return string Retourne la notification à afficher
     */
    public function flash()
    {
        if (isset($_SESSION['flash']['message'])) {

            $html = '<div class="alert alert-';
            $html .= $_SESSION['flash']['type'];
            $html .= '">';
            $html .= '<a class="close" data-dismiss="alert">×</a>';
            $html .= $_SESSION['flash']['message'];
            $html .= '</div>';

            $_SESSION['flash'] = array();

            return $html;
        }
    }

    /**
     * Permet de créer une nouvelle variable de session
     *
     * @param string $key   Nom de la variable de session
     * @param string $value Valeur de la variable de session
     */
    public function write($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Permet de lire une variable de session
     *
     * @param string|null $key Nom de la variable de session à lire (null si on veut lire toutes les variables de session)
     *
     * @return string|boolean|array Retourne la variable de session demandée, ou false si elle n'existe pas
     */
    public function read($key = null)
    {
        if ($key) {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }

            return false;
        }

        return $_SESSION;
    }

    /**
     * Permet de tester si un utilisateur est logué
     *
     * @return Retourne true si oui, false si non
     */
    public function isLogged()
    {
        return isset($_SESSION['user']->level);
    }

    /**
     * Permet d'obtenir une inforamtion sur l'utilisateur connecté
     *
     * @param  string        $key Clé de l'information souhaitée
     * @return boolean|array Retourne la l'information souhaitée ou flase si elle n'existe pas
     */
    public function user($key)
    {
        if ($this->read('user')) {
            if (isset($this->read('user')->$key)) {
                return $this->read('user')->$key;
            } else {
                return false;
            }
        }

        return false;
    }
}
