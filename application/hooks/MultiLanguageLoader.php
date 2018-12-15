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
            $ci->lang->load('news',$siteLang);
            $ci->lang->load('category',$siteLang);
            $ci->lang->load('olderadults',$siteLang);
            $ci->lang->load('questionnaire',$siteLang);
            $ci->lang->load('weathers',$siteLang);
            $ci->lang->load('done',$siteLang);
            $ci->lang->load('registration',$siteLang);


        } else {
            // default language files
            $ci->lang->load('footer','dutch');
            $ci->lang->load('login','dutch');
            $ci->lang->load('dashboard','dutch');
            $ci->lang->load('home','dutch');
            $ci->lang->load('news','dutch');
            $ci->lang->load('category','dutch');
            $ci->lang->load('olderadults','dutch');
            $ci->lang->load('questionnaire','dutch');
            $ci->lang->load('weathers','dutch');
            $ci->lang->load('done','dutch');
            $ci->lang->load('registration','dutch');
        }
    }
}
?>