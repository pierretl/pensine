<?php

/**
  * @param string $tag le tag a filtrer
  * @return header un json de tous les datas qui on le taf fournis
  */
  function getDataByTag($tag){

    $allData = getDataFromJson(getenv('DATA'));
    $dataFiltre = [];

    for ($i=0; $i < count($allData); $i++) {

        for ($j=0; $j < count($allData[$i]['tag']); $j++) {
            
            if ( strtolower($allData[$i]['tag'][$j]) === strtolower($tag)) {
                $dataFiltre[$i] = $allData[$i];
            }

        }
        
    }

    // re-index le tableau
    $dataFiltreReIndex = array_values($dataFiltre);

    // affiche le resultat
    sendJson($dataFiltreReIndex);
}