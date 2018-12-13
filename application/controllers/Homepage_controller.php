<?php

class Homepage_controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('parser');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function home()
    {
        $data['page_title'] = 'homepage';
        #$data['content_title_1'] = 'Who are you?';
        #$data['content'] = "<button>resident</button><a href=\"/a18ux04/index.php/Caregiver_controller/login\">caregiver</a>";
        $this->parser->parse('Homepage_view', $data);
    }

    public function residentHome($userID)
    {
        $data['content'] = 'content';
        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('olderadultmenu', $data);
    }

    public function caregiverHome()
    {
        $this->load->model('DBdump_model');
        $oldPeople = $this->DBdump_model->get_oldPeople();
        $data['page_title'] = 'UXWD home page';
        $data['content_title_1'] = 'caregiver homepage';
        $data['content_title_2'] = 'database test';
        $data2['oldPeople'] = $oldPeople;
        $data['content'] = $this->parser->parse('oldPeople', $data2, true);
        $this->parser->parse('Homepage_view', $data);
    }

    public function news($userID)
    {

        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('news_view', $data);
    }

    public function nieuwsblad($userID)
    {


        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('nieuwsblad_view', $data);
    }

    public function standard($userID)
    {


        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('standard_view', $data);
    }

    public function dm($userID)
    {

        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('dm_view', $data);
    }

    public function weathers($userID)
    {

        $data['user_id'] = $userID;
        $_SESSION['id']=$userID;
        $this->parser->parse('weathers', $data);
    }

    public function sportsnews($userID)
    {

        $data['user_id'] = $userID;
        $this->parser->parse('sportsnews', $data);
    }
    public function login(){
        $data['head_message'] = 'Resident Login | Welcome';

        if($_POST) {
            $name = $this->db->escape($_POST['name']);
            $query = "SELECT pinHash, idResidents, name FROM Residents WHERE name = $name LIMIT 1;";
            $result = $this->db->query($query);
            $_SESSION['id']=$result->result()[0]->idResidents;

            if($result->num_rows() === 0)   {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
                redirect('Homepage_controller/login');
            }

            $hash = $result->result()[0]->pinHash;

            if(password_verify($_POST['pincode'], $hash)) { //TODO verify guaranteed forward compatibility with crypt()
                $data = array('id_Residents' => $result->result()[0]->idResidents, 'name' => $result->result()[0]->name);
                $this->session->set_userdata($data);
                redirect('Homepage_controller/residentHome/'.$_SESSION['id']); // Has something to do with not being able to remove index.php in url
            } else {
                $this->session->set_flashdata('flash_data', 'Email or password incorrect!');
                redirect('Homepage_controller/login'); // Has something to do with not being able to remove index.php in url
            }
        }

        $this->load->view("face_login");
    }
}