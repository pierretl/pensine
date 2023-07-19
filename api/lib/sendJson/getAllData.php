<?php

/**
  * @return header un json de tous les datas
  */
  function getAllData(){
    sendJson(getDataFromJson(getenv('DATA'), false));
}