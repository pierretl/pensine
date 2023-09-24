<?php

/**
  * @param array $data Le tableau à encoder
  * @return header affiche le json
  */
function sendJson($data) {
    header("Acces-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($data,JSON_UNESCAPED_UNICODE);
}