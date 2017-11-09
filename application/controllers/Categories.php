<?php

class Categories extends MY_Controller {


	public function index()
	{
		$data['title'] = "Categories";

		$data['categories'] = $this->category_model->get_categories();

		$data['path'] = 'categories/index';
		$this->load->view('templates/master', $data);
	}

	public function create()
	{
		//check if loggedin

		if($this->_logged_in()){ 

			$this->_check_is_admin(); //check if admin or not
			
			$data['title'] = "Create Category";

			$this->form_validation->set_rules('category_name', 'Name', 'required|is_unique[categories.name]', [
				'required' => 'The %s is required',
				'is_unique' => 'This %s already exists'
				]);

			if($this->form_validation->run() === FALSE) {
				$data['path'] = 'categories/create';
				$this->load->view('templates/master', $data);
			} else {
				$this->category_model->create_category();
				$this->session->set_flashdata('category_created', 'Your category has been created');
				redirect('categories');
			}
		}
	}



	public function posts($id, $offset = 0) 
	{	
		// pagination Config
		$config['base_url'] = base_url() . 'categories/posts/' . $id ;
		$config['total_rows'] = $this->Post_model->get_postcount_by_category($id);
		$config['per_page'] = 3;
		$config['uri_segment'] = 4;
		$config['attributes'] = array('class' => 'pagination-link');
		//init Pagination
		$this->pagination->initialize($config);

		$data['title'] = $this->category_model->get_category($id)->name;

		$data['posts'] = $this->Post_model->get_posts_by_category($id, $config['per_page'], $offset);

		$data['path'] = 'posts/index';
		$this->load->view('templates/master', $data);
	}


	public function delete($id) 
	{
		//check if loggedin

		if($this->_logged_in()){

			$this->_check_is_admin(); //check if admin or not

			$this->category_model->delete_category($id);
			$this->session->set_flashdata('category_deleted', 'Your category has been deleted');
			redirect('categories');
		
		}
	}



	



}