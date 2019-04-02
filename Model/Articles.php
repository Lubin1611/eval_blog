<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 01/04/2019
 * Time: 16:23
 */

class Articles
{
    private $bdd;
    private $pseudo;
    private $password;
    private $sql;
    private $userLists;
    private $comments;
    private $selectedArticle;
    private $related;


    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

    function get_all_articles() {

        $this->userLists = $this->bdd->query("select * from billet ")->fetchAll(PDO::FETCH_OBJ);
        return $this->userLists;

    }

    function all_comments() {

        $this->comments = $this->bdd->query("select * from commentaires ")->fetchAll(PDO::FETCH_OBJ);
        return $this->comments;

    }

    function get_article($id) {

        $this->selectedArticle = $this->bdd->query("select * from billet where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->selectedArticle;

    }

    function related_comment($id) {

        $this->related = $this->bdd->query("select * from commentaires where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->related;
    }

    function login() {

        $this->pseudo = $_POST['pseudo'];
        $this->password = $_POST['password'];

        filter_var($this->pseudo, FILTER_SANITIZE_STRING);
        filter_var($this->password, FILTER_SANITIZE_STRING);

        $this->sql = $this->bdd->query("select * from user ");

        $this->sql = $this->sql->fetch();

        if ($this->pseudo = $this->sql['pseudo'] )
        {
            session_start();

            $_SESSION['pseudo'] = $this->sql['pseudo'];
            $_SESSION['password'] = $this->sql['password'];
            $_SESSION['rang'] = $this->sql['rang'];

        }

        else
        {
            echo " Mauvais logs !";
        }

    }
}