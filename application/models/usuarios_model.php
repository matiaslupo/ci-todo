<?php

class usuarios_model extends CI_Model {

    protected $table= "usuarios";
    protected $pk= "usuarios_id";

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

    protected function guardar($datos=array(), $id=null){
        if (is_null($id)) {
            $this->db->insert($this->table, $datos);
        } else {
            $this->db->where($this->pk, $id);
            $this->db->limit(1);
            $this->db->update($this->table, $datos);
        }
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }

}

?>