<?php

class Pages extends MY_Controller {

	public function index() 
	{
	echo "here";
	}


	public function view($page = "home")
	{
		if(!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}

		$data['title' ] = ucfirst($page);

		$data['path'] = 'pages/'.$page;
		$this->load->view('templates/master', $data);
	}




}