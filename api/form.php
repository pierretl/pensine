<?php
require_once("lib.php");

$urlJson = 'data.json';

//recupère les valeur saisi
$titre = $_POST['titre'];
$url = $_POST['url'];
$note = $_POST['note'];
$tag = $_POST['tag'];
$categories = $_POST['categories'];

if ( !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) ) {

    $data = getDataFromJson($urlJson);
    debug($data);

    //ajoute une nouel entrée
    $lengthData = count($data); // compte a partir de 1
    $data[$lengthData]["titre"] = securite_saisi($titre);
    $data[$lengthData]["url"] = securite_saisi($url);
    $data[$lengthData]["note"] = securite_saisi($note);
    $data[$lengthData]["tag"] = [securite_saisi($tag)];
    $data[$lengthData]["categories"] = securite_saisi($categories);
    debug($data);

    //met a jour le json
    updateJason($urlJson, $data);

    //redirige sur la page
    header("location:./");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <label for="titre">Titre</label>
        <input type="text" name="titre" value="">
        <br>
        <label for="url">URL</label>
        <input type="text" name="url" value="">
        <br>
        <label for="note">Note</label>
        <input type="text" name="note" value="">
        <br>
        <label for="tag">Tag</label>
        <input type="text" name="tag" value="">
        <br>
        <label for="categories">Categorie</label>
        <input type="text" name="categories" value="">
        <br>
        <button type="submit" id="titreBtn">Envoyer</button>
    </form>
    
</body>
</html>