<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct(){
		parent::__construct(); //para llamar al constructor de CI_Controller
		$this->load->model("pendientes_model");

	}

	public function index()
	{
		redirect("app/main");
	}

	public function main()
	{
		// $datos= array(); //variable carry de datos, desaparece al ser enviada a la vista
		// $this->db->order_by("id_tarea", "DESC");
		// $datos["pendientes"]= $this->db->get("pendientes")->result_array(); //en la vista se accede como "pendientes" directamente

		//usando el modelo
		$datos= array();
		$datos["pendientes"]= $this->pendientes_model->listar();
		$this->load->view('principal', $datos);
	}

	public function guardar()
	{
		$texto= $this->input->post("tarea");
		if (strlen($texto) > 0){
			$id= $this->session->get_flashdata("IDUSR");
			if ($this->pendientes_model->alta($texto, $id))
				$this->session->set_flashdata("OP", "OK");
			else {
				$this->session->set_flashdata("OP", "ERROR");
			}
		} 
		redirect('app/main');
	}

	public function borrar($id=""){
		$this->pendientes_model->borrar($id);
		redirect("app/main");
	}

	public function completartarea($id=null){
		if (is_null($id) == false){
			$this->pendientes_model->cambiarestado(EST_TERMINADO, $id);
		}
		redirect("app/main");
	}

	public function modificar($id=""){
		$texto= $this->input->post("tarea");
		if (strlen($texto) > 0){
			$this->db->set("texto", $texto);			
			$this->db->where("id_tarea", $id);
			$this->db->limit(1);
			$this->db->update('pendientes');
			$this->session->set_flashdata("OP", "MODIF_OK");
		} else {
			$this->session->set_flashdata("OP", "MODIF_ERROR");
		}
		redirect('app/main');
	}
}
