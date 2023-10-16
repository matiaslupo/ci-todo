<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model("usuarios_model");
    }

    public function index(){
        redirect("usuarios/main");
    }

    public function main(){
        // $u= $this->usuarios_model->obtener_por_id(1);
        // echo "<pre>";
        // print_r($u);
        // echo "---------------\n";
        // $this->usuarios_model->actuales["orden"][] = array( "campo" => "nick", "sentido" => "DESC");
        // $lista= $this->usuarios_model->listar();
        // print_r($lista);
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
        //redirect("usuarios/main"); instalar xdebug
    }

    public function registro(){
        $this->load->view("usuarios/registro");
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
        redirect("usuarios/registro");
    }

}

?>