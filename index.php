<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:04
 */


if (isset($_GET['page'])) {
    switch ($_GET['page']) {

        case "selected_one":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $selected = new article_controler();
            $selected->redir_article();

        case "connection":
            require "Model/Articles.php";
            require "Controler/article_controler.php";

            $login = new article_controler();
            $login->check_login();


    }
}

else {

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


















