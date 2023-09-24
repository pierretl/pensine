<?php

/**
  * @return header Supprime une élément et affiche les data
  */
function deleteBookmarks(){

    if ( 
        !empty($_POST["apikey"]) &&
        !empty($_POST["id"])
    ) {

        // Vérification de l'API key
        verificationApiKey( $_POST["apikey"]);

        //url json
        $urlJson = getenv('DATA');

        //data actuel
        $data = getDataFromJson($urlJson);

        //supprime le bookmark
        unset($data[$_POST["id"]]);

        //re-index le json
        $dataReIndex = array_values($data);

        //met a jour le json
        updateJason($urlJson, $dataReIndex);

        //Affiche les data mis a jour
        sendJson(getDataFromJson(getenv('DATA')));

    } else {
        throw new Exception ("La demande n'est pas valide\nParamètre obligatoire : [apikey,id]", "400");
    }

}