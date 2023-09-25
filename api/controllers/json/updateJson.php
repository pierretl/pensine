<?php

/**
  * @param string $urlJason URL d'un fichier JSON
  * @param array $data Le tableau à encoder
  * @return array|object Ajoute les données dans le fichier $urlJason
  */
function updateJason($urlJason, $data) {
    $newJsonString = json_encode($data);
    file_put_contents($urlJason, $newJsonString);
}