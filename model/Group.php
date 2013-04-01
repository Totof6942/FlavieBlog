<?php

class Group extends Model
{
    public function __construct()
    {
        $this->validate = array(
            'name' => array(
                'regex' => array(
                    'regex'   => '([a-zA-Z0-9\-\s]+)',
                    'message' => 'Nom du groupe invlide (les caractères spéciaux ne sont pas autorisés).',
                ),
                'unique' => array(
                    'message' => 'Nom de groupe déjà utilisé.',
                ),
            ),
            'level' => array(
                'regex' => array(
                    'regex'   => '([0-9]+)',
                    'message' => 'Le niveau n\'est pas valide',
                ),
            ),
        );

        parent::__construct();
    }
}
