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