<?php

class Post_model extends CI_Model {

	public function get_posts($slug = FALSE, $limit = NULL, $offset = NULL) 
	{
		if($limit){
			$this->db->limit($limit, $offset);
		}

		if($slug === FALSE) {
			$this->db->select('*');
			$this->db->select('users.name as users_name');
			$this->db->select('categories.name as category_name');
			$this->db->order_by('posts.id', 'DESC');
			$this->db->join('categories', 'categories.id = posts.category_id');
			$this->db->join('users', 'users.id = posts.user_id');
			$query = $this->db->get('posts');
			return $query->result();
		}

		
		$query = $this->db->get_where('posts', ['slug' => $slug]);
		return $query->row();
	}


	public function get_post_by_id($post_id)
	{
		$query = $this->db->get_where('posts', ['id' => $post_id]);
		return $query->row();
	}
	

	public function create_post($post_image)
	{
		$slug = url_title($this->input->post('title'));

		$data = [
				'title' => $this->input->post('title'),
				'slug' 	=> $slug,
				'body'	=> $this->input->post('body'),
				'category_id' => $this->input->post('category_id'),
				'user_id' => $this->session->userdata('user_id'),
				'post_image' => $post_image
				];

		return $this->db->insert('posts', $data);

	}



	public function delete_post($id)
	{
		$image_file_name = $this->db->select('post_image')
							->get_where('posts', ['id' => $id])
							->row()->post_image;
		if(strcmp($image_file_name, 'noimage.jpg') != 0){
		$cwd = getcwd(); //get the current working directory
		$image_file_path = $cwd. "\\assets\\images\\posts\\";
		chdir($image_file_path);		
		unlink($image_file_name);		
		chdir($cwd); //restore to pervious working directory
		}
		$this->db->where('id', $id);
		$this->db->delete('posts');
		return true;
	}


	public function update_post($image_name)
	{
		$slug = url_title($this->input->post('title'));

		$data = [
			'category_id' => $this->input->post('category_id'),
			'title' => $this->input->post('title'),
			'slug' 	=> $slug,
			'body'	=> $this->input->post('body'),
			'post_image' => $image_name
			];
		$this->db->where('id', $this->input->post('id'));
		return $this->db->update('posts', $data);
	}



	public function get_categories()
	{
		$this->db->order_by('name');
		$query = $this->db->get('categories');
		return $query->result();
	}



	public function get_posts_by_category($category_id, $limit = NULL, $offset = NULL)
	{
		if($limit){
			$this->db->limit($limit, $offset);
		}
		$this->db->select('*');
		$this->db->select('users.name as users_name');
		$this->db->select('categories.name as category_name');
		$this->db->join('categories', 'categories.id = posts.category_id');
		$this->db->join('users', 'users.id = posts.user_id');
		$this->db->order_by('posts.id', 'DESC');
		$query = $this->db->get_where('posts', ['posts.category_id' => $category_id]);

			return $query->result();

	}

	public function get_postcount_by_category($category_id)
	{

		$this->db->order_by('posts.id', 'DESC');
		$this->db->join('categories', 'categories.id = posts.category_id');
		$query = $this->db->get_where('posts', ['category_id' => $category_id]);
		
			return $query->num_rows();

	}


	public function get_posts_of_user($user_id, $limit = NULL, $offset = NULL)
	{
		if($limit){
			$this->db->limit($limit, $offset);
		}		
		$this->db->select('*');
		$this->db->select('users.name as users_name');
		$this->db->select('categories.name as category_name');
		$this->db->join('categories', 'categories.id = posts.category_id');
		$this->db->join('users', 'users.id = posts.user_id');
		$this->db->order_by('posts.id', 'DESC');
		$query = $this->db->get_where('posts', ['posts.user_id' => $user_id]);
			return $query->result();
	}

	public function get_postcount_of_user($user_id)
	{
		$this->db->order_by('posts.id', 'DESC');
		$this->db->join('users', 'users.id = posts.user_id');
		$query = $this->db->get_where('posts', ['user_id' => $user_id]);
			return $query->num_rows();
	}




}