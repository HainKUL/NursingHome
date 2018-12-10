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
        $this->load->model("Our_chart_model");
        $this->load->model("Bar_chart_model");
    }

    public function dashboard() {
        $data_each1 = $this->Bar_chart_model->get_each();
        $data['data_each1'] = $data_each1;
        $data1 = $this->Our_chart_model->get_avg();
        $data['data1'] = $data1;
        $this->load->view('dashboard', $data);
    }

    public function logout() {

        session_destroy();
        redirect('/Caregiver_controller/login');
    }

}