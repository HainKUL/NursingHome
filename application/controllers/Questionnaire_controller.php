<?php

class Questionnaire_controller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper('url');
        $this->load->model('question_model');
	}

	public function home(){
        $data1['jslibs_to_load'] = array('jquery-3.3.1.min.js','myjs.js');
        //load data(question info) to the controller
        $data2 = $this->question_model->get_questions();//id,category,question

        $data = array_merge($data1, $data2);//merge two array

        //pass data to the view(the page)
        $this->parser->parse('questionnaire',$data);//variables sent to html content
	}
}
