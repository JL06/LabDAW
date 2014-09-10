<?php

	class Productos extends MY_Controller
	{		
		public function __construct()
		{
			parent::__construct();
			$this->load->model('productos_model');
		}
		public function listar(){
			$data['productos']=$this->productos_model->get_productos();
			$data['main_content']="productos";
			$data['title']="Productos";
			$this->load->view('templates/template',$data);
		}
	}
?>