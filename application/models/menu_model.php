<?php


class Menu_model extends CI_Model {

    private $menu_items;

    public function __construct()
    {
        parent::__construct();
        $this->menu_items = array (
            array('name'=>'start', 'title'=>'Go home', 'link'=>'residenthome', 'className'=>'active'),
            array('name'=>'Nieuws', 'title'=>'Look for the tips', 'link'=>'nieuws ', 'className'=>'inactive'),


        );
    }

    function set_active($menutitle) {
        foreach ($this->menu_items as &$item) { // reference to $item
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = 'active';
            } else {
                $item['className'] = 'inactive';
            }
        }
    }

    function get_menuItems($menutitle="Home") {
        $this->set_active($menutitle);
        return $this->menu_items;
    }
}
