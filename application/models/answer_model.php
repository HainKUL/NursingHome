<?php
/**
 * Created by IntelliJ IDEA.
 * User: u0066257
 * Date: 10/10/2018
 * Time: 17:53
 */

class Answer_model extends CI_Model {

    private $answer_items;

    public function __construct()
    {
        parent::__construct();
        // <a href="link" title="title" class="className">name</a>
        $this->answer_items = array (
            array('name'=>'Never','title'=>'', 'link'=>'', 'className'=>'inactive'),//after been selected, make active
            array('name'=>'Rarely', 'title'=>'', 'link'=>'', 'className'=>'inactive'),//activate to highlight the menu
            array('name'=>'Sometimes', 'title'=>'', 'link'=>'', 'className'=>'inactive'),
            array('name'=>'Mostly', 'title'=>'', 'link'=>'', 'className'=>'inactive'),
            array('name'=>'Always', 'title'=>'', 'link'=>'', 'className'=>'inactive'),
        );

    }

    function get_answerItems() {//show all answer on the page
        return $this->answer_items;
    }

    function set_active($menutitle) {
        foreach ($this->answer_items as &$item) { // reference to $item
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = 'active';
            } else {
                $item['className'] = 'inactive';
            }
        }
    }
}