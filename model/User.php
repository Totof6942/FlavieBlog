<?php

class User extends Model
{
    public function __construct()
    {
        $this->validate = array(
            'login' => array(
                'notEmpty' => array(
                    'message' => 'Vous devez préciser le login de l\'utilisateur.',
                ),
                'unique'   => array(
                    'message' => 'Ce login n\'est pas disponible.',
                ),
            ),
            'name' => array(
                'regex'	=> array(
                    'regex'   => '([a-zA-Z0-9\-]+\s[a-zA-Z0-9\-]+)',
                    'message' => 'Le nom et le prénom de l\'utilisateur ne sont pas valide ([a-zA-Z0-9\-]+\s[a-zA-Z0-9\-]+)).',
                ),
            ),
            'email' => array(
                'regex' => array(
                    'regex'   => '([a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4})',
                    'message' => 'L\'adresse email n\'est pas valide.',
                ),
            ),
            'password' => array(
                'regex' => array(
                    'edit'	  => true,
                    'regex'   => '(.{6,})',
                    'message' => 'Le mot de passe doit faire au minimum 6 caractères.',
                ),
            ),
            'confirmation' => array(
                'equal' => array(
                    'field'   => 'password',
                'message' => 'Les mots de passe ne sont pas identiques.',
                ),
            )
        );

        parent::__construct();
    }
}
