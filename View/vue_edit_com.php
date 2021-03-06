<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 04/04/2019
 * Time: 10:26
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
    <link rel="stylesheet" href="./public/css/bootstrap.css">

</head>
<body>

<header class="d-flex flex-wrap">
    <div>
        <h1>Bienvenue sur mon blog !</h1>
        <nav class="nav justify-content-center">
            <a href="index.php?controler=articles&action=index" class="nav-link">Accueil</a>
            <a href="index.php?controler=users&action=vue_inscription" class="nav-link">S'inscrire</a>
        </nav>
    </div>
    <?php
    if (isset($_SESSION['rang']) and $_SESSION['rang'] == 1) {
        ?>
        <nav class="nav">
            <a href="index.php?controler=users&action=espace_admin" class="nav-link">Ecrire un article</a>
            <a href="index.php?controler=articles&action=index" class="nav-link">Liste des articles</a>
            <a href="index.php?controler=users&action=deconnection" class="nav-link">Se déconnecter</a>
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
            <a href="index.php?controler=users&action=deconnection" class="nav-link">Se déconnecter</a>
        </div>
        <?php
    } else {
        ?>
        <form action="index.php?controler=users&action=connection" method="post">
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

<div id="space"></div>


<div id = 'main'>

    <h1>Edition du commentaire</h1>

    <form action="index.php?controler=commentaires&action=apply_edit_com&id1=<?= $chosen['id_billet'] ?>&id2=<?= $chosen['id_com'] ?>" method="post">

        <label>Contenu de l'article : </label><textarea name = "contenu_com" id = "contenu_com"><?php echo $chosen['contenu_com'] ?></textarea>

        <input type="submit" value="Envoyez">

</div>


</body>
</html>
