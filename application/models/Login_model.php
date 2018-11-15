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
    public function validate_user($data) {
        $this->db->where('email', $data['email']);
        $this->db->where('passwordHash', md5($data['password']));
        return $this->db->get('Caregivers')->row();
    }
    function __destruct() {
        $this->db->close();
    }
}