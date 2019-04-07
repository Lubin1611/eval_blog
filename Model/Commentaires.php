<?php
/**
 * Created by PhpStorm.
 * User: Lubin
 * Date: 07/04/2019
 * Time: 13:54
 */

class Commentaires
{

    private $sql;
    private $articles;
    private $comments;
    private $related;
    private $selectedArticle;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=id7331055_blog;charset=utf8', 'id7331055_tobby', 'exobase',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }


    function create_com($id, $text, $author)
    {
        date_default_timezone_set('Europe/Paris');
        $date = date("d/m/y H:i:s");


        $this->sql = $this->bdd->prepare("INSERT INTO `commentaires` (date_com, auteur_com, contenu_com, id_billet) VALUES (?,?,?,?) ;");

        $this->sql->bindParam(1, $date);
        $this->sql->bindParam(2, $author);
        $this->sql->bindParam(3, $text);
        $this->sql->bindParam(4, $id);

        $this->sql->execute();
    }



    function all_comments()
    {
        $this->comments = $this->bdd->query("select * from commentaires ")->fetchAll(PDO::FETCH_OBJ);
        return $this->comments;
    }

    function delete_related_comment($id_article, $id_com)
    {
        $this->sql = $this->bdd->query("delete from commentaires where id_billet = $id_article and id_com = $id_com");
        $this->sql->execute();
    }

    function related_comment($id)
    {
        $this->related = $this->bdd->query("select * from commentaires where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->related;
    }


    function edit_com($id_article, $id_com)
    {
        $this->sql = $this->bdd->query("select * from commentaires where id_billet = $id_article and id_com = $id_com")->fetch((PDO::FETCH_ASSOC));
        return $this->sql;
    }

    function apply_edit_com($contenu, $id_article, $id_com)
    {
        $this->sql = "UPDATE `commentaires` SET contenu_com=? WHERE id_billet = ? and id_com = ?";
        $this->bdd->prepare($this->sql)->execute([$contenu, $id_article, $id_com]);
    }

    function get_related_article($id)
    {
        $this->selectedArticle = $this->bdd->query("select * from billet where id_billet = $id ")->fetchAll(PDO::FETCH_OBJ);
        return $this->selectedArticle;
    }

    function redir_liste()
    {
        $this->articles = $this->bdd->query("select * from billet ")->fetchAll(PDO::FETCH_OBJ);
        return $this->articles;
    }

}