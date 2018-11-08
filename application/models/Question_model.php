<?php
/**
 * Created by IntelliJ IDEA.
 * User: Haien
 * Date: 11/2/2018
 * Time: 12:55
 */


class Question_model extends CI_Model{
    public function get_questions(){
        //$this->db->order_by("date","desc");
        $query=$this->db->get("Question");//table name
        return $query->result();
    }

}