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

    public function dashboard($residentID = 26) {    //TODO remove this default
        /*graphs*/
        $data_each1 = $this->Bar_chart_model->get_each();
        $data['data_each1'] = $data_each1;
        //$data_one = $this->Bar_chart_model->get_one();
        //$data['one'] =   $data_one;
        //$data_avg = $this->Bar_chart_model->get_average();
        //$data['data_avg'] =  $data_avg;
        $data2 = $this->Our_chart_model->get_avg();
        $data['data2'] = $data2;

        $sql1 = "SELECT category,catergoryID,submission,timestampStart,AVG(answer) AS answer FROM ((Questions
               INNER JOIN Responses
               ON Questions.idQuestions=Responses.questionNum)
               INNER JOIN Submissions
               ON Submissions.idSubmissions=Responses.submission)
               WHERE completed = '1' AND idResident = '$residentID' AND submission IN (
               #SELECT max(idSubmissions) as submission
               SELECT idSubmissions as submission
               FROM Submissions
               WHERE completed = '1' AND idResident = '$residentID' )
               GROUP BY  category,catergoryID,timestampStart,submission
               ORDER BY submission DESC,catergoryID";
        $query = $this->db->query($sql1);

        foreach ($query->result_array() as $row)
        {
            $data['category'] = $row['category'];
            if((time()+3600)-strtotime($row['timestampStart']) < 86400)
            {
                $data['timestampStart']= substr($row['timestampStart'],11,5);
            }
            else
            {
                $data['timestampStart']= substr($row['timestampStart'],5,11);
            }
            $data['answer'] = $row['answer'];
            //echo(json_encode($query));
            $data4[]=$data;
            //echo(json_encode($data));
        }

        if (empty($data4))
        {
            $data1 = null;
        }
        else{

                //change_array_key( $rawdata, $old_key, $new_key)

                foreach ($data4 as $value)
                {
                    $time= $value['timestampStart'];
                    $x[$time][]= $value;
                }
                $bothData= $x;

                foreach ($bothData as $key =>$v)
                {
                    $data11["key"] = $key;
                    $data11["values"] = $v;
                    $data22[]=$data11;
                    unset($data11);
                }
                $sliced_array = array_slice($data22, 0, 3);
                $data1 = $sliced_array;
            }

        $data['data1'] = $data1;


        $where = "idResident ='$residentID' AND completed = '1'";
        $this->db->select('*,idResident');
        $this->db->from('Questions,Submissions');
        $this->db->where($where);
        $this->db->where('Submissions.idSubmissions=Responses.submission');
        $this->db->join('Responses', 'Questions.idQuestions=Responses.questionNum');
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $data['catergoryID'] = $row['catergoryID'];
            $data['question'] = $row['question'];
            //$data['questionNum'] = $row['questionNum'];
            $data['answer'] = $row['answer'];
            $data['category'] = $row['category'];
            //$data['timestampStart']= substr($row['timestampStart'],0,16);
            $data['timestampStart'] = $row['timestampStart'];
            //echo json_encode($bothData);
            $rawdata[]=$data;
            //print_r(json_encode($bothData));
        }


        if (empty($rawdata))
        {
            $data_one = null;
            $data_each1=null;
        }
        else{
            foreach ($rawdata as $value)
            {
                $time= $value['timestampStart'];
                $x[$time][]= $value;
            }
            $bothData= $x;

            $sliced_array = array_slice($bothData, 0, 1);

            foreach($sliced_array as $v)
            {
                $target = $v;
            }

            $data_one = $target;
            $data['one'] =   $data_one;

            foreach ($bothData as $key =>$v)
            {
                $data11["key"] = $key;
                $data11["values"] = $v;
                $data22[]=$data11;
                unset($data11);
            }

            //$data_each1=$data22;
            $data['data_each1'] = $data_each1;

        }

        /*resident info*/
        $sql = "SELECT * FROM Residents WHERE idResidents = '$residentID ' LIMIT 1";
        $result = $this->db->query($sql);
        $data['theFirstName'] =    $result->result_array()[0]["firstName"];
        $data['name'] =         $result->result_array()[0]["name"];
        $data['dateOfBirth'] =  $result->result_array()[0]["dateOfBirth"];
        $data['roomNumber'] =   $result->result_array()[0]["roomNumber"];
        $data['bedNumber'] =    $result->result_array()[0]["bedNumber"];

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
    public function dashboard_register()
    {
        $data = 'oeps';
        $this->load->view('dashboard_register', $data);
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
