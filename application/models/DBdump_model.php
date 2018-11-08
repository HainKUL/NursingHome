<?php

class DBdump_model extends CI_Controller{

    public function get_oldPeople(){
        $this->db->order_by("dateOfBirth","desc");
        $query = $this->db->get("Residents");  //table name
        return $query->result();
    }
}