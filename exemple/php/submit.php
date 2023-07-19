<?php

$apiPost = 'http://localhost/pensine/api/post';

$apikey =       isset($_POST['apikey']) ? $_POST['apikey'] : "";
$titre =        isset($_POST['titre']) ? $_POST['titre'] : "";
$url =          isset($_POST['url']) ? $_POST['url'] : "";
$note =         isset($_POST['note']) ? $_POST['note'] : "";
$tag =          isset($_POST['tag']) ? $_POST['tag'] : "";
$categories =   isset($_POST['categories']) ? $_POST['categories'] : "";
$capture =      isset($_POST['capture']) ? $_POST['capture'] : "";

$data = array(
    'apikey' =>  $apikey,
    'titre' =>  $titre, 
    'url' => $url, 
    'note' => $note, 
    'tag' => $tag, 
    'categories' => $categories,
    'capture' => $capture
);

if ( !empty($apikey) || !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) || !empty($capture) ) {
    //print_r($data);

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($apiPost, false, $context);

    header("location:./index.php");
}