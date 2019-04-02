<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 02/04/2019
 * Time: 13:27
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

    <h2>Liste des articles</h2>

    <?php foreach ($listes as $liste) { ?>

        <ul>
            <a href="index.php?page=selected_one&id=<?= $liste->id_billet ?>">
                <li><?= $liste->titre_billet ?>, le  <?= $liste->date_billet ?></li></a>
        </ul>

    <?php } ?>
</div>

</body>
</html>