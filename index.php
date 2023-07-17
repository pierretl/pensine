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
            <a href="fetch/index.html">javascript</a>
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


</body>
</html>