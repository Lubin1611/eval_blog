<?php
/**
 * Created by PhpStorm.
 * User: Lubin
 * Date: 07/04/2019
 * Time: 13:54
 */

class user_controler
{

    private $model;
    private $nom;
    private $prenom;
    private $pseudo;
    private $password;
    private $rang;
    private $log_pseudo;
    private $log_password;

    /**
     * @set model from Model/Users.php
     */

    public function __construct()
    {

        $this->model = new Users();

    }

    public function sign_up()
    {

        include "View/vue_inscription.php";

    }


    public function submit_sign_up()
    {

        $this->nom = $_POST['nom'];
        filter_var($this->nom, FILTER_SANITIZE_STRING);

        $this->prenom = $_POST['prenom'];
        filter_var($this->prenom, FILTER_SANITIZE_STRING);

        $this->pseudo = $_POST['login_name'];
        filter_var($this->pseudo, FILTER_SANITIZE_STRING);

        $this->password = sha1($_POST['mdp']);
        filter_var($this->password, FILTER_SANITIZE_STRING);

        $this->rang = 0;

        $this->model->inscription($this->nom, $this->prenom, $this->pseudo, $this->password, $this->rang);

        $this->redir_articles();

    }

    public function check_login()
    {

        $this->log_pseudo = $_POST['pseudo'];
        $this->log_password = sha1($_POST['password']);

        filter_var($this->log_pseudo, FILTER_SANITIZE_STRING);
        filter_var($this->log_password, FILTER_SANITIZE_STRING);

        $this->model->login($this->log_password, $this->log_pseudo);

        $this->redir_articles();

    }


    public function espace_admin()
    {
        include "View/espace_admin.php";
    }


    public function send_logout()
    {
        $this->model->logout();
        $listes = $this->model->redir_all_articles();

        include "View/listeBillets.php";
    }

    public function redir_articles()
    {
        $listes = $this->model->redir_all_articles();

        include "View/listeBillets.php";
    }

}