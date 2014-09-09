<?php
	class Ventas extends CI_Controller{

		public function __construct()
       {
            parent::__construct();
            $this->load->model('ventas_model');
       }
		public function listar() {
			$data['ventas']=$this->ventas_model->get_ventas();
			$data['main_content']="ventas";
			$data['title']="Ventas";
			$this->load->view('templates/template',$data);
		}
	}
?>