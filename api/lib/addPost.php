<?php 

/**
  * @return header ajoute un élément dans data.json
  */
  function addPost() {
    $urlJson = getenv('DATA');

    $apikey = $_POST["apikey"];
    $titre = $_POST["titre"];
    $url = $_POST["url"];
    $note = $_POST["note"];
    $tag = $_POST["tag"];
    $categories = $_POST["categories"];
    $capture = $_POST["capture"];

    if ( !empty($apikey) || !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) || !empty($capture) ) {


        // Vérification de l'apikey
        if ( $apikey !== getenv('APIKEY')) {
            
            header("location:../"); //redirige sur l'api
            exit;

        };

        $data = getDataFromJson($urlJson);
        //debug($data);

        //ajoute une nouel entrée
        $lengthData = count($data); // compte a partir de 1
        $data[$lengthData]["titre"] = securite_saisi($titre);
        $data[$lengthData]["url"] = securite_saisi($url);
        $data[$lengthData]["note"] = securite_saisi($note);
        $data[$lengthData]["tag"] = [securite_saisi($tag)];
        $data[$lengthData]["categories"] = securite_saisi($categories);
        $data[$lengthData]["capture"] = securite_saisi($capture);
        //debug($data);

        //met a jour le json
        updateJason($urlJson, $data);
        
        //redirige sur l'api
        header("location:../");

    } else {
        //redirige sur l'api
        header("location:../");
    }


}