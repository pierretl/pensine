<?php

/**
  * @param string $str texte à slug
  * @param string $delimiter pour la date
  * @return string date_slug
  */
  function createSlug($str, $delimiter = '-'){
    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    $slug = substr($slug, 0, 30);
    return date('Y-m-d_H-i-s').'_'.$slug;
}