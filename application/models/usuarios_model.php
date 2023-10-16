<?php

class usuarios_model extends CI_Model {

    //variables de infraestructura
    protected $table= "usuarios";
    protected $pk= "usuario_id";
    protected $fields= array("nick", "password", "ultlogin", "rol", "estado");
    public $actuales= array(); //cambiar despues a protected

    // public function __set($var=false, $field=""){

    // }

    public function alta($nick="", $password=""){
        $datos= array(  "nick" => $nick,
                        "password" => $password);
        return $this->guardar($datos);
    }

    public function login($nick="", $password=""){
        $this->db->where("nick", $nick);
        $this->db->where("password", $password);
        $this->db->limit(1);
        $res= $this->db->get($this->table);
        if ($res->num_rows())
            return $res->row_array();
        return null;
        //return $this->db->get($this->table)->row_array();        
    }

    public function crear($datos=array()){
        $this->db->insert($this->table, $datos);
        
            // $this->db->where($this->pk, $id);
            // $this->db->limit(1);
            // $this->db->update($this->table, $datos);
        
        if ($this->db->affected_rows()) {
            return $this->db->insert_id();
        }
        return false;
    }

    public function editar($datos=array(), $id=null){
        if ($id != null){
            $this->db->where($this->pk, $id);
            $this->db->limit(1);
            $this->db->update($this->table, $datos);
        }
        
        // return $this->db->affected_rows() > 0;
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }

    public function borrar($id=false, $logico=true){
        if ($id){            
            if(is_array($id)){
                $this->db->where_in($this->pk, $id);
            } else {
                $this->db->where($this->pk, $id);
            }            
            if ($logico){
                $this->db->set("estado", USREST_INACTIVO);
                $this->db->update($this->table);
            } else {
                $this->db->delete($this->table);
            }
        }
        return $this->db->affected_rows() > 0;
    }

    public function obtener_por_id($id=false){
        $this->db->where($this->pk, $id);
        $this->db->limit(1);
        $this->db->join("roles", "roles.rol_id=".$this->table.".rol");
        $this->db->select($this->table.".*, roles.nombre AS rol_nombre", false); //para evitar automatizar el filtrado
        $rec= $this->db->get($this->table);
        return $rec->row_array();
    }

    public function listar($params=array()){
        if(isset($this->actuales["orden"])){
            foreach ($this->actuales["orden"] as $o) {
                $this->db->order_by($o["campo"], $o["sentido"]);
            }
        }

        $recset= $this->db->get($this->table);
        return $recset->result_array();
    }

}

?>