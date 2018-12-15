<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
    public function dashboard_reg(){
        $errors = array();
        if ($_POST) {
            // receive all input values from the form
            $name = $this->db->escape($_POST['name']);
            $firstname = $this->db->escape($_POST['firstname']);
            $birth_day = $this->db->escape($_POST['Birthday_day']);
            $birth_month = $this->db->escape($_POST['Birthday_Month']);
            $birth_year = $this->db->escape($_POST['Birthday_Year']);
            $dateOfbirth= $birth_year.'-'.$birth_month.'-'.$birth_day;
            $dateOfBirth=date("Y-m-d",strtotime($dateOfbirth));
            $roomNumber = $this->db->escape($_POST['Room_Id']);
            $bedNumber = $this->db->escape($_POST['Bed_Id']);
            $Pin_Code = $_POST['Pin_Code'];
            $Pin_Code_2 = $_POST['Pin_Code_2'];
            $lang= $this->db->escape($_POST['Radio']);
            $floor=$this->db->escape($_POST['floor']);
            $nr=$this->db->escape($_POST['Mobile_Number']);
            $pref_array=array($lang,$floor,$nr);
            $pref=serialize($pref_array);



            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($name)) { array_push($errors, "Name is required"); }
            if (empty($firstname)) { array_push($errors, "Firstname is required"); } //TODO remove this restriction!
            if (empty($dateOfBirth)) { array_push($errors, "Date of birth is required"); }
            if (empty($roomNumber)) { array_push($errors, "Roomnumber is required"); }
            if (empty($bedNumber)) { array_push($errors, "Bednumber is required"); }
            if (empty($_POST['Pin_Code'])) array_push($errors, "Pincode is required");
            if (empty($_POST['Pin_Code_2'])) array_push($errors, "Pincode2 is required");
            if ($Pin_Code != $Pin_Code_2)  array_push($errors, "Pincodes do not match");

            // first check the database to make sure
            // a user does not already exist with the same username and/or email

            $salt = substr(str_replace('+','.',base64_encode(md5(mt_rand(), true))),0,16);
            // how many times the string will be hashed
            $rounds = 10000;
            // pass in the password, the number of rounds, and the salt
            $pinhash =  crypt($Pin_Code, sprintf('$6$rounds=%d$%s$', $rounds, $salt));
            $pinhash_2 =  crypt($Pin_Code_2, sprintf('$6$rounds=%d$%s$', $rounds, $salt));

            // Finally, register user if there are no errors in the form
            if (count($errors) == 0) {
                $query = "INSERT INTO Residents (name, firstName,dateOfBirth,roomNumber,bedNumber,pinHash,pinSalt,preferences) VALUES($name, $firstname,'$dateOfBirth',$roomNumber,$bedNumber,'$pinhash','$salt',$lang)";
                $this->db->query($query);
                $query2 = "SELECT idResidents FROM a18ux04.Residents ORDER BY idResidents DESC LIMIT 1;";
                $result2 = $this->db->query($query2)->result_array()[0]["idResidents"];
                $_SESSION['reg_id'] = $result2;
                $_SESSION['success'] = "Registration succesfull, register Face-ID";
                header('location: ../Face_Login_controller/face_registration');

            }
            else{
                $errorstring = "";
                foreach($errors as $err)
                {
                    $errorstring = $errorstring.$err.".   ";
                }
                $succes = "Registration failed: ".$errorstring;
                echo "<script> alert('".$succes."'); window.location.href='".base_url()."Dashboard/dashboard'; </script>";
            }

        }

    }



    public function logout() {

        session_destroy();
        redirect('/Homepage_controller/home');
    }
    public function registrationsucces($userId){
        $_SESSION['resident']="yes";
        redirect('/Dashboard/dashboard');

    }

}
