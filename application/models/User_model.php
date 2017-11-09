<?php

class User_model extends CI_Model {

	public function register($enc_password)
	{
		//user data array
		$data = [
				'name' 		=> $this->input->post('name'),
				'zipcode' 	=> $this->input->post('zipcode'),
				'email' 	=> $this->input->post('email'),
				'username' 	=> $this->input->post('username'),
				'password' 	=> $enc_password,
				'groups'    => 1,
				];

		//insert user
		return $this->db->insert('users', $data);
	}


	//login user
	public function login($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('users');

		return $query->row();
	}


	//permission

	public function has_permission($key, $username)
	{	
		$query = $this->db->get_where('users', ['username' => $username]);
		
		$group_id = $query->row()->groups;

		$group = $this->db->get_where('groups', ['id' => $group_id ]);
		if($group->num_rows()) {
			$permissions = json_decode($group->row()->permissions, true);			
			if($permissions[$key] == true) {
				return true;
			}
		}

		return false;
	}	



	public function get_user($user_id = NULL) 
	{
		if(!$user_id) {
			
			$query = $this->db->get_where('users', ['id !=' => $this->session->userdata('user_id')]);
			return $query->result();
		}
		$query = $this->db->get_where('users', ['id' => $user_id]);
		return $query->row();
	}

	public function edit_account($user_id)
	{
		$data = [
			'name' => $this->input->post('name'),
			'zipcode' => $this->input->post('zipcode'),
			'email'	=> $this->input->post('email'),
			'username'	=> $this->input->post('username'),
			
			];
		$this->db->where('id', $user_id);
		return $this->db->update('users', $data);
	}


	public function change_password($user_id, $enc_password)
	{
		$data = [
			'password' => $enc_password,			
			];
		$this->db->where('id', $user_id);
		return $this->db->update('users', $data);
	}


	public function delete_account($user_id)
	{
		$this->db->where('id', $user_id);
		$this->db->delete('users');
		return true;
	}




}