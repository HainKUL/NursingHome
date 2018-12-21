
<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/26/18
 * Time: 19:20
 */

class Bar_chart_model extends CI_Model
{
    function __construct(){

        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        // $this->load->library('session');
    }


    public function get_each()
    {
        $where = "idResident ='1' AND completed = '1'";
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

        foreach ($rawdata as $value)
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
        /*foreach ($rawdata as $value)
        {
            $time= $value['timestampStart'];
            $x[$time][]= $value;
        }
        $bothData1[]= $x;*/
        //$sliced_array = array_slice($bothData1, 0, 1);

        return $data22;
        //echo(json_encode($bothData1);
    }

    public function get_one()
    {
        $where = "idResident ='1' AND completed = '1'";
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
            $data['timestampStart'] = $row['timestampStart'];
            //echo json_encode($bothData);
            $rawdata[]=$data;
            //print_r(json_encode($bothData));
        }
        foreach ($rawdata as $value)
        {
            $time= $value['timestampStart'];
            $x[$time][]= $value;
        }
        $bothData= $x;

        //foreach ($bothData as $key =>$v)
        //{
           // $data11["key"] = $key;
        //    $data11[] = $v;
           // $data22[]=$data11;
        //    unset($data11);
        //}
        /*foreach ($rawdata as $value)
        {
            $time= $value['timestampStart'];
            $x[$time][]= $value;
        }
        $bothData1[]= $x;*/
        $sliced_array = array_slice($bothData, 0, 1);
        foreach($sliced_array as $v)
        {
            $target = $v;
        }
        return $target;
        //echo(json_encode($bothData1);
    }

    function __destruct() {
        $this->db->close();
    }

}
?>
