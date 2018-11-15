<?php
/**
 * Created by IntelliJ IDEA.
 * User: Haien
 * Date: 11/2/2018
 * Time: 12:55
 */


class Question_model extends CI_Model{

    public function get_questions(){
        $query=$this->db->query("SELECT * FROM a18ux04.Questions WHERE idQuestions=1;");//select only one colume for test here
        foreach ($query->result_array() as $row)
        {
            $data['question'] = $row['question'];
            $data['category'] = $row['category'];
            $data['progress'] = $row['idQuestions'] . "/52";
        }

        return $data;
    }
}