<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/15/18
 * Time: 17:37
 */
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