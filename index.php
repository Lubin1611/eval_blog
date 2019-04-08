<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:04
 /*
 * Ici, j'utilise un 1er switch qui trie les appels en fonction du controler, avec GET['controler']
 * Puis, mon deuxième switch lance les actions spécifiques au controleur séléctionné, avec GET['action']
 */

if (isset($_GET['controler'])) { // isset GET['controler'] verifie si une valeur est indiquée en parametre dans l'url

    switch ($_GET['controler']) {

        case "articles":

            require "Model/Articles.php";
            require "Controler/article_controler.php";

            switch ($_GET['action']) {

                case "index":
                    $index = new article_controler();
                    $index->liste_articles();

                case "selected_one":
                    $selected = new article_controler();
                    $selected->redir_article();
                    break;

                case "edit_article":
                    $edit_article = new article_controler();
                    $edit_article->to_edit_article();
                    break;

                case "delete_article":
                    $del_article = new article_controler();
                    $del_article->send_delete_article();

                case "article_create":
                    $new_article = new article_controler();
                    $new_article->submit_article();
                    break;

                case "apply_edit_article":
                    $send_edit_article = new article_controler();
                    $send_edit_article->send_edit_article();
                    break;
            }
            break;

        case "users":
            require "Model/Users.php";
            require "Controler/user_controler.php";

            switch ($_GET['action']) {

                case "vue_inscription":
                    $redir_submit = new user_controler();
                    $redir_submit->sign_up();
                    break;

                case "espace_admin":
                    $admin = new user_controler();
                    $admin->espace_admin();
                    break;

                case "deconnection":
                    $exit = new user_controler();
                    $exit->send_logout();
                    break;

                case "connection":
                    $login = new user_controler();
                    $login->check_login();
                    break;

                case "inscription":
                    $submit = new user_controler();
                    $submit->submit_sign_up();
                    break;
            }
            break;

        case "commentaires":
            require "Model/Commentaires.php";
            require "Controler/commentaire_controler.php";

            switch ($_GET['action']) {

                case "to_comment":
                    $add_com = new commentaire_controler();
                    $add_com->submit_com();
                    break;

                case "to_edit_com":
                    $edit_com = new commentaire_controler();
                    $edit_com->to_edit_com();
                    break;

                case "to_delete_com":
                    $delete_com = new commentaire_controler();
                    $delete_com->send_delete_com();
                    break;

                case "apply_edit_com":
                    $send_edit_com = new commentaire_controler();
                    $send_edit_com->send_edit_com();
                    break;

            }
    }

} else { // else représente le cas ou aucun parametre n'est spécifié dans l'url, dans la barre de navigateur, on aura juste : www.index.php
    // ici, on fait donc appel a un comportement par defaut, et on fait appel a notre controleur articles, qui sera appelé par défaut

    require "Model/Articles.php";
    require "Controler/article_controler.php";

    $show_articles = new article_controler();
    $show_articles->liste_articles();

}
