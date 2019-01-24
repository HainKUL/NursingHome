<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->model("Our_chart_model");
        $this->load->model("Bar_chart_model");
    }


    public function dashboard($residentID = -1)
    {
        /*graphs*/
       // $data_each1 = $this->Bar_chart_model->get_each();
        //$data['data_each1'] = $data_each1;
        //$data_one = $this->Bar_chart_model->get_one();
        //$data['one'] =   $data_one;
        //$data_avg = $this->Bar_chart_model->get_average();
        //$data['data_avg'] =  $data_avg;
        $data2 = $this->Our_chart_model->get_avg();
        $data['data2'] = $data2;

        $sql1 = "SELECT category,category_nl,category_en,categoryID,submission,timestampStart,AVG(answer) AS answer FROM (((Questions
               INNER JOIN Responses
               ON Questions.idQuestions=Responses.questionNum)
               INNER JOIN Submissions
               ON Submissions.idSubmissions=Responses.submission)
               INNER JOIN Categories
               ON Categories.idCategories=Questions.categoryID)
               WHERE completed = '1' AND idResident = '$residentID' AND submission IN (
               #SELECT max(idSubmissions) as submission
               SELECT idSubmissions as submission
               FROM Submissions
               WHERE completed = '1' AND idResident = '$residentID' )
               GROUP BY  category,categoryID,timestampStart,submission
               ORDER BY submission DESC,categoryID";
        $query = $this->db->query($sql1);

        foreach ($query->result_array() as $row)
        {
            if($_SESSION["lang"] == 'English')
                $data['category'] = $row['category_en'];
            else
                $data['category'] = $row['category_nl'];
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


        $where = "idResident ='$residentID' AND completed = '1' ";
        $this->db->select('*,idResident');
        $this->db->from('Questions,Submissions');
        $this->db->where($where);
        $this->db->where('Submissions.idSubmissions=Responses.submission');
        $this->db->join('Responses', 'Questions.idQuestions=Responses.questionNum');
        $this->db->join('Categories', 'Categories.idCategories=Questions.categoryID');
        $query1 = $this->db->get();

        foreach ($query1->result_array() as $row) {
            $data['categoryID'] = $row['categoryID'];
            if($_SESSION["lang"] == 'English')
                $data['question'] = $row['question_en'];
            else
                $data['question'] = $row['question_nl'];
            //$data['questionNum'] = $row['questionNum'];
            $data['answer'] = $row['answer'];
            if($_SESSION["lang"] == 'English')
                $data['category'] = $row['category_en'];
            else
                $data['category'] = $row['category_nl'];
            //$data['timestampStart']= substr($row['timestampStart'],0,16);
            $data['timestampStart'] = $row['timestampStart'];
            //echo json_encode($bothData);
            $rawdata1[]=$data;
            //print_r(json_encode($bothData));
        }


        if (empty($rawdata1))
        {
            $data_one = null;
            $data_each1=null;
        }
        else{
            foreach ($rawdata1 as $value)
            {
                $time= $value['timestampStart'];
                $x1[$time][]= $value;
            }
            $bothData= $x1;

            $sliced_array1 = array_slice($bothData, 0, 1);

            foreach($sliced_array1 as $v)
            {
                $target1 = $v;
            }

            $data_one = $target1;
            $data['one'] =   $data_one;

            foreach ($bothData as $key =>$v)
            {
                $data111["key"] = $key;
                $data111["values"] = $v;
                $data222[]=$data111;
                unset($data111);
            }

            $data_each1=$data222;
            $data['data_each1'] = $data_each1;

        }

        /*resident info*/
        if($residentID == -1) // default, show first resident
            $sql = "SELECT firstName, name, dateOfBirth, roomNumber, bedNumber FROM Residents "
                  ."ORDER BY firstName LIMIT 1";
        else
            $sql = "SELECT firstName, name, dateOfBirth, roomNumber, bedNumber FROM Residents "
                  ."WHERE idResidents = $residentID LIMIT 1";
        $result = $this->db->query($sql);
        $data['theFirstName'] = $result->result_array()[0]["firstName"];
        $data['name']         = $result->result_array()[0]["name"];
        $data['dateOfBirth']  = $result->result_array()[0]["dateOfBirth"];
        $data['roomNumber']   = $result->result_array()[0]["roomNumber"];
        $data['bedNumber']    = $result->result_array()[0]["bedNumber"];

        $this->load->view('dashboard', $data);
    }


    public function dashboard_reg()
    {
        $errors = array();
        if ($_POST) {
            // receive all input values from the form
            $name           = $this->db->escape($_POST['name']);
            $firstname      = $this->db->escape($_POST['firstname']);
            $birth_day      = $this->db->escape($_POST['birthDay']);
            $roomNumber     = $this->db->escape($_POST['Room_Id']);
            $bedNumber      = $this->db->escape($_POST['Bed_Id']);
            $Pin_Code       = $_POST['Pin_Code'];
            $Pin_Code_2     = $_POST['Pin_Code_2'];
            $lang           = $this->db->escape($_POST['Radio']);
            $floor          = $this->db->escape($_POST['floor']);
            $nr             = $this->db->escape($_POST['Mobile_Number']);

            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($name))                array_push($errors, "Name is required");
            if (empty($firstname))           $firstname = ""; // not everyone has a first name. Blank field in this case
            if (empty($birth_day))           array_push($errors, "Date of birth is required");
            if (empty($roomNumber))          array_push($errors, "Roomnumber is required");
            if (empty($bedNumber))           array_push($errors, "Bednumber is required");
            if (empty($_POST['Pin_Code']))   array_push($errors, "Pincode is required");
            if (empty($_POST['Pin_Code_2'])) array_push($errors, "Pincode2 is required");
            if ($Pin_Code != $Pin_Code_2)    array_push($errors, "Pincodes do not match");

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
                $query = "INSERT INTO Residents (name, firstName,dateOfBirth,roomNumber,bedNumber,pinHash,preferences) "
                ."VALUES($name, $firstname,$birth_day,$roomNumber,$bedNumber,'$pinhash',$lang)";
                $this->db->query($query);
                $query2 = "SELECT idResidents FROM a18ux04.Residents ORDER BY idResidents DESC LIMIT 1;";
                $result2 = $this->db->query($query2)->result_array()[0]["idResidents"];
                $_SESSION['reg_id'] = $result2;
                $_SESSION['success'] = "Registration succesful, register Face-ID";
                header('location: ../Face_Login_controller/face_registration');
            } else {
                $errorstring = "";
                foreach($errors as $err) $errorstring = $errorstring.$err.".   ";
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


    public function logout()
    {
        session_destroy();
        redirect('/Homepage_controller/home');
    }


    public function registrationsucces($userId)
    {
        $_SESSION['resident']="yes";
        redirect('/Dashboard/dashboard');

    }




}
