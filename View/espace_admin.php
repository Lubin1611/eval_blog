<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 03/04/2019
 * Time: 09:41
 */
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <link rel="stylesheet" href="./public/css/styleBlog.css">
    <link rel="stylesheet" href="./public/css/bootstrap.css">

</head>
<body>

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

<div id = 'main'>

    <h1 id = "space_title">Ecrivez votre article !</h1>

    <form action="index.php?page=article_create" method="post">

        <label>Titre : </label><input type="text" name = "titre_article" id = "titre_article">

        <div id ='space'></div>
        <label>Contenu de l'article : </label><textarea name = "contenu_article" id = "contenu_article"></textarea>

        <input type="submit" value="Envoyez" id = "btn" class="btn btn-primary mb-2">

</div>


</body>
</html>