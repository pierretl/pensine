<?php

$apiurl = "http://localhost/pensine/api/";

if (isset($_GET['categorie'])) {
    $data = json_decode(file_get_contents("http://localhost/pensine/api/categorie/".$_GET['categorie']));
} else {
    $data = json_decode(file_get_contents("http://localhost/pensine/api"));
}

if (isset($_GET['tag'])) {
    $data = json_decode(file_get_contents("http://localhost/pensine/api/tag/".$_GET['tag']));
}

$allCategorie = json_decode(file_get_contents("http://localhost/pensine/api/allCategorie"));

$allTag = json_decode(file_get_contents("http://localhost/pensine/api/allTag"));

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP utilise Pensine</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>


<nav class="navbar navbar-dark sticky-top bg-dark">
    <div class="container-fluid justify-content-start">
        <span class="navbar-brand" >Pensine avec</span>
        <div class="navbar-nav dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                PHP
            </a>
            <ul class="dropdown-menu" style="position: absolute;">
                <li><a class="dropdown-item" href="../javascript/">JavaScript</a></li>
            </ul>
        </div>
    </div>
</nav>



<div class="row mx-1 my-2">







    <div class="col-12 col-md-8 order-2">


        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="./">Toutes les catégories</a>
            </li>
            <?php foreach ($allCategorie as $categorie) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?categorie=<?= $categorie ?>"><?= $categorie ?></a>
                </li>
            <?php endforeach; ?>
        </ul>

        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="./">Tous les tag</a>
            </li>
            <?php foreach ($allTag as $tag) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="?tag=<?= $tag ?>"><?= $tag ?></a>
                </li>
            <?php endforeach; ?>
        </ul>


        <?php if($data) { ?>

            <ul class="list-unstyled d-flex flex-wrap gap-3">

                <?php foreach ($data as $item) : ?>
                    <li class="card" style="width:400px;">
                        <div class="d-flex">
                            <div class="flex-shrink-1">
                                <?php if($item->capture) { ?>
                                    <img width="150" src="<?= $apiurl . $item->capture ?>" class="img-fluid rounded-start" alt="<?= $item->capture ?>">
                                <?php } else { ?>
                                    <img width="150" src="https://place-hold.it/300x500" class="img-fluid rounded-start" alt="">
                                <?php } ?>
                            </div>
                            <div class="p-2">

                                <p class="h4 card-title">
                                    <?php if($item->faviconUrl) { ?>
                                        <img src="<?= $item->faviconUrl ?>" alt="" width="32">
                                    <?php } ?>
                                    <?= $item->titre ?>
                                    <?php if($item->categories) { ?>
                                        <span class="h6">
                                            <span class="badge bg-primary"><?= $item->categories ?></span>
                                        </span>
                                    <?php } ?>
                                </p>

                                <?php if($item->url) { ?>
                                    <a class="card-link" href="<?= $item->url ?>" target="_blank"><?= $item->url ?></a>
                                <?php } ?>

                                <?php if($item->note) { ?>
                                    <p class="card-text"><?= $item->note ?></p>
                                <?php } ?>

                                <?php if($item->tag) { ?>
                                    <ul class="list-unstyled d-flex flex-wrap">
                                        <?php foreach ($item->tag as $tag) : ?>
                                            <li>
                                                <span class="badge rounded-pill text-bg-secondary"><?php echo $tag ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php } ?>
                                
                                <!--<p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>-->
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>

            </ul>

        <?php } ?>

    </div>



    <div class="col-12 col-md-4 order-1">

        <div class="py-1">
            <h2 class="h5">Formulaire d'ajout</h2>
            <p>* : Champs obligatoires</p>
        </div>


        <form method="post" action="submit.php" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label" for="apikey">Clé API*</label>
                <input class="form-control" type="text" id="apikey" name="apikey" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="faviconUrl">Favicon URL</label>
                <input class="form-control" type="text" id="faviconUrl" name="faviconUrl">
            </div>

            <div class="mb-3">
                <label class="form-label" for="titre">Titre*</label>
                <input class="form-control" type="text" id="titre" name="titre" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="url">URL</label>
                <input class="form-control" type="text" id="url" name="url" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="note">Note</label>
                <input class="form-control" type="text" id="note" name="note" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="tag">Tag</label>
                <input class="form-control" type="text" id="tag" name="tag" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="categories">Categorie</label>
                <input class="form-control" type="text" id="categories" name="categories" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="capture">Capture</label>
                <input class="form-control" type="file" id="capture" name="capture">
            </div>

            <button type="submit" id="titreBtn" class="btn btn-primary">Envoyer</button>
        </form>



        





    </div>

</div>


</body>
</html>