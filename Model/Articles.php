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
    private $query;


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

    function create_article($titre, $contenu) {

        date_default_timezone_set('Europe/Paris');
        $date = date("d/m/y H:i:s");

        $this->sql = $this->bdd->prepare("INSERT INTO `billet` (date_billet, titre_billet, contenu_billet) VALUES (?,?,?);");

        $this->sql->bindParam(1, $date);
        $this->sql->bindParam(2, $titre);
        $this->sql->bindParam(3, $contenu);

        $this->sql->execute();
    }

    function edit_article($id_art) {

        $this->sql = $this->bdd->query("select * from billet where id_billet = $id_art ")->fetch((PDO::FETCH_ASSOC));
        return $this->sql;

    }

    function edit_com($id_article, $id_com) {

        $this->sql = $this->bdd->query("select * from commentaires where id_billet = $id_article and id_com = $id_com")->fetch((PDO::FETCH_ASSOC));
        return $this->sql;

    }


    function apply_edit_article($contenu, $titre, $id) {

        $this->sql = "UPDATE `billet` SET contenu_billet=?, titre_billet=? WHERE id_billet = ?";
        $this->bdd->prepare($this->sql)->execute([$contenu, $titre, $id]);

    }

    function apply_edit_com($contenu, $id_article, $id_com) {

        $this->sql = "UPDATE `commentaires` SET contenu_com=? WHERE id_billet = ? and id_com = ?";
        $this->bdd->prepare($this->sql)->execute([$contenu, $id_article, $id_com]);

    }

    function delete_article($id) {

        $this->sql = $this->bdd->query("delete from billet where id_billet = $id ");
        $this->sql->execute();
    }

    function delete_related_comment ($id_article) {

        $this->sql = $this->bdd->query("delete from commentaires where id_billet = $id_article");
        $this->sql->execute();
    }



    function create_com($id, $text) {

        date_default_timezone_set('Europe/Paris');
        $date = date("d/m/y H:i:s");
        $author = 'toto';

        $this->sql = $this->bdd->prepare ("INSERT INTO `commentaires` (date_com, auteur_com, contenu_com, id_billet) VALUES (?,?,?,?) ;");

        $this->sql->bindParam(1, $date);
        $this->sql->bindParam(2, $author);
        $this->sql->bindParam(3, $text);
        $this->sql->bindParam(4, $id);

        $this->sql->execute();
    }


    function login() {

        $this->pseudo = $_POST['pseudo'];
        $this->password = $_POST['password'];

        filter_var($this->pseudo, FILTER_SANITIZE_STRING);
        filter_var($this->password, FILTER_SANITIZE_STRING);

        $this->sql = $this->bdd->query("select * from user ");

        $this->sql = $this->sql->fetch();

        if ($this->pseudo == $this->sql['pseudo'] and $this->password == $this->sql['login'])
        {
            session_start();

            $_SESSION['pseudo'] = $this->sql['pseudo'];
            $_SESSION['password'] = $this->sql['login'];
            $_SESSION['rang'] = $this->sql['rang'];

        }

        else
        {
            echo " Mauvais logs !";
        }

    }

    function logout() {

        session_start();
        session_destroy();
    }
}