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
        $data['page_title']      = 'UXWD home page';
        $data['content_title_1'] = 'caregiver homepage';
        $data['content_title_2'] = 'database test';
        $data2['oldPeople']      = $oldPeople;
        $data['content']         = $this->parser->parse('oldPeople', $data2, true);
        $this->parser->parse('Homepage_view', $data);
    }

    public function news()
    {
        $this->load->view("news_view");
    }

    public function nieuwsblad()
    {
        $this->load->view("nieuwsblad_view");
    }

    public function standard()
    {
        $this->load->view("standard_view");
    }

    public function dm()
    {
        $this->load->view("dm_view");
    }

    public function weathers()
    {
        $this->load->view("weathers");
    }

    public function sportsnews()
    {
        $this->load->view("sportsnews");
    }

    public function login(){
        $data['head_message'] = 'Resident Login | Welcome';
        if($_POST) {
            $name      = $this->db->escape($_POST['name']);
            $firstname = $this->db->escape($_POST['firstname']);
            $query     = "SELECT pinHash, idResidents, preferences name FROM Residents "
                        ."WHERE name = $name AND firstname = $firstname LIMIT 1;";
            $result         = $this->db->query($query);
            $rows           = $result->result();
            $_SESSION['id'] = $rows[0]->idResidents;

            //$lang = $rows[0]->preferences;
            //$lang->bindColumn(1,$lang,PDO::PARAM_LOB);
            //$_SESSION['lang']=$lang;


            // get language
            $sql = "SELECT preferences FROM Residents "
                ."WHERE name = $name AND firstname = $firstname LIMIT 1";
            $result = $this->db->query($sql);
            $lang = $result->result_array()[0]["preferences"];
            $_SESSION['lang']=$lang;


            if($result->num_rows() === 0) {
                $this->session->set_flashdata('flash_data', 'name or password incorrect!');
                redirect('Homepage_controller/login');
            }

            $hash = $rows[0]->pinHash;
            if(password_verify($_POST['pincode'], $hash)) { //TODO deduplicate?
                $data = array('id_Residents' => $rows[0]->idResidents, 'name' => $rows[0]->name);
                $this->session->set_userdata($data);
                $_SESSION["resident"]="yes";
                if($lang == 'English') $lang="english";
                echo "<script>window.location.href='".base_url()."MultiLanguageSwitcher/switcher/'".$lang.";</script>";
                redirect('Homepage_controller/residentHome/'.$_SESSION['id']); // Has something to do with not being able to remove index.php in url

            } else {
                $success = "Login failed: wrong password";
                echo "<script> alert('".$success."'); window.location.href='".base_url()."index.php/Face_Login_controller/face_login'; </script>";
            }
        }
        $this->load->view("face_login");
    }

    public function logout(){
        session_destroy();
        redirect('Homepage_controller/home');
    }

    public function successlogin($userId){
        $_SESSION['resident']="yes";
        $this->residentHome($userId);
        $lang=$_SESSION['lang'];
         //TODO remove this circumvent (and fix the bug it avoids)
        if($lang == 'English') $lang='english';
        echo "<script>window.location.href='".base_url()."index.php/MultiLanguageSwitcher/switcher/'".$lang.";</script>";
    }
}