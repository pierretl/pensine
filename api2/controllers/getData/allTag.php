<?php

/**
  * @return header un json de toutes les catégories
  */
  function getDataAllTag() {

    $allData = getDataFromJson(getenv('DATA'));
    $allTag = [];

    for ($i=0; $i < count($allData); $i++) {
        
        $allTag = array_merge($allTag, $allData[$i]['tag']);
        array_push($allTag);
        
    }

    // passe tout en minuscule
    $allTag = array_map('strtolower', $allTag);

    // supprime les éléments vide
    $allTag = array_filter($allTag); 

    // supprime les doublons
    $allTag = array_unique($allTag);

    // re-index le tableau
    $allTag = array_values($allTag);

    // affiche le resultat
    sendJson($allTag);

}