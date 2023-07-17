<?php
require_once("lib.php");

// http://localhost/pensine/api/
// http://localhost/pensine/api/categorie/a

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
            case "form" :
                addForm();
            break;
            case "get" :
                addByGet();
            break;
            case "route" :
                addByRoute();
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