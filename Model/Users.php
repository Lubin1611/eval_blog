<?php
/**
 * Created by PhpStorm.
 * User: Lubin
 * Date: 07/04/2019
 * Time: 13:55
 */

class Users
{

    private $articles;
    private $sql;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=id7331055_blog;charset=utf8', 'id7331055_tobby', 'exobase',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

    }

     function inscription($nom, $prenom, $pseudo, $password, $rang) {

        $this->sql = $this->bdd->prepare("INSERT INTO `user` (nom, prenom, pseudo, login, rang) VALUES (?,?,?,?,?);");

        $this->sql->bindParam(1, $nom);
        $this->sql->bindParam(2, $prenom);
        $this->sql->bindParam(3, $pseudo);
        $this->sql->bindParam(4, $password);
        $this->sql->bindParam(5, $rang);

        $this->sql->execute();

    }


     public function login($password, $pseudo)
    {



        $this->sql = $this->bdd->query("select * from user where login = '$password' and pseudo = '$pseudo' ");

        $this->sql = $this->sql->fetch();

        if ($password == $this->sql['login'] and $pseudo == $this->sql['pseudo']) {

            session_start();

            $_SESSION['nom'] = $this->sql['nom'];
            $_SESSION['prenom'] = $this->sql['prenom'];
            $_SESSION['pseudo'] = $this->sql['pseudo'];
            $_SESSION['password'] = $this->sql['login'];
            $_SESSION['rang'] = $this->sql['rang'];



        } else {

            echo " Mauvais logs !";
        }
    }


     public function logout()
    {
        session_start();

        session_destroy();
    }

    public function redir_all_articles()
    {

        $this->articles = $this->bdd->query("select * from billet ")->fetchAll(PDO::FETCH_OBJ);
        return $this->articles;

    }
}