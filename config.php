<?php
// Informations d'identification
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'click_collect');


function connexion(){
    $dns = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=UTF8";
    try{
        $connexion = new PDO($dns, DB_USERNAME, DB_PASSWORD);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;
    }catch(PDOException $except){
        //Lorsque la connexion a echoué;
        die("Echec de la connexion: ".$except->getMessage());
        return false;
    }
}

function secure($field){
    return htmlspecialchars(strtolower(trim($field)));
}

function uploadPicture($file){
    $message = "Erreur";
    if(isset($file)){
        $allowed = array(
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml'
        );
        $filename = $file["name"];
        $filetype = $file["type"];
        $filesize = $file["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $maxsize = 5 * 1024 * 1024;

        // Vérifie l'extension du fichier
        if(!array_key_exists($ext, $allowed)){  
            $message = '<strong>Erreur!</strong> Veuillez sélectionner un format de fichier valide.';
        }
        // Vérifie la taille du fichier - 5Mo maximum
        else if($filesize > $maxsize){ 
            $message = '<strong>Erreur!</strong> La taille du fichier est supérieure à la limite autorisée.';
        }
        // Vérifie le type MIME du fichier
        else if(in_array($filetype, $allowed)){
                move_uploaded_file($file["tmp_name"], "../../images/etablissements/" . $filename);
                $message = "";
        }else{                    
            $message  = "<strong>Erreur!</strong> Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.";
        }
    } else{
        $message = "<strong>Erreur!</strong> ".$file["error"];
    }
    return $message;
}
