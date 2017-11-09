<?php

class Posts extends MY_Controller {

	############View all posts/blogs#########################

	public function index($offset = 0)
	{
		// pagination Config
		$config['base_url'] = base_url() . 'posts/index';
		$config['total_rows'] = $this->db->count_all('posts');
		$config['per_page'] = 3;
		$config['uri_segment'] = 3;
		$config['attributes'] = array('class' => 'pagination-link');
		//init Pagination
		$this->pagination->initialize($config);

		$data['title'] = 'Latest Posts';
		$data['path']  = 'posts/index';

		$data['posts'] = $this->Post_model->get_posts(FALSE, $config['per_page'], $offset);
		
		$this->load->view('templates/master', $data);
	}

	############//View all posts/blogs#########################


	############View Particular post/blog#########################

	public function view($slug = NULL) {

		$data['posts'] = $this->Post_model->get_posts($slug);
		$post_id = $data['posts']->id;
		$data['comments'] = $this->comment_model->get_comments($post_id);

		if(empty($data['posts'])) {
			show_404();
		}

		$data['title'] = $data['posts']->title;
		$data['path']  = 'posts/view';
		$this->load->view('templates/master', $data);
	}

	############//View Particular post/blog#########################


	############Create New Post#########################

	public function create() 
	{
		

		$this->_logged_in(); //check if loggedin
 
		$data['title'] = 'Create Post';

		$data['categories'] = $this->Post_model->get_categories();

		$this->form_validation->set_rules('title', 'Title', 'required|is_unique[posts.title]', ['is_unique' => 'This title is already used. please use another one']);
		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE) {
			$data['path']  = 'posts/create';
			$this->load->view('templates/master', $data);
		} else {
			//upload image
			$this->load->library('upload');			
			date_default_timezone_set('Asia/Kathmandu');	
			
			$config['file_name'] = date('Ymdhis',time()).'_'.$_FILES['userfile']['name'].$this->upload->data('file_ext');
			$config['upload_path'] = './assets/images/posts';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			// $config['max_width'] = '500';
			// $config['max_height'] = '500';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload()) {
				
				$errors = ['error' => $this->upload->display_errors()];
				$this->session->set_flashdata('image_upload_error', $errors['error']);

				$post_image = 'noimage.jpg';
			} else {
				$data = ['upload_data' => $this->upload->data()];
				$post_image = $this->upload->data('file_name');
			}

			$this->Post_model->create_post($post_image);
			$this->session->set_flashdata('post_created', 'Your post has been created');
			redirect('posts');
		}
	}

	############//Create New Post#########################


	############Delete Post#########################

	public function delete($id) 
	{
		$this->_logged_in(); //check if loggedin
		
		$data['posts'] = $this->Post_model->get_post_by_id($id); 
		$data['title'] = 'Do you want to delete this post?';
		$data['path']  = 'posts/delete_post';
		$this->load->view('templates/master', $data);

		if($this->input->post('yes')) {
			$this->Post_model->delete_post($id);
			$this->session->set_flashdata('post_deleted', 'The post has been deleted');
			redirect('posts');
			}

			if($this->input->post('no')) {
				redirect('posts');
			}
		
		
	}

	############//Delete Post#########################


	############Edit Post#########################

	public function edit($slug)
	{
		$this->_logged_in(); //check if loggedin

		$data['posts'] = $this->Post_model->get_posts($slug);

		//check user
		if($this->session->userdata('user_id') != $data['posts']->user_id) {
			redirect('posts');
		}

		$data['categories'] = $this->Post_model->get_categories();
		if(empty($data['posts'])) {
			show_404();
		}

		$data['title'] = 'Edit Post';
		$data['path']  = 'posts/edit';
		$this->load->view('templates/master', $data);
	}


	public function update()
	{
		$this->_logged_in(); //check if loggedin

		$slug = $this->input->post('slug');
		$data['post_name'] = $this->Post_model->get_posts($slug)->title;
		//form validation
		if(strcmp($data['post_name'], $this->input->post('title')) == 0) {
			$is_unique = '';
		} else {
			$is_unique = "|is_unique[posts.title]";
		}
		$this->form_validation->set_rules('title', 'Title', 'required'.$is_unique, ['is_unique' => 'This title is already used. please use another one']);
		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE) {
			$this->session->
			redirect('posts/edit/'. $slug);
		} else {

		//update image
			$post_image = $this->input->post('current_image'); //image stored in database

			$this->load->library('upload');			
			date_default_timezone_set('Asia/Kathmandu');	

			
			$config['file_name'] = date('Ymdhis',time()).'_'.$_FILES['userfile']['name'].$this->upload->data('file_ext');
			$config['upload_path'] = './assets/images/posts';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			// $config['max_width'] = '500';
			// $config['max_height'] = '500';

			$this->upload->initialize($config);

			if(!$this->upload->do_upload('userfile')) {
				$image_name = $post_image;

			} else {
				$image_file_name = $post_image;
				if(strcmp($image_file_name, 'noimage.jpg') != 0){
				$cwd = getcwd(); //get the current working directory
				$image_file_path = $cwd. "\\assets\\images\\posts\\";
				chdir($image_file_path);
				unlink($image_file_name);
				chdir($cwd); //restore to pervious working directory
			}
				$data = ['upload_data' => $this->upload->data()];
				$image_name = $this->upload->data('file_name');

			}


			$this->Post_model->update_post($image_name);
			$this->session->set_flashdata('post_updated', 'Your post has been updated');
			redirect('posts');
		}
	}


	############//Edit Post#########################


	




}
