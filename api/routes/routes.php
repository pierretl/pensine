<?php 

require_once("controllers/getData/all.php");
require_once("controllers/getData/allCategorie.php");
require_once("controllers/getData/allTag.php");
require_once("controllers/getData/byCategorie.php");
require_once("controllers/getData/byTag.php");
require_once("controllers/postData/addBookmark.php");
require_once("controllers/postData/deleteBookmark.php");

try {
    if (!empty($_GET['demande'])) {

        $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
        //print_r($url);

        switch($url[0]) {
            case "categorie" :
                if(empty($url[1])){
                    throw new Exception ("La categorie n'est pas défini, vérifiez l'url", "400");
                } else {
                    getDataByCategorie($url[1]);
                }
            break;
            case "tag" :
                if(empty($url[1])){
                    throw new Exception ("Le tag n'est pas défini, vérifiez l'url", "400");
                } else {
                    getDataByTag($url[1]);
                }
            break;
            case "allCategorie" :
                getDataAllCategorie();
            break;
            case "allTag" :
                getDataAllTag();
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