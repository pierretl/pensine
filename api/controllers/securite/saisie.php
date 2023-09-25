<?php

/**
  * @return string securisé les data envoyé
  */
function securite_saisi($data) {
    return str_replace('"', '', $data); // pour pas casser le json
}