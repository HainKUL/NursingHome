<?php

class Bar_chart_model extends CI_Model
{
    function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
    }


    public function get_each()
    {
        $where = "idResident ='1' AND completed = '1'";
        $this->db->select('*,idResident');
        $this->db->from('Questions,Submissions');
        $this->db->where($where);
        $this->db->where('Submissions.idSubmissions=Responses.submission');
        $this->db->join('Responses', 'Questions.idQuestions=Responses.questionNum');
        $this->db->join('Categories', 'Categories.idCategories=Questions.categoryID');
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $data['categoryID'] = $row['categoryID'];
            if($_SESSION["lang"] == 'English')
                $data['question'] = $row['question_en'];
            else
                $data['question'] = $row['question_nl'];
            $data['answer'] = $row['answer'];
            if($_SESSION["lang"] == 'English')
                $data['category'] = $row['category_en'];
            else
                $data['category'] = $row['category_nl'];
            $data['timestampStart'] = $row['timestampStart'];
            $rawdata[]=$data;
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
        return $data22;
    }

    public function get_one()
    {
        $where = "idResident ='1' AND completed = '1'";
        $this->db->select('*,idResident');
        $this->db->from('Questions,Submissions');
        $this->db->where($where);
        $this->db->where('Submissions.idSubmissions=Responses.submission');
        $this->db->join('Responses', 'Questions.idQuestions=Responses.questionNum');
        $this->db->join('Categories', 'Categories.idCategories=Questions.categoryID');
        $query = $this->db->get();

        foreach ($query->result_array() as $row) {
            $data['categoryID'] = $row['categoryID'];
            if($_SESSION["lang"] == 'English')
                $data['question'] = $row['question_en'];
            else
                $data['question'] = $row['question_nl'];
            $data['answer'] = $row['answer'];
            if($_SESSION["lang"] == 'English')
                $data['category'] = $row['category_en'];
            else
                $data['category'] = $row['category_nl'];
            $data['timestampStart'] = $row['timestampStart'];
            $rawdata[]=$data;
        }
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
        return $target;
    }

    function __destruct() {
        $this->db->close();
    }
}
?>
