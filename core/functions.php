<?php

/**
  * Permet de mettre en forme une chaine de caractères sans charactères spéciaux (pour slug surtout)
  *
  * @param string $string Chaine de caractères à normaliser
  *
  * @return string Retourne la chaine de caractère formatée
  */
function normalize($string)
{
    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ';
    $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyyby';

    $string = utf8_decode($string);
    $string = strtr($string, utf8_decode($a), $b);
    $string = preg_replace('#[^.a-zA-Z0-9]+#i', '-', $string);
    $string = strtolower($string);
    $string = trim($string, '-');

    return utf8_encode($string);
}

/**
  * Convertir une chaine ascii en hexadecimal
  *
  * @param string $string Chaine ascii à convertir
  *
  * @return string Chaine convertie en hexidecimal
  */
function ascii2hex($string)
{
    $result = '';

    for ($i = 0 ; $i < strlen($string) ; $i++) {
        $result .= str_pad(base_convert(ord($string[$i]), 10, 16), 2, '0', STR_PAD_LEFT);
    }

    return $result;
}

/**
  * Encrypte une chaine de caractères
  *
  * @param string $string Chaine originale à convertir
  *
  * @return string La chaine encrypter
  */
function encrypt($string)
{
    $string = sha1($string).'lapours';
    $string = '42Flavie14'.ascii2hex($string);
    $string = md5($string);

    return $string;
}

/**
  * Permet d'afficher le contenu d'une variable php pour faire du débug (surtout les array)
  *
  * @param $var Variable à afficher
  */
function debug($var)
{
    if (Conf::$debug > 0) {
        $debug = debug_backtrace();

        echo '<p>&nbsp;</p><p><a href="#"><strong>'.$debug[0]['file'].'</strong> l.'.$debug[0]['line'].'</a></p>';

        echo '<ol>';
        foreach ($debug as $key => $value) {
            if ($key > 0) {
                echo '<li><strong>'.$value['file'].'</strong> l.'.$value['line'].'</li>';
            }
        }

        echo '</ol>';

        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}
