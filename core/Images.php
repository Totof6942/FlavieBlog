<?php

class Images
{
    /**
      * Permet d'uploader une image
      *
      * @param string $image     Nom du $_FILE ou se trouve l'image
      * @param string $dossier   Nom du dossier de destination
      * @param string $newName   Eventuel nouveau nom de l'image
      * @param int    $tailleMaxi Eventuelle taille maximale de l'image
      *
      * @return array Retourne un array avec le nombre d'erreur, le nom de l'image et les messages
      */
    public static function uploadImg($image, $dossier, $newNom = false, $tailleMaxi = false)
    {
        $image = $_FILES[$image];
        $nom = basename($image['name']);
        $taille = filesize($image['tmp_name']);
        $ext = strtolower(strrchr($image['name'], '.'));
        $allow_ext = array('.jpeg', '.jpg', '.png', '.gif');

        $erreur = 0;
        $message = '';

        if (!in_array($ext, $allow_ext)) {
            $erreur++;
            $message = 'Extension du fichier non valide.<br />';
        }

        if (!empty($tailleMaxi) && $taille > $tailleMaxi) {
            $erreur++;
            $message .= 'Le fichier est trop gros...';
        }

        if ($erreur == 0) {
            if (!empty($newNom)) {
                $nom = $newNom.$ext;
            }

            $nom = normalize($nom);
            $dossier .= $nom;

            if (!move_uploaded_file($image['tmp_name'], $dossier)) {
                $message = 'Echec de l\'upload.';
                $erreur++;
            }
        }

        return array('errors' => $erreur, 'name' => $nom, 'message' => $message);
    }

    /**
      * Permet de redimensionner en image (toujours en minimisant)
      *
      * @param string $chemin_original Chemin où se trouve l'image
      * @param string $chemin_mini     Chemin de destination de la miniature (peut être égal au chermin_original mais l'image sera alors remplacée par sa miniature)
      * @param string $fichier_image   Nom de l'image
      * @param int    $largeur_max     Largeur max de la miniature (ne sera pas forcement la largeur finale)
      * @param int    $hauteur_max     Hauteur max de la miniature (ne sera pas forcement la hauteur finale)
      *
      * @return boolean Retourne true si tout est OK
      */
    public static function miniature($chemin_original, $chemin_mini, $fichier_image, $largeur_max=false, $hauteur_max=false)
    {
        $size = getimagesize($chemin_original.DS.$fichier_image);

        if ($size['mime']=='image/jpeg') {
            $image_origine = imagecreatefromjpeg($chemin_original.$fichier_image);
        } elseif ($size['mime']=='image/png') {
            $image_origine = imagecreatefrompng($chemin_original.$fichier_image);
        } elseif ($size['mime']=='image/gif') {
            $image_origine = imagecreatefromgif($chemin_original.$fichier_image);
        }

        $largeur_origine = imagesx($image_origine);
        $hauteur_origine = imagesy($image_origine);

        if (empty($largeur_max)) {
            $largeur_mini = $largeur_origine;
        } else {
            $largeur_mini = $largeur_max;
        }
        if (empty($hauteur_max)) {
            $hauteur_mini = $hauteur_origine;
        } else {
            $hauteur_mini = $hauteur_max;
        }

        if ($largeur_origine <= $largeur_mini AND $hauteur_origine <= $hauteur_mini) {
            $largeur = $largeur_origine;
            $hauteur = $hauteur_origine;
        } elseif ($largeur_origine > $hauteur_origine) {
            $largeur = $largeur_mini;
            $hauteur = $hauteur_origine * $largeur / $largeur_origine;
        } else {
            $hauteur = $hauteur_mini;
            $largeur = $largeur_origine * $hauteur / $hauteur_origine;
        }

        $image_finale = imagecreatetruecolor($largeur, $hauteur);
        imagecopyresampled($image_finale, $image_origine, 0, 0, 0, 0,   $largeur, $hauteur, imagesx($image_origine), imagesy($image_origine) );

        if ($size['mime']=='image/jpeg') {
            imagejpeg($image_finale, $chemin_mini.$fichier_image);
        } elseif ($size['mime']=='image/png') {
            imagepng($image_finale, $chemin_mini.$fichier_image);
        } elseif ($size['mime']=='image/gif') {
            imagegif($image_finale, $chemin_mini.$fichier_image);
        }

        imagedestroy($image_finale);

        return true;
    }
}
