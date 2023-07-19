<?php

/**
  * @param string $urlJason URL d'un fichier JSON
  * @param bool $associative `true` pour un tableau (par défaut), `false` pour un objet
  * @return array|object retourne le json avec la forme demandé
  */
  function getDataFromJson($urlJason, $associative=true) {
    $jsonString = file_get_contents($urlJason);

    //retourne un tableau
    if($associative === true){
        $data = json_decode($jsonString, true);
        return $data;
    }

    //retourne un objet
    $data = json_decode($jsonString);
    return $data;
}



function updateJason($urlJason, $data) {
    $newJsonString = json_encode($data);
    file_put_contents($urlJason, $newJsonString);
}