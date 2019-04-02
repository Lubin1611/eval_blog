<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 15:32
 */

class article_controler
{

    private $model;


    /**
     * @set model from Model/Articles.php
     */

    public function __construct()
    {

        $this->model = new Articles();

    }

    function liste_articles()
    {

        $listes = $this->model->get_all_articles();
        include "View/listeBillets.php";

    }

    function redir_article()
    {

        $id = $_GET['id'];

        $main_article = $this->model->get_article($id);
        $related_comments = $this->model->related_comment($id);

        include "View/accueil.php";

    }

    function check_login()
    {
        $this->model->login();
        $listes = $this->model->get_all_articles();

        include "View/listeBillets.php";
    }

}

