<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<?php
/**
 * Created by PhpStorm.
 * User: Weihao
 * Date: 11/26/18
 * Time: 19:20
 */



   //public function get_all_questions()
   // {
        //$result = $this->db->query('SELECT catergoryID, question FROM Questions')->result_array();

        /*$this->db->select('catergoryID,answer');
        $this->db->from('Questions,Responses');
        $this->db->where(' Questions.idQuestions=Responses.question');
        $query = $this->db->get();
        //print_r(json_encode($query));*/

        $where = "idResident ='1' AND completed = '1'";
        $this->db->select('*,idResident');
        $this->db->from('Questions,Submissions');
        $this->db->where($where);
        $this->db->where('Submissions.idSubmissions=Responses.submission');
        $this->db->join('Responses', 'Questions.idQuestions=Responses.questionNum');
        $query = $this->db->get();

        foreach ($query->result_array() as $row)
        {
            $data['catergoryID'] = $row['catergoryID'];
            $data['question'] = $row['question'];
            $data['answer'] = $row['answer'];
            echo json_encode($data);
        }

        //return $data;
   // }

//$data = get_all_questions();
   //   print_r(json_encode(get_all_questions()));
    ?>
</html>