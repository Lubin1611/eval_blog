<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:28
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link rel="stylesheet" href="./public/css/styleBlog.css">
</head>
<body>

<div id = 'main'>

<header>
    <h1>Bienvenue sur mon blog !</h1>
        <form action="index.php?page=connection" method="post">
        <label>Votre pseudo : </label><input type="text" name = "pseudo">
        <label>Votre mot de passe : </label><input type="password" name = "password">
            <input type="submit" value="Envoyez">
</header>

    <div id = articles>

        <?php foreach ($main_article as $new) { ?>

           <h2><?= $new->titre_billet ?></h2>

            <h5>Date d'émission : <?= $new->date_billet ?></h5>

            <div><?= $new->contenu_billet ?></div>

        <?php } ?>
    </div>

     <hr>

    <div id = "commentaires">

    <?php foreach ($related_comments as $comment) { ?>

    <span><?= $comment->auteur_com ?>, le <?= $comment->date_com ?></span>

        <div> <?= $comment->contenu_com ?> </div>

    <?php } ?>

    </div>

    <footer></footer>

</div>

</body>
</html>