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
		public function register_form(){
			$data['tipo']=$this->productos_model->leer('tipoproducto');
			$data['main_content']="producto_form";
			$data['title']="Registrar Producto";
			$this->load->view('templates/template',$data);
		}
		public function insertar_producto(){
			$form_values=$this->input->post();
			if($this->productos_model->crear('productos',$form_values)){
				$this->session->set_flashdata('mensaje','El producto se agregó exitosamente');
				redirect('productos/listar');
			}
		}
	}
?>