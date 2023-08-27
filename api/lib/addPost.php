<?php 

/**
  * @return header ajoute un élément dans data.json
  */
  function addPost() {
    $urlJson = getenv('DATA');

    $apikey = $_POST["apikey"];
    $faviconUrl = $_POST["faviconUrl"];
    $titre = $_POST["titre"];
    $url = $_POST["url"];
    $note = $_POST["note"];
    $tag = $_POST["tag"];
    $categories = $_POST["categories"];
    $capture = isset($_POST["capture"]) ? $_POST["capture"] : "";

    if ( !empty($apikey) || !empty($faviconUrl) || !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) ) {


        // Vérification de l'apikey
        if ( $apikey !== getenv('APIKEY')) {
            header("location:../"); //redirige sur l'api
            exit;
        };

        // Vérification de l'extention du fichier en base 64
        $target_file = "";
        if ( $capture !="" ){
            $target_extension = explode('/', mime_content_type($capture))[1];
            
            if (
                $target_extension == 'jpg' || 
                $target_extension == 'jpeg' || 
                $target_extension == 'png'
                ) {
                // convertis et upload la capture
                $target_dir = "data/img/";
                $target_file = $target_dir . createSlug($titre) . '.png';
                file_put_contents($target_file, file_get_contents($capture));
            }
    }


        //
        $data = getDataFromJson($urlJson);
        //debug($data);

        //ajoute une nouel entrée
        $lengthData = count($data); // compte a partir de 1
        $data[$lengthData]["faviconUrl"] = securite_saisi($faviconUrl);
        $data[$lengthData]["titre"] = securite_saisi($titre);
        $data[$lengthData]["url"] = securite_saisi($url);
        $data[$lengthData]["note"] = securite_saisi($note);
        $data[$lengthData]["tag"] = [securite_saisi($tag)];
        $data[$lengthData]["categories"] = securite_saisi($categories);
        $data[$lengthData]["capture"] = $target_file;
        //debug($data);

        //met a jour le json
        updateJason($urlJson, $data);
        
        //redirige sur l'api
        header("location:../");

    } else {
        //redirige sur l'api
        header("location:../");
    }


}