<?php

// On défini ici qui à le droit d'accéder à tel prefix
// et quel doit être le layout à adopter
// On check aussi si l'utilisateur est connecté, sinon on le redirige 

if ('admin' === $this->request->getPrefix()) {
    $this->layout = 'admin';

    if (!$this->session->isLogged() || $this->session->user('level') < 9) {
        $this->redirect('users/login'); 
    }
}

if ('author' === $this->request->getPrefix()) {
    $this->layout = 'admin';

    if (!$this->session->isLogged() || $this->session->user('level') < 7) {
        $this->redirect('users/login'); 
    }
}

if ('moderator' === $this->request->getPrefix()) {
    $this->layout = 'admin';

    if (!$this->session->isLogged() || $this->session->user('level') < 5) {
        $this->redirect('users/login'); 
    }
}
