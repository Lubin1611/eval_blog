<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:04
 */

if (isset($_GET['page'])) { // isset GET['page'] verifie si une valeur est indiquée en parametre dans l'url
    switch ($_GET['page']) { // si c'est le cas, alors on utilise le switch pour chaque parametre qui a pu être indiqué, par ex : index.php?page=choix1

        case "selected_one":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $selected = new article_controler();
            $selected->redir_article();
            break;

        case "connection":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $login = new article_controler();
            $login->check_login();
            break;

        case "espace_admin":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $admin = new article_controler();
            $admin->espace_admin();
            break;

        case "article_create":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $new_article = new article_controler();
            $new_article->submit_article();
            break;

        case "deconnection":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $exit = new article_controler();
            $exit->send_logout();
            break;

        case "to_comment":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $add_com = new article_controler();
            $add_com->submit_com();
            break;

        case "edit_article":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $edit_article = new article_controler();
            $edit_article->to_edit_article();
            break;

        case "apply_edit_article":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $send_edit_article = new article_controler();
            $send_edit_article->send_edit_article();
            break;

        case "to_edit_com":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $edit_com = new article_controler();
            $edit_com->to_edit_com();
            break;

        case "apply_edit_com":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $send_edit_com = new article_controler();
            $send_edit_com->send_edit_com();
            break;

        case "to_delete_com":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $delete_com = new article_controler();
            $delete_com->send_delete_com();

        case "delete_article":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $del_article = new article_controler();
            $del_article->send_delete_article();



    }
}

else { // else représente le cas ou aucun parametre n'est spécifié dans l'url, dans la barre de navigateur, on aura juste : www.index.php
        // ici, on fait donc appel a un comportement par defaut, et on fait appel a notre controleur, qui sera appelé par défaut

    require "Model/Articles.php";
    require "Controler/article_controler.php";

    $show_articles = new article_controler();
    $show_articles->liste_articles();

}









/*$controller = $_REQUEST['controller'];
$action = $_REQUEST['action'];

switch($controller) {

    case "admin":

        require "Model/Articles.php";
        require "Controler/article_controler.php";
        $instance_controler = new article_controler();

        switch ($action) {

            default:
                $ctrl->all_articles();
                break;

        }
}
*/


















