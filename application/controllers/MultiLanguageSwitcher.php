
<?php if ( ! defined('BASEPATH')) exit('Direct access allowed');


class MultiLanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    // create language Switcher method
    function switcher($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }
}
?>