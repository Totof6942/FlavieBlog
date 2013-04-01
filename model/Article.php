<?php

class Article extends Model
{
    public function __construct()
    {
        $this->validate = array(
            'title' => array(
                'notEmpty' => array(
                    'message' => 'Vous devez préciser un titre.',
                ),
            ),
            'slug' => array(
                'regex' => array(
                    'regex'   => '([a-z0-9\-]*)',
                    'message' => 'L\'url n\'est pas valide.',
                ),
            ),
            'category_id' => array(
                'regex' => array(
                    'regex'   => '([0-9]+)',
                    'message' => 'Catégorie invalide',
                ),
            ),
            'content' => array(
                'notEmpty' => array(
                    'message' => 'Vous devez écrire un contenu pour votre articles.',
                   ),
            ),
        );

        parent::__construct();
    }
}
