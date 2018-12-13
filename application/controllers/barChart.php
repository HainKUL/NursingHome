<?php

$query = $this->db->get('Submissions');
foreach ($query->result() as $row)
{
    $data['idSubmissions']=$row->idSubmissions;
    $data['timestampStart']=$row->timestampStart;
    echo json_encode($data);
}