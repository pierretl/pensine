<?php
require_once("lib/_include.php");

// Charge les variables d'environnement
(new DotEnv(__DIR__ . '/.env'))->load();


try {
    if (!empty($_GET['demande'])) {

        $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        //print_r($url);

        switch($url[0]) {
            case "categorie" :
                if(empty($url[1])){
                    getAllData();
                } else {
                    getDataByCategorie($url[1]);
                }
            break;
            case "allCategorie" :
                getAllCategorie();
            break;
            case "post" :
                addPost();
            break;
            default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
        }

    } else {
        getAllData();
    }

} catch(Exception $e) {
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}