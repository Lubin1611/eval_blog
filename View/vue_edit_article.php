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
</head>
<body>

<div id = 'main'>

    <h1>Edition de l'article</h1>

    <form action="index.php?page=apply_edit_article&id=<?= $selected['id_billet'] ?>" method="post">

        <label>Titre : </label><input type="text" name = "titre_article" id = "titre_article" value ="<?php echo $selected['titre_billet'] ?>">

        <label>Contenu de l'article : </label><textarea name = "contenu_article" id = "contenu_article"><?php echo $selected['contenu_billet'] ?></textarea>

        <input type="submit" value="Envoyez">

</div>


</body>
</html>