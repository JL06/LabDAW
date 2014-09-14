<?php

	class Productos extends MY_Controller
	{		
		public function __construct() {
			parent::__construct();
			$this->load->model('productos_model');
			$this->load->model('materiales_model');
		}

		public function listar() {
			$data['productos']=$this->productos_model->get_productos();
			$data['main_content']="productos";
			$data['title']="Productos";
			$this->load->view('templates/template',$data);
		}

		public function register_form() {
			$data['tipo']=$this->productos_model->leer('tipoproducto');
			$data['main_content']="producto_form";
			$data['title']="Registrar Producto";
			$data['materiales']=$this->materiales_model->get_materiales();
			$this->load->view('templates/template',$data);
		}

		public function insertar_producto() {
			$form_values=$this->input->post();
			$mat=$form_values['materiales'];
			unset($form_values['materiales']);
			
			if($this->productos_model->crear('productos',$form_values)) {
				$prod=$this->productos_model->leer('productos',array('nombre'=>$form_values['nombre']));
				if ($mat != "") {
					$mat=explode(',',$mat);
					$this->asignar_material($prod[0]['id'],$mat);
				}
				
				$this->session->set_flashdata('mensaje','El producto se agregó exitosamente');
				redirect('productos/listar');
			}
			
		}

		public function asignar_material($prodId,$mat) {
			$insertData=array();
			
			foreach ($mat as $m) {
				$insertData[]=array('idProducto'=>$prodId,'idMaterial'=>$m);	
			}
			if($this->db->insert_batch('productomaterial',$insertData))
				return true;

		}


	}
?>