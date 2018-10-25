<?php

class DBdump_model extends CI_Controller{

    public function get_oldPeople(){
        $this->db->order_by("age","desc");
        $query = $this->db->get("oldpeople");  //table name
        return $query->result();
    }
}