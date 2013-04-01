<?php

class Category extends Model
{
    public function __construct()
    {
        $this->table = 'categories';

        $this->validate = array(
            'name' => array(
                'regex' => array(
                    'regex'   => '([a-zA-Z0-9\-\s]+)',
                    'message' => 'Nom de la catégorie invlide (les caractères spéciaux ne sont pas autorisés).',
                ),
                'unique' => array(
                    'message' => 'Nom de la catégorie déjà utilisée.',
                ),
            ),
            'description' => array(
                'notEmpty' => array(
                    'message' => 'Description de la catégorie obligatoire.',
                ),
            ),
            'slug' => array(
                'regex' => array(
                    'regex'   => '([a-z0-9\-]*)',
                    'message' => 'URL de la catégorie invalide (chiffres - minuscules - tiret).',
                ),
                'unique' => array(
                    'message' => 'Cette URL est déjà utilisée pour une autre catégorie.',
                ),
            ),
        );

        parent::__construct();
    }
}
