<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("usuarios_model");
    }

    public function index(){
        redirect("login/main");
    }

    public function main(){
        $this->load->view("login/login");
    }

    public function login(){
        $nick= $this->input->post("nick");
        $password= $this->input->post("password");
        if ((strlen($nick) > 0) and (strlen($password) > 0)){
            $password= md5($password);
            $usr= $this->usuarios_model->login($nick, $password);           
            if ( $usr != null) {
                $this->session->set_flashdata("USUARIO", $nick);
                $this->session->set_flashdata("IDUSR", $usr["id"]);
                redirect("app/main");
                exit();
            }
            error_log("Login invalido.");
        }
        redirect("login/main");
    }

    public function registro(){
        $this->load->view("login/registro");
    }

    public function nuevo(){
        $nick= $this->input->post("nick");
        $password= $this->input->post("password");
        $repetir_pass= $this->input->post("repetir_pass");
        if ((strlen($nick) > 0) and (strlen($password) > 0) and (strlen($repetir_pass) > 0) and ($password == $repetir_pass)) {
            $password= md5($password);
            if (($this->usuarios_model->alta($nick, $password))){
                $this->session->set_flashdata("USUARIO", $nick);
                redirect("app/main");
                exit();
            }
        }
        redirect("login/registro");
    }

}

?>