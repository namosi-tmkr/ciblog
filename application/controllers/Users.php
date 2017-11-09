<?php

class Users extends MY_Controller {

	//name validation alpha-space
	public function alpha_dash_space($name){
	    if (! preg_match('/^[a-zA-Z\s]+$/', $name)) {
	        $this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
	        return FALSE;
	    } else {
	        return TRUE;
	    }
	}

	############Register User#########################
	public function register()
	{
		
		$this->not_loggedin_for_pw_recovery(); //check if user is already logged in

		$data['title'] = "Sign Up";

		$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_dash_space');
		$this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

		if($this->form_validation->run() === FALSE) {

			$data['path'] = 'users/register';
			$this->load->view('templates/master', $data);

		} else {
			//encrypt password

			$enc_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

			$this->user_model->register($enc_password);

			//set message

			$this->session->set_flashdata('user_registered', 'You are now registered and can log in');

			redirect('users/login');
		}
	}

	############//Register User#########################

	############LogIN User#########################
	public function login()
	{
		
		$this->not_loggedin_for_pw_recovery(); //check if user is already logged in
		$data['title'] = "Sign In";

		
		$this->form_validation->set_rules('username', 'Username', 'required');		
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE) {

			$data['path'] = 'users/login';
			$this->load->view('templates/master', $data);

		} else {
			
			//get username and password
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			//returns matched username info
			$user_info = $this->user_model->login($username);

			//check if password matches
			$hashed_password = $user_info->password;


			if(password_verify($password, $hashed_password)) {
				
				$user_id = $user_info->id;

				//create Session
				
				$user_data = [
							'user_id' => $user_id,
							'username' => $username,
							'logged_in' => TRUE,
							];
				if($this->user_model->has_permission('admin', $username)){
					$user_data['is_admin'] = TRUE;
				
				}

				$this->session->set_userdata($user_data);
				
				$this->session->set_flashdata('user_loggedin', 'You are now logged in');
				redirect('users/profile/' . $this->session->userdata('user_id'));
			} else {
				$this->session->set_flashdata('login_failed', 'Login Failed. Please Try Again');

				redirect('users/login');
			}		
		}
	}

	############//LogIN User#########################


	############LogOut User#########################
	public function logout()
	{
		// unset user data
		$this->session->unset_userdata(['logged_in', 'user_id', 'username', 'is_admin']);
		
		$this->session->set_flashdata('user_loggedout', 'You are now logged out');

		redirect('users/login');
	}

	############//LogOut User#########################



	############View User Profile#########################
	public function profile($user_id = NULL)
	{

		if($this->_logged_in()) {

		 	$user_id = self::_set_userid($user_id); //check of $user_id null or not

			$data['user_info'] = $this->user_model->get_user($user_id);

			self::_check_user($data['user_info']->id); //check if user tries to view others account

			if(empty($data['user_info'])) {
				show_404();
			}

			$data['title'] = 'Your Profile';
				
			$data['path']  = 'users/profile';
			
			$this->load->view('templates/master', $data);
		}
	}

	############//View User Profile#########################


	############Edit User Profile#########################
	public function edit_account($user_id = NULL)
	{
		if($this->_logged_in()) {

			$user_id = self::_set_userid($user_id); //check of $user_id null or not

			$data['title'] = 'Edit Account';
			$data['user_info'] = $this->user_model->get_user($user_id);

			self::_check_user($data['user_info']->id); //check if user tries to view others account

			if(empty($data['user_info'])) {
				show_404();
			}

			if(strcmp($data['user_info']->username, $this->input->post('username')) == 0) {
				$is_unique_username = '';
			} else {
				$is_unique_username = "|is_unique[users.username]";
			}

			if(strcmp($data['user_info']->email, $this->input->post('email')) == 0) {
				$is_unique_email = '';
			} else {
				$is_unique_email = "|is_unique[users.email]";
			}

			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_alpha_dash_space');
			$this->form_validation->set_rules('username', 'Username', 'required' . $is_unique_username);
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email' . $is_unique_email);
			if($this->form_validation->run() === FALSE) {
				$data['path']  = 'users/edit_account';
				$this->load->view('templates/master', $data);

			} else {

				$this->user_model->edit_account($user_id);
				$this->session->set_flashdata('user_account_edited', 'Your account has been edited successfully');
				redirect('users/profile');
			}
		}

	}

	############//Edit User Profile#########################


	############Change User Password#########################

	public function change_password($user_id = NULL)
	{
		if($this->_logged_in()){

			$user_id = self::_set_userid($user_id); //check of $user_id null or not

			$data['title'] = 'Change Password';
			$data['user_info'] = $this->user_model->get_user($user_id);

			self::_check_user($data['user_info']->id); //check if user tries to view others account

			if(empty($data['user_info'])) {
				show_404();
			}


			$this->form_validation->set_rules('password', 'Current Password', 'required|callback_check_current_password');
			$this->form_validation->set_rules('new_password', 'New Password', 'required');
			$this->form_validation->set_rules('new_password_again', 'Confirm New Password', 'required|matches[new_password]');
			if($this->form_validation->run() === FALSE) {
				$data['path']  = 'users/change_password';
				$this->load->view('templates/master', $data);

			} else {
				$enc_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);
				$this->user_model->change_password($user_id, $enc_password);
				$this->session->set_flashdata('user_password_edited', 'Your password has been changed successfully');
				redirect('users/profile');	
			}



		}
	}

	//current password validation 
	public function check_current_password($password){

		$user_id = $this->session->userdata('user_id');
		$hashed_password = $this->user_model->get_user($user_id)->password;

	   	if(!password_verify($password, $hashed_password)){
	   		$this->form_validation->set_message('check_current_password', 'The %s is not correct');
	        return FALSE;
	   	} else {
	        return TRUE;
	    }
	}

	############//Change User Password#########################


	############Delete_Account#########################

	public function delete_account($user_id) 
	{
		//check if loggedin

		if($this->_logged_in()){

			//$user_id = self::_set_userid($user_id); //check if $user_id null or not

			$data['title'] = 'Do you want to delete this account?';
			$data['user_info'] = $this->user_model->get_user($user_id);

			if($this->session->userdata('user_id') != $user_id) {
				if(!$this->session->userdata('is_admin')) {
			    	$this->session->set_flashdata('others_profile', "Can't view others profile");
			    	redirect('users/profile');  
			    }   
       		}

	       	$data['path']  = 'users/delete_account';
			$this->load->view('templates/master', $data);
			
			if($this->input->post('yes')) {

				$this->user_model->delete_account($user_id);
				if(!$this->session->userdata('is_admin')) {
					$this->session->unset_userdata(['logged_in', 'user_id', 'username','is_admin']);
					$this->session->set_flashdata('user_account_deleted', 'Account Deleted');
					redirect('users/login');
				} else {
					$this->session->set_flashdata('user_account_deleted', 'Account Deleted');
					redirect('users/view_all_users');
				}
				
			}

			if($this->input->post('no')) {
				if(!$this->session->userdata('is_admin')) {
				redirect('users/profile');
				} else {
					redirect('users/view_all_users');
				}
			}
			
		}
	}

	############//Delete_Account#########################
	

	

	############View User specific Posts#########################

	public function view_posts($user_id = NULL, $offset = 0)
	{
		if($this->_logged_in()){
			
			$user_id = self::_set_userid($user_id); //check of $user_id null or not

			$data['title'] = 'Your Posts';
			$data['user_info'] = $this->user_model->get_user($user_id);

			self::_check_user($data['user_info']->id); //check if user tries to view others account

			// pagination Config
			$config['base_url'] = base_url() . 'users/view_posts/' . $user_id ;
			$config['total_rows'] = $this->Post_model->get_postcount_of_user($user_id);
			$config['per_page'] = 3;
			$config['uri_segment'] = 4;
			$config['attributes'] = array('class' => 'pagination-link');
			//init Pagination
			$this->pagination->initialize($config);

			$data['posts'] = $this->Post_model->get_posts_of_user($user_id, $config['per_page'], $offset);

			$data['path'] = 'posts/index';
			$this->load->view('templates/master', $data);


		}
	}




	############//View User specific Posts#########################


	############View all Users with delete option to admin#########

	public function view_all_users()
	{
		if($this->_logged_in()) {
			if($this->session->userdata('is_admin')){
				$data['title'] = 'Registered Users';
				$data['s_no'] = 1;
				$data['users']=$this->user_model->get_user();
				$data['path'] = 'users/view_all_users';
				$this->load->view('templates/master', $data);

			} else {
				 $this->session->set_flashdata('not_admin', "Not Admin.Log in as Admin");
		    	redirect('users/profile');
			}
		}
	}

	############View all Users with delete option to admin#########

	//set user_id if null
	private function _set_userid($user_id)
	{
		if($user_id == NULL) {
			$user_id = $this->session->userdata('user_id');
		}
		return $user_id;
	}

	//check if a user tries to view others account
	private function _check_user($user_id)
	{
		if($this->session->userdata('user_id') != $user_id) {
		    $this->session->set_flashdata('others_profile', "Can't view others profile");
		    redirect('users/profile');     
       	}

       	return TRUE;
	}





	
}