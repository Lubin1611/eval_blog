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
    private $controler;


    /**
     * @set model from Model/Articles.php
     */

    public function __construct()
    {

        $this->model = new Articles();

    }

    public function liste_articles()
    {

        $listes = $this->model->get_all_articles();
        include "View/listeBillets.php";

    }

    public function redir_article()
    {

        $id = $_GET['id'];

        $main_article = $this->model->get_article($id);
        $related_comments = $this->model->related_comment($id);

        include "View/accueil.php";

    }

    public function submit_article() {

        $titre_article = $_POST['titre_article'];
        $contenu_article = $_POST['contenu_article'];

        filter_var($titre_article, FILTER_SANITIZE_STRING);
        filter_var($contenu_article, FILTER_SANITIZE_STRING);

        $this->model->create_article($titre_article, $contenu_article);

        $listes = $this->model->get_all_articles();

        include "View/listeBillets.php";
    }

    public function submit_com() {

        $id = $_GET['id'];

        $contenu = $_POST['contenu_com'];
        filter_var($contenu, FILTER_SANITIZE_STRING);

        $this->model->create_com($id, $contenu);
        $this->redir_article();

        /*$main_article = $this->model->get_article($id);
        $related_comments = $this->model->related_comment($id);*/


    }


    public function check_login()
    {
        $this->model->login();

        $this->liste_articles();

        /*
        $listes = $this->model->get_all_articles();
        include "View/listeBillets.php"; */
    }

    public function espace_admin() {

        include "View/espace_admin.php";
    }

    public function send_logout() {


        $this->model->logout();
        $listes = $this->model->get_all_articles();

        include "View/listeBillets.php";

    }

    public function to_edit_article() {

        $id = $_GET['idAlt'];
        $selected = $this->model->edit_article($id);

        include "View/vue_edit_article.php";
    }

    public function send_edit_article() {

        $titre = $_POST['titre_article'];
        $contenu = $_POST['contenu_article'];
        $id = $_GET['id'];

        $this->model->apply_edit_article($contenu, $titre, $id);

        $this->liste_articles();

    }

    public function to_edit_com() {

        $id_article = $_GET['id1'];
        $id_com = $_GET['id2'];

        $chosen = $this->model->edit_com($id_article, $id_com);

        include "View/vue_edit_com.php";

    }

    public function send_edit_com() {

        $id_article = $_GET['id1'];
        $id_com = $_GET['id2'];
        $contenu_com = $_POST['contenu_com'];

        $this->model->apply_edit_com($contenu_com, $id_article, $id_com);

        $this->liste_articles();
    }

    public function send_delete_com() {

        $id_article = $_GET['idAlt1'];
        $id_com = $_GET['idAlt2'];

        $this->model->delete_related_comment($id_article, $id_com);

        $this->liste_articles();
    }

    public function send_delete_article() {

        $id_article = $_GET['idAlt2'];

        $this->model->delete_article($id_article);
        $this->model->delete_related_comment($id_article);

        $this->liste_articles();
    }

}

