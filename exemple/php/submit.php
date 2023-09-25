<?php

$apiPost = 'http://localhost/pensine/api/addBookmark';

$apikey =       isset($_POST['apikey']) ? $_POST['apikey'] : "";
$titre =        isset($_POST['titre']) ? $_POST['titre'] : "";
$url =          isset($_POST['url']) ? $_POST['url'] : "";
$note =         isset($_POST['note']) ? $_POST['note'] : "";
$tag =          isset($_POST['tag']) ? $_POST['tag'] : "";
$categories =   isset($_POST['categories']) ? $_POST['categories'] : "";
$capture =      isset($_POST['capture']) ? $_POST['capture'] : "";


//print_r($_FILES);
$errors=array();
$file_size=$_FILES['capture']['size'];
$file_tmp= $_FILES['capture']['tmp_name'];

if (!empty($file_tmp)) {
    $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
    $data = file_get_contents($file_tmp);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

if($file_size > 2097152) {
    $errors[]= 'File size must be under 2mb';
}

if(empty($errors)) {
    $capture = $base64;
} 



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