<?php

class Forgotpassword_model extends CI_Model {

	public function email_exists($email)
	{	
		$query = $this->db->get_where('users', ['email' => $email]);
		return $query->row();

	}


	public function verify_reset_password_code($email, $email_code)
	{
		$query = $this->db->get_where('users', ['email' => $email]);
		$old_password = $query->row()->password;
		$email_code = str_replace('~', '/', $email_code);
		if(password_verify($old_password, $email_code)) {
			return TRUE;
		}

		return FALSE;
	}



	public function update_password()
	{
		$email = $this->input->post('email');

		$enc_password = password_hash($this->input->post('new_password'), PASSWORD_BCRYPT);

		$data = [
			'password' => $enc_password,			
			];
		$this->db->where('email', $email);
		return $this->db->update('users', $data);
	}


	public function set_token($email, $email_code, $verification_code)
	{	
		$date = time();

		$data = [
				'user_email' 		=> $email,
				'email_code' 		=> $email_code,
				'verification_code' => $verification_code,
				'token_time' 		=> $date,
				];

		return $this->db->insert('reset_token', $data);
		
	}


	public function token_exists($email, $email_code)
	{	
		$this->db->where('user_email', $email);
		$this->db->where('email_code', $email_code);
		$query = $this->db->get('reset_token');
		return $query->row();
		
	}

	public function check_reset_tokens()
	{		
		$this->db->where('token_time <' , (time() - 120));
		return $this->db->delete('reset_token');	
	}


	public function delete_token($email, $email_code)
	{		
		$this->db->where('user_email', $email);
		$this->db->where('email_code', $email_code);
		return $this->db->delete('reset_token');	
	}


	public function check_verification_code($email, $code)
	{
		$this->db->where('user_email', $email);
		$this->db->where('verification_code', $code);
		$query = $this->db->get('reset_token');
		return $query->row();
	}





}