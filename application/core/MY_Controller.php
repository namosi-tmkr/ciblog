<?php

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->forgotpassword_model->check_reset_tokens();
	}

	public function _logged_in()
	{
		if(!$this->session->userdata('logged_in')) {
			$this->session->set_flashdata('not_logged_in', 'Please Login first');
			redirect('users/login');
		}
		return TRUE;	
	}


	//check if admin or not
	public function _check_is_admin()
	{
		if(!$this->session->userdata('is_admin')) {
			$this->session->set_flashdata('not_admin', "Not Admin.Log in as Admin");
			redirect('users/profile');
		}

		return TRUE;
	}


	public function not_loggedin_for_pw_recovery()
	{
		if($this->session->userdata('logged_in')) {
			$this->session->set_flashdata('is_logged_in', 'You are already logged in');
			redirect('users/profile');

		}
		return TRUE;
	}



}