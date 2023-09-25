<?php

/**
  * @return exception message d'erreur
  */
function verificationApiKey($apikey) {
    if ( $apikey !== getenv('APIKEY')) {
        throw new Exception ("Incorrect API key provided", "401");
    };
}