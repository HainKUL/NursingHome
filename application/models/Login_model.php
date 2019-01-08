<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model
{
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }

    function __destruct() {
        $this->db->close();
    }
}