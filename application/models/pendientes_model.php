<?php

//Mismo nombre que el archivo, sin el php
class pendientes_model extends CI_Model {

    protected $table = "pendientes";
    protected $pk = "id_tarea";

    public function listar($parametros= array()){
        $this->db->where("estado", EST_PENDIENTE);
        $this->db->order_by($this->pk, "DESC");
        return $this->db->get($this->table)->result_array();
    }

    public function alta($texto= "", $usuario_id=null){
		$datos= array("texto" => $texto
                        "usuario_id" => $usuario_id);
		return $this->guardar($datos);
	}

    public function cambiarestado($estado=EST_PENDIENTE, $id=null){
        $datos= array("estado" => $estado);
        return $this->guardar($datos, $id);
    }

    public function obtener_por_id($id=null){
        $this->db->where($this->pk, $id);
        $this->db->limit(1);
        return $this->db->get($this->table)->row_array();
    }

    protected function guardar($datos= array(), $id=null){
        if (is_null($id)){        
            $this->db->insert($this->table, $datos);
        } else {
            $this->db->where($this->pk, $id);
            $this->db->update($this->table, $datos);
        }
        if ($this->db->affected_rows()){
            return true;
        }
        else return false;
    }

    public function borrar($id=null){
        if(is_null($id) != false){
            $this->db->where($this->pk, $id);
            $this->db->limit(1);
            $this->db->delete($this->table);
            if ($this->db->affected_rows()){
                return true;
            }
        }
        return false;
    }
    
}

?>