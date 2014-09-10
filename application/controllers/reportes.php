<?php
class Reportes extends CI_Controller {
	public function index()
	{
		$data['title'] = "Reportes";
		$data['main_content'] = "reportes";
		$this->load->view('templates/template',$data);
	}

	function balance() {
		$data['title'] = "Balance";
		$data['main_content'] = "balance";
		$this->load->view('templates/template',$data);
	}



}