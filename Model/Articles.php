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

    function get_all_articles()
    {
        $this->userLists = $this->bdd->query("select * from billet ")->fetchAll(PDO::FETCH_OBJ);
        return $this->userLists;
    }



    function get_article($id)
    {
        $this->selectedArticle = $this->bdd->query("select * from billet where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->selectedArticle;
    }



    function create_article($titre, $contenu)
    {
        date_default_timezone_set('Europe/Paris');
        $date = date("d/m/y H:i:s");

        $this->sql = $this->bdd->prepare("INSERT INTO `billet` (date_billet, titre_billet, contenu_billet) VALUES (?,?,?);");
        $this->sql->bindParam(1, $date);
        $this->sql->bindParam(2, $titre);
        $this->sql->bindParam(3, $contenu);
        $this->sql->execute();
    }

    function edit_article($id_art)
    {
        $this->sql = $this->bdd->query("select * from billet where id_billet = $id_art ")->fetch((PDO::FETCH_ASSOC));
        return $this->sql;
    }


    function apply_edit_article($contenu, $titre, $id)
    {
        $this->sql = "UPDATE `billet` SET contenu_billet=?, titre_billet=? WHERE id_billet = ?";
        $this->bdd->prepare($this->sql)->execute([$contenu, $titre, $id]);
    }


    function delete_article($id)
    {
        $this->sql = $this->bdd->query("delete from billet where id_billet = $id ");
        $this->sql->execute();
    }


    function related_comment($id)
    {
        $this->related = $this->bdd->query("select * from commentaires where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->related;
    }

    function delete_comments($id_article) {

        $this->sql = $this->bdd->query("delete from commentaires where id_billet = $id_article");
        $this->sql->execute();

    }

}