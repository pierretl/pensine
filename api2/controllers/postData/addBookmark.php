<?php

/**
  * @return header ajoute un élément dans data.json
  */
function addBookmarks(){

    if ( 
        !empty($_POST["apikey"]) &&
        !empty($_POST["url"])
    ) {

        // Vérification de l'API key
        verificationApiKey( $_POST["apikey"]);

        //Récupérationd des valeurs
        $url =          $_POST["url"];
        $faviconUrl =   isset($_POST["faviconUrl"]) ? $_POST["faviconUrl"] : "";
        $titre =        isset($_POST["titre"]) ? $_POST["titre"] : "";
        $note =         isset($_POST["note"]) ? $_POST["note"] : "";
        $tag =          isset($_POST["tag"]) ? $_POST["tag"] : "";
        $categories =   isset($_POST["categories"]) ? $_POST["categories"] : "";
        $capture =      isset($_POST["capture"]) ? $_POST["capture"] : "";

        //url json
        $urlJson = getenv('DATA');

        //data actuel
        $data = getDataFromJson($urlJson);

        //ajoute un nouveau bookmark
        $lengthData = count($data);

        $target_file = ""; // a faire

        $data[$lengthData]["faviconUrl"] = securite_saisi($faviconUrl);
        $data[$lengthData]["titre"] = securite_saisi($titre);
        $data[$lengthData]["url"] = securite_saisi($url);
        $data[$lengthData]["note"] = securite_saisi($note);
        $data[$lengthData]["tag"] = explode(",", securite_saisi($tag));
        $data[$lengthData]["categories"] = securite_saisi($categories);
        $data[$lengthData]["capture"] = $target_file;

        //met a jour le json
        updateJason($urlJson, $data);

        //Affiche les data mis a jour
        sendJson(getDataFromJson(getenv('DATA')));

    } else {
        throw new Exception ("La demande n'est pas valide\nParamètre obligatoire : [apikey,url]\nAutre paramètre : [faviconUrl,titre,note,[tag],categories,capture]", "400");
    }
}