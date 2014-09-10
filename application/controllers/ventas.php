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
			$productos=$this->ventas_model->leer('productos');
			$vendors=$this->ventas_model->leer('usuario');
			$lugares=$this->ventas_model->leer('lugar');
			$data = array('main_content' => 'venta_form','title'=>'Registrar Venta','productos'=>$productos,'vendedor'=>$vendors,'lugar'=>$lugares );
			
			$this->load->view('templates/template',$data);

		}
		public function insertar_venta(){
			$form_values=$this->input->post();
			if( $this->ventas_model->crear('ventas',$form_values)){
				redirect('ventas/listar');
			}
		}
	}
?>