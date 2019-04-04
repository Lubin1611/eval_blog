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
</head>
<body>

<header>
    <h1>Bienvenue sur mon blog !</h1>
    <?php
    if (isset($_SESSION['rang']) == 1) {
        ?>
        <a href="index.php?page=espace_admin">Accédez a votre espace d'administration</a>
        <?php
    } else {
    ?>
    <form action="index.php?page=connection" method="post">
        <label>Votre pseudo : </label><input type="text" name = "pseudo">
        <label>Votre mot de passe : </label><input type="password" name = "password">
        <input type="submit" value="Envoyez">
        <?php }
        ?>
</header>

<div id = 'main'>

    <h1>Ecrivez votre article !</h1>

    <form action="index.php?page=article_create" method="post">

        <label>Titre : </label><input type="text" name = "titre_article" id = "titre_article">
   >
        <label>Contenu de l'article : </label><textarea name = "contenu_article" id = "contenu_article"></textarea>

        <input type="submit" value="Envoyez">

</div>


</body>
</html>