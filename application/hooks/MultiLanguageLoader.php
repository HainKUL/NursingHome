<?php

class MultiLanguageLoader
{

    function initialize() {
        $ci =& get_instance();
        // load language helper
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('footer',$siteLang);
            $ci->lang->load('login',$siteLang);
            $ci->lang->load('dashboard',$siteLang);
            $ci->lang->load('home',$siteLang);
            $ci->lang->load('category',$siteLang);

        } else {
            // default language files
            $ci->lang->load('footer','english');
            $ci->lang->load('login','english');
            $ci->lang->load('dashboard','english');
            $ci->lang->load('home','english');
            $ci->lang->load('category','english');
        }
    }
}
?>