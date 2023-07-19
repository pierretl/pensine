<?php

function debug($data) {
  echo "<pre>".print_r($data,TRUE)."</pre><hr>";
}

function securite_saisi($data) {
  return str_replace('"', '', $data); // pour pas casser le json
}

function updateJason($urlJason, $data) {
  $newJsonString = json_encode($data);
  file_put_contents($urlJason, $newJsonString);
}


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



/**
  * @param array $data Le tableau à encoder
  * @return header affiche le json
  */
function sendJson($data) {
    header("Acces-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}



/**
  * @return header un json de tous les datas
  */
function getAllData(){
    sendJson(getDataFromJson('data/data.json', false));
}



/**
  * @param string $categorie la categorie a filtrer
  * @return header un json de tous les datas qui on la categorie fournis
  */
function getDataByCategorie($categorie){

    $allData = getDataFromJson('data/data.json');
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



/**
  * @return header un json de toutes les catégories
  */
function getAllCategorie() {

    $allData = getDataFromJson('data/data.json');
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


/**
  * @return header ajoute un élément dans data.json
  */
function addPost() {
    $urlJson = 'data/data.json';

    $apikey = $_POST["apikey"]; // a vérif
    $titre = $_POST["titre"];
    $url = $_POST["url"];
    $note = $_POST["note"];
    $tag = $_POST["tag"];
    $categories = $_POST["categories"];
    $capture = $_POST["capture"];

    if ( !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) || !empty($capture) ) {

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