
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
        $where = "idResident ='2' AND completed = '1'";
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
            //echo json_encode($bothData);
            $bothData1[]=$data;
            //print_r(json_encode($bothData));
        }

        return $bothData1;
        //echo(json_encode($bothData);
    }

    function __destruct() {
        $this->db->close();
    }

}
?>
