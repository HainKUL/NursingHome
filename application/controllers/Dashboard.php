<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/15/18
 * Time: 20:22
 */

class Dashboard extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        //if(empty($this->session->userdata('idCaregivers'))) {
        //    $this->session->set_flashdata('flash_data', 'You don\'t have access!');
        //    redirect('Caregiver_controller/login');
        //}
        //$this->load->model('Our_chart_model');
        $this->load->helper('url');
        // $this->load->library('form_validation');
        $this->load->helper('string');
    }

    public function dashboard() {
        $this->load->view('dashboard');
    }

    public function logout() {
        $data = data('idCaregivers', 'email');
        $this->session->unset_userdata($data);
        redirect('/Caregiver_controller/login');
    }

}