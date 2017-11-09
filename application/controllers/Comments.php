<?php

class Comments extends MY_Controller {

	public function create($post_id)
	{
		$slug = $this->input->post('slug');
		$data['posts'] = $this->Post_model->get_posts($slug);

		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('body', 'Body', 'required');

		if($this->form_validation->run() === FALSE) {

			 $data['path'] = 'posts/view';
			 $this->load->view('templates/master', $data);



		} else {
			$this->comment_model->create_comment($post_id);
			redirect('posts/' . $slug);
		}

	}





}