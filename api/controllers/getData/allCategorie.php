<?php

/**
  * @return header un json de toutes les catégories
  */
  function getDataAllCategorie() {

    $allData = getDataFromJson(getenv('DATA'));
    $allCategorie = [];

    for ($i=0; $i < count($allData); $i++) {
        
        $allCategorie[$i] = $allData[$i]['categories'];
        
    }

    // supprime les éléments vide
    $allCategorie = array_filter($allCategorie);

    // supprime les doublons
    $allCategorie = array_unique($allCategorie);

    // re-index le tableau
    $allCategorie = array_values($allCategorie);

    // affiche le resultat
    sendJson($allCategorie);

}