<?php


class Our_chart_model extends CI_Model
{
    function __construct(){

        parent::__construct();
        $this->load->database();
        $this->load->library('session');
       // $this->load->library('session');
    }


    public function get_avg()
    {
        $query=$this->db->
        query("SELECT category,categoryID,submission,timestampStart,AVG(answer) AS answer FROM ((Questions
               INNER JOIN Responses
               ON Questions.idQuestions=Responses.questionNum)
               INNER JOIN Submissions
               ON Submissions.idSubmissions=Responses.submission
               INNER JOIN Categories
               ON Categories.idCategories=Questions.categoryID)
               WHERE completed = '1' AND idResident = '190' AND submission IN (
               #SELECT max(idSubmissions) as submission
               SELECT idSubmissions as submission
               FROM Submissions
               WHERE completed = '1' AND idResident = '190' )
               GROUP BY  category,categoryID,timestampStart,submission
               ORDER BY submission DESC,categoryID;");
       // $this->db->query($query);


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
            $rawdata[]=$data;
            //echo(json_encode($data));
        }
        //change_array_key( $rawdata, $old_key, $new_key)

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
        $sliced_array = array_slice($data22, 0, 3);
        return $sliced_array;
        //echo(json_encode($bothData);
    }

    function __destruct() {
        $this->db->close();
    }

}
    ?>
