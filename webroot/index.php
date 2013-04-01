<?php

define('WEBROOT', dirname(__FILE__)); 	// On défini où se trouve le webroot
define('ROOT', dirname(WEBROOT));		// On défini la racine du projet
define('DS', DIRECTORY_SEPARATOR);		// On défini les spérateurs / ou \
define('CORE', ROOT.DS.'core'); 		// On défini où se trouve le core du projet
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));	// On défini l'url de base
define('CSS', BASE_URL.DS.'webroot'.DS.'css');	// On défini le répertoire du CSS
define('JS', BASE_URL.DS.'webroot'.DS.'js');	// On défini le répertoire du JavaScript
define('IMG', BASE_URL.DS.'webroot'.DS.'img');	// On défini le répertoire des images du design

require CORE.DS.'includes.php';

new Dispatcher();
