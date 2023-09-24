<?php

/**
  * @return header un json de tous les datas
  */
  function getDataAll() {
    sendJson(getDataFromJson(getenv('DATA')));
}