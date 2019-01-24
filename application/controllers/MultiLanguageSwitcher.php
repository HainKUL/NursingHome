
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
        if(isset($_SESSION["resident"]))
        {
           redirect('Homepage_controller/residentHome/'.$_SESSION['id']);
        }
        else if(isset($_SESSION['caregiver']))
        {
            redirect('Dashboard/dashboard');
        }
        
    }
}
?>