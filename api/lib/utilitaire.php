<?php


function debug($data) {
  echo "<pre>".print_r($data,TRUE)."</pre><hr>";
}



function securite_saisi($data) {
  return str_replace('"', '', $data); // pour pas casser le json
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



function createSlug($str, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    $slug = substr($slug, 0, 30);
    return date('Y-m-d_H-i-s').'_'.$slug;
}