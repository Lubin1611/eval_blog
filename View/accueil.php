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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
          integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link rel="stylesheet" href="./public/css/bootstrap.css">
    <link rel="stylesheet" href="./public/css/styleBlog.css">

</head>
<body>

<div id='main'>

    <header class="d-flex flex-wrap">
        <div>
            <h1>Bienvenue sur mon blog !</h1>
            <nav class="nav justify-content-center">
                <a href="index.php?page=index" class="nav-link">Accueil</a>
                <a href="index.php?page=vue_inscription" class="nav-link">S'inscrire</a>
            </nav>
        </div>
        <?php
        if (isset($_SESSION['rang']) and $_SESSION['rang'] == 1) {
            ?>
            <nav class="nav">
                <a href="index.php?page=espace_admin" class="nav-link">Ecrire un article</a>
                <a href="index.php?page=index" class="nav-link">Liste des articles</a>
                <a href="index.php?page=deconnection" class="nav-link">Se déconnecter</a>
            </nav>
            <?php
            if (isset($_SESSION['rang']) and $_SESSION['rang'] == 1) {
                ?>
                <div>Bienvenue, <?php echo $_SESSION['nom']; ?>&nbsp; <?php echo $_SESSION['prenom']; ?></div>
            <?php } ?>

            <?php
        }
        else if (isset($_SESSION['rang']) and $_SESSION['rang'] == 0) {
            ?>
            <div>
                <p>Bienvenue, <?php echo $_SESSION['nom']; ?>&nbsp; <?php echo $_SESSION['prenom']; ?></p>
                <a href="index.php?page=deconnection" class="nav-link">Se déconnecter</a>
            </div>
            <?php
        } else {
            ?>
            <form action="index.php?page=connection" method="post">
                <label>Votre pseudo : </label>&nbsp;
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                    </div>
                    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" name="pseudo">
                </div>
                <label>Votre mot de passe : </label>&nbsp;<input type="password" class="form-control mb-2 mr-sm-2"
                                                                 name="password">
                <input type="submit" class="btn btn-primary mb-2" value="Envoyez">
            </form>
        <?php }
        ?>
    </header>

    <div id="articles">

        <?php foreach ($main_article as $new) { ?>

            <h1 id='titre'><?= $new->titre_billet ?></h1>

            <h5>Date d'émission : <?= $new->date_billet ?></h5>

            <div id="contenu_article"><?= $new->contenu_billet ?></div>

            <?php

            if (isset($_SESSION['rang']) and $_SESSION['rang'] == 1 || $_SESSION['rang'] == 0) {
                    ?>
                    <div id="comment">
                        <form action="index.php?page=to_comment&id=<?= $new->id_billet ?>" method="post">
                            <label>Commentez :</label><textarea name="contenu_com" id="contenu_com"></textarea>
                            <input type="submit" value="Envoyez" class="btn btn-primary mb-2" id="btn">
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="alert alert-info">Connectez-vous pour écrire un commentaire</div>
                    <?php
                }
            }

        ?>


        <div id="commentaires">

            <?php foreach ($related_comments as $comment) { ?>

                <div id=comments>

                    <?php if (isset($_SESSION['rang']) and $_SESSION['rang'] == 1) { ?>

                        <a href="index.php?page=to_edit_com&id1=<?= $comment->id_billet ?>&id2=<?= $comment->id_com ?>"><i
                                    class="far fa-edit"></i></a>

                        <a href="index.php?page=to_delete_com&idAlt1=<?= $comment->id_billet ?>&idAlt2=<?= $comment->id_com ?>"><i
                                    class="far fa-trash-alt"></i></a>

                    <?php } ?>

                    <div><?= $comment->auteur_com ?>, le <?= $comment->date_com ?></div>

                    <div> <?= $comment->contenu_com ?> </div>

                </div>
            <?php } ?>

        </div>

        <footer></footer>

    </div>

</body>
</html>