<?php

/**
  * @param string $categorie la categorie a filtrer
  * @return header un json de tous les datas qui on la categorie fournis
  */
  function getDataByCategorie($categorie){

    $allData = getDataFromJson(getenv('DATA'));
    $dataFiltre = [];

    for ($i=0; $i < count($allData); $i++) {
        if ( $allData[$i]['categories'] === $categorie) {
            $dataFiltre[$i] = $allData[$i];
        }
    }

    // re-index le tableau
    $dataFiltreReIndex = array_values($dataFiltre);

    // affiche le resultat
    sendJson($dataFiltreReIndex);
}