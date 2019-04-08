<?php
/**
 * Created by PhpStorm.
 * User: Lubin
 * Date: 07/04/2019
 * Time: 13:54
 */

//j'appelle session_start() dans certaines de mes methodes qui effectuent une redirection.
//J'en ai besoin pour stocker des valeurs de session, notamment SESSION [rang].
// SESSION['rang'] selon la valeur affectée, définit les privilèges de la personne connectée ou non.
// Aucune SESSION stockée = visiteur lambda
//SESSION == 1 : administrateur
//SESSION == 0 : membre connecté, qui peut commenter.

class commentaire_controler
{

    private $model;
    private $id;
    private $id2;
    private $contenu;
    private $author;
    private $id_article;
    private $id_com;
    private $new_id_article;
    private $new_id_com;
    private $contenu_com;
    private $del_id_article;
    private $del_id_com;


    /**
     * @set model from Model/Commentaires.php
     */
    public function __construct()
    {
        $this->model = new Commentaires();
    }


    public function retour_liste()
    {
        $listes = $this->model->redir_liste();
        include "View/listeBillets.php";
    }

    // Ici, j'ai besoin de redir_article_and_com() pour récuperer le contenu de mon article
    // et les commentaires associés, et rediriger vers ma page d'article
    public function redir_article_and_com()
    {
        $this->id = $_GET['id'];

        $main_article = $this->model->get_related_article($this->id);
        $related_comments = $this->model->related_comment($this->id);

        include "View/article.php";
    }

    public function submit_com()
    {
        session_start();

        $this->id2 = $_GET['id'];
        $this->contenu = $_POST['contenu_com'];
        $this->author = $_SESSION['pseudo'];

        filter_var($this->contenu, FILTER_SANITIZE_STRING);
        $this->model->create_com($this->id2, $this->contenu, $this->author);
        $this->redir_article_and_com();

    }

    // to edit_com récupère les données a modifier
    public function to_edit_com()
    {

        $this->id_article = $_GET['id1'];
        $this->id_com = $_GET['id2'];

        $chosen = $this->model->edit_com($this->id_article, $this->id_com);
        include "View/vue_edit_com.php";
    }

    // et send edit enregistre la modification apportée au commentaire dans la bdd.
    public function send_edit_com()
    {
        session_start();
        $this->new_id_article = $_GET['id1'];
        $this->new_id_com = $_GET['id2'];
        $this->contenu_com = $_POST['contenu_com'];


        $this->model->apply_edit_com($this->contenu_com, $this->new_id_article, $this->new_id_com);
        $this->retour_liste();
    }

    public function send_delete_com()
    {
        session_start();

        $this->del_id_article = $_GET['idAlt1'];
        $this->del_id_com = $_GET['idAlt2'];

        $this->model->delete_related_comment($this->del_id_article, $this->del_id_com);
        $this->retour_liste();
    }
}