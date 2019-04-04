<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:28
 */
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link rel="stylesheet" href="./public/css/styleBlog.css">
</head>
<body>

<div id='main'>

    <header>
        <h1>Bienvenue sur mon blog !</h1>
        <?php
        if (isset($_SESSION['rang']) == 1) {
            ?>
            <a href="index.php?page=espace_admin">Accédez a votre espace d'administration</a>
            <a href="index.php?page=deconnection">Se déconnecter</a>
            <?php
        } else {
        ?>
        <form action="index.php?page=connection" method="post">
            <label>Votre pseudo : </label><input type="text" name="pseudo">
            <label>Votre mot de passe : </label><input type="password" name="password">
            <input type="submit" value="Envoyez">
            <?php }
            ?>
    </header>

    <div id=articles>

        <?php foreach ($main_article as $new) { ?>

            <h2><?= $new->titre_billet ?></h2>

            <h5>Date d'émission : <?= $new->date_billet ?></h5>

            <div><?= $new->contenu_billet ?></div>

            <?php

            if (isset($_SESSION['rang']) == 1) {
                ?>
                <div>
                    <form action="index.php?page=to_comment&id=<?= $new->id_billet ?>" method="post">
                        <label>Commentez :</label><textarea name="contenu_com" id="contenu_com"></textarea>
                        <input type="submit" value="Envoyez votre Com">
                </div>
                <?php
            } else {
                ?>
                <div id="no_access">Connectez-vous pour écrire un commentaire</div>
                <?php
            }
        }
        ?>


        <div id="commentaires">

            <?php foreach ($related_comments as $comment) { ?>

                <div id=comments>

                    <?php if (isset($_SESSION['rang']) == 1) {  ?>

                    <a href="index.php?page=to_edit_com&id1=<?= $comment->id_billet ?>&id2=<?= $comment->id_com ?>"><i
                                class="far fa-edit"></i></a>

                    <a href="index.php?page=to_delete_com&idAlt1=<?= $comment->id_billet ?>&idAlt2=<?= $comment->id_com ?>"><i
                                class="far fa-trash-alt"></i></a>

                    <?php }  ?>

                    <div><?= $comment->auteur_com ?>, le <?= $comment->date_com ?></div>

                    <div> <?= $comment->contenu_com ?> </div>

                </div>
            <?php } ?>

        </div>

        <footer></footer>

    </div>

</body>
</html>