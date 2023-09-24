<?php 

require_once("controllers/getData/all.php");
require_once("controllers/getData/allCategorie.php");
require_once("controllers/getData/byCategorie.php");
require_once("controllers/postData/addBookmark.php");
require_once("controllers/postData/deleteBookmark.php");

try {
    if (!empty($_GET['demande'])) {

        $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        //print_r($url);

        switch($url[0]) {
            case "categorie" :
                if(empty($url[1])){
                    getDataAll();
                } else {
                    getDataByCategorie($url[1]);
                }
            break;
            case "allCategorie" :
                getDataAllCategorie();
            break;
            case "addBookmark" :
                addBookmarks();
            break;
            case "deleteBookmark" :
                deleteBookmarks();
            break;
            default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
        }

    } else {
        getDataAll();
    }

} catch(Exception $e) {
    $erreur = [
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
    print_r($erreur);
}