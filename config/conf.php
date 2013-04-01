<?php
    
class Conf 
{    
    // Définition du débug (0 pour le désactiver)
    public static $debug = 0;
    
    public static $databases = array(
        'default' => array(
            'host'      => 'localhost',
            'database'  => 'flavie',
            'login'     => 'root',
            'password'  => ''
        ),
        'online' => array(
            'host'      => '',
            'database'  => '',
            'login'     => '',
            'password'  => ''
        )
    );
}

// Définition des routes
Router::prefix('cc-admin', 'admin');
Router::prefix('cc-author', 'author');
Router::prefix('cc-moderator', 'moderator');

Router::connect('/', 'articles/index');
Router::connect('blog/:slug-:id', 'articles/view/id:([0-9]+)/slug:([a-z0-9\-]+)');
Router::connect('blog/categorie/:slug','articles/category/slug:([a-z0-9\-]+)');
Router::connect('blog/auteur/:login', 'articles/user/login:([a-zA-Z0-9]+)');
Router::connect('membre/:login', 'users/view/login:([a-zA-Z0-9]+)');
