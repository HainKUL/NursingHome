<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/26/18
 * Time: 19:20
 */

class Our_chart_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    public function get_all_questions()
    {
        return $this->db->get('Questions')->result();
    }

    function __destruct() {
        $this->db->close();
    }
}