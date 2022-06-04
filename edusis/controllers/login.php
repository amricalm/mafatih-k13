<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
        parent::__construct();
	}
	
	function index()
	{
	
        $this->load->library('encrypt');
		$username = $this->input->post('user_login', TRUE);
		$password = $this->input->post('user_pass', TRUE);

		if (isset($username) && $username != '')
		{	
            $credentials    = $this->login_init->login_proses();
		}
		else
		{	
            $this->load->view('login/index');
		}
	}
	
	function loggedout()
	{
	
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
?>