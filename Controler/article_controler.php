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
    private $id;
    private $id2;
    private $titre_article;
    private $contenu_article;
    private $titre;
    private $contenu;
    private $id3;
    private $id_article;


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

        session_start();

        include "View/listeBillets.php";
    }

    public function redir_article()
    {
        $this->id = $_GET['id'];

        session_start();

        $main_article = $this->model->get_article($this->id);
        $related_comments = $this->model->related_comment($this->id);
        include "View/accueil.php";
    }

    public function submit_article()
    {
        $this->titre_article = $_POST['titre_article'];
        $this->contenu_article = $_POST['contenu_article'];

        filter_var($this->titre_article, FILTER_SANITIZE_STRING);
        filter_var($this->contenu_article, FILTER_SANITIZE_STRING);


        $this->model->create_article($this->titre_article, $this->contenu_article);
        $listes = $this->model->get_all_articles();
        include "View/listeBillets.php";
    }


    public function to_edit_article()
    {
        $this->id2 = $_GET['idAlt'];

        $selected = $this->model->edit_article($this->id2);
        include "View/vue_edit_article.php";
    }

    public function send_edit_article()
    {
        $this->titre = $_POST['titre_article'];
        $this->contenu = $_POST['contenu_article'];
        $this->id3 = $_GET['id'];


        $this->model->apply_edit_article($this->contenu, $this->titre, $this->id3);
        $this->liste_articles();
    }


    public function send_delete_article()
    {
        $this->id_article = $_GET['idAlt2'];

        $this->model->delete_article($this->id_article);

        $this->model->delete_comments($this->id_article);

        $this->liste_articles();
    }


}

