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

        } else {
            // default language files
            $ci->lang->load('footer','english');
            $ci->lang->load('login','english');
            $ci->lang->load('dashboard','english');
            $ci->lang->load('home','english');
            $ci->lang->load('news','english');
            $ci->lang->load('category','english');
            $ci->lang->load('olderadults','english');
            $ci->lang->load('questionnaire','english');
            $ci->lang->load('weathers','english');
            $ci->lang->load('done','english');
        }
    }
}
?>