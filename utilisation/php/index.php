<?php

if (isset($_GET['categorie'])) {
    $data = json_decode(file_get_contents("http://localhost/pensine/api/categorie/".$_GET['categorie']));
} else {
    $data = json_decode(file_get_contents("http://localhost/pensine/api"));
}

$allCategorie = json_decode(file_get_contents("http://localhost/pensine/api/allCategorie"));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP json_decode</title>
</head>
<body>

    <ul>
        <li>
            <h1>php</h1>
        </li>
        <li>
            <a href="../javascript/">javascript</a>
        </li>
    </ul>
    <hr>

    <h2>Filtre</h2>
    <ul>
        <li><a href="./">Tout</a></li>
        <?php foreach ($allCategorie as $categorie) : ?>
            <li><a href="?categorie=<?= $categorie ?>"><?= $categorie ?></a></li>
        <?php endforeach; ?>
    </ul>
    <hr>

    <h2>Liste</h2>
    <?php if($data) { ?>
        <ul>
            <?php foreach ($data as $item) : ?>
                <li>
                <p>
                        <strong><?= $item->titre ?></strong>
                </p>
                    <ul>
                        <li><a href="<?= $item->url ?>" target="_blank"><?= $item->url ?></a></li>
                        <?php if($item->note) { ?>
                            <li><?= $item->note ?></li>
                        <?php } ?>
                        <?php if($item->tag) { ?>
                            <li>
                                <?php foreach ($item->tag as $tag) : ?>
                                    <?php echo $tag ?>
                                <?php endforeach; ?>
                            </li>
                        <?php } ?>
                        <li><?= $item->categories ?></li>
                    </ul>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php } ?>
    <hr>

    <h2>Formulaire</h2>
    <?php
        $apiPost = 'http://localhost/pensine/api/post';

        $titre =        isset($_POST['titre']) ? $_POST['titre'] : "";
        $url =          isset($_POST['url']) ? $_POST['url'] : "";
        $note =         isset($_POST['note']) ? $_POST['note'] : "";
        $tag =          isset($_POST['tag']) ? $_POST['tag'] : "";
        $categories =   isset($_POST['categories']) ? $_POST['categories'] : "";
        
        $data = array(
            'titre' =>  $titre, 
            'url' => $url, 
            'note' => $note, 
            'tag' => $tag, 
            'categories' => $categories
        );

        if ( !empty($titre) || !empty($url) || !empty($note) || !empty($tag) || !empty($categories) ) {
            print_r($data);

            $options = array(
                'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $result = file_get_contents($apiPost, false, $context);

            header("location:./");
        }

    ?>
    <form method="post">
        <label for="titre">Titre</label>
        <input type="text" name="titre" value="">
        <br>
        <label for="url">URL</label>
        <input type="text" name="url" value="">
        <br>
        <label for="note">Note</label>
        <input type="text" name="note" value="">
        <br>
        <label for="tag">Tag</label>
        <input type="text" name="tag" value="">
        <br>
        <label for="categories">Categorie</label>
        <input type="text" name="categories" value="">
        <br>
        <button type="submit" id="titreBtn">Envoyer</button>
    </form>


</body>
</html>