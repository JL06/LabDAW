<?php
	class Ventas extends MY_Controller{

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

		public function register_form(){
			$data = array('main_content' => 'venta_form','title'=>'Registrar Venta' );
			$this->load->view('templates/template',$data);
		}
	}
?>