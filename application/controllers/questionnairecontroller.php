<?php
/**
 * Created by IntelliJ IDEA.
 * User: Haien
 * Date: 10/12/2018
 * Time: 14:39
 */

class Questionnairecontroller extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->library('parser');
		$this->load->helper('url');
		//$this->load->model('Answer_model');
        $this->load->model('Question_model');
	}

	public function home(){
        $data['page_title'] = 'Care for you';
        $data['category'] = 'Food&Meal';
        $data['question'] = 'here is question 1';
        //load data(question items) to the controller
        //$data['question_items'] = $this->Question_model->get_questions();//the param passed here to set active
        $data['return'] = 'Go Back';
        $data['progress'] = '2/4';

        //pass data to the view(the page)
        $this->parser->parse('questionnairetemplate',$data);//variables sent to html content
//        $this->load->view('questionnairetemplate',$data);//variables sent to php content
	}

//	public function events($format='normal'){
//	    $this->load->model('Event_model');
//	    $events = $this->Event_model->get_events();//return $query->result();
//	    if($format == "normal"){
//	        $data['jslibs_to_load'] = array('jquery-3.3.1.min.js','myjs.js');
//            $data['page_title']='UXWD event\'s page';
//            $data['content_title_1']='Upcoming events';
//            $data['content_title_2']='Looking forward...';
//            $data['menu_items'] = $this->Menu_model->get_menuItems('Upcoming events');//note: menu mode has been loaded in the constructor
//            //$this->load->model('Event_model');
//            //$data2['events'] = $this->Event_model->get_events();
//            $data2['events'] = $events;
//
//            $data['content']=
//                $this->parser->parse('events',$data2,true);
//
//            $this->parser->parse('questionnairetemplate',$data);
//        }else if ($format == "html"){
//	        $data2['events'] = $events;//this 'events' refers to the key
//	        $result = $this->parser->parse('events',$data2,true);//data sent to html, use parser//this 'events refers to the file'
//	        $this->output->set_content_type('text/html')
//                ->append_output($result);
//	    } else if ($format == 'json'){
//            $this->output->set_content_type('application/json')
//                ->append_output(json_encode($events));
//        }
//	}
}
