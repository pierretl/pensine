<?php

// Charge les variables d'environnement
require_once("controllers/getenv.php");
(new DotEnv(__DIR__ . '/.env'))->load();

// Sécurité
require_once("controllers/securite/saisie.php");
require_once("controllers/securite/verificationApiKey.php");

// Manipulation json
require_once("controllers/json/sendJson.php");
require_once("controllers/json/getDataFromJson.php");
require_once("controllers/json/updateJson.php");


// Router
require_once("routes/routes.php");