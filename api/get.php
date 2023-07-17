<?php
require_once("lib.php");

$urlJson = 'data.json';

//recupère les valeur saisi
$titre = $_GET['titre'];
$url = $_GET['url'];
$note = $_GET['note'];
$tag = $_GET['tag'];
$categories = $_GET['categories'];

if ( !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) ) {

    $data = getDataFromJson($urlJson);
    //debug($data);

    //ajoute une nouel entrée
    $lengthData = count($data); // compte a partir de 1
    $data[$lengthData]["titre"] = securite_saisi($titre);
    $data[$lengthData]["url"] = securite_saisi($url);
    $data[$lengthData]["note"] = securite_saisi($note);
    $data[$lengthData]["tag"] = [securite_saisi($tag)];
    $data[$lengthData]["categories"] = securite_saisi($categories);
    //debug($data);

    //met a jour le json
    updateJason($urlJson, $data);

    //redirige sur l'api
    header("location:./");

} else {

    //redirige sur l'api
    header("location:./");

}