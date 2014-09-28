<?php

class Productos extends MY_Controller
{		
	public function __construct() {
		parent::__construct();
		$this->load->model('productos_model');
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
	}

	public function listar() {
		$data['productos']=$this->productos_model->get_productos(array('activo'=>1));
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
	public function validate_form($rules,$form_values){
		$valid=1;
		$unique_error="";
		foreach ($rules as $r) {
			if($r['rules'] == 'unique'){
				$rep=$this->productos_model->repite('productos',$r['field'], $form_values[$r['field']] );
				
				if ($rep){
					$unique_error='El '.$r['label'].' no está disponible';
					$valid=false;
				}

			}else{
				$this->form_validation->set_rules($r['field'], $r['label'], $r['rules']);
			}
		}

		if ($this->form_validation->run() == FALSE){
			$valid=validation_errors();
		}
		if ($valid != 1)
			$valid.=$unique_error;

		return $valid;
	}

	public function insertar_producto() {

		$form_values=$this->input->post();
		$mat=$form_values['materiales'];
		unset($form_values['materiales']);
		
		//reglas de validación
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre de producto'
				),
			array('field' => 'nombre', 
				'rules' => 'required',
				'label' =>'Nombre de producto'
				),
			array(
				'field' => 'tiempo',
				'rules' => 'required',
				'label' => 'Tiempo de elaboración'

				)
			);
		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid=$this->validate_form($rules,$form_values);

		if ( $valid != 1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('productos/register_form');
		}

		if($this->productos_model->crear('productos',$form_values)) {

			$prod=$this->productos_model->leer('productos',array('nombre'=>$form_values['nombre']));
			if ($mat != "") {
				$mat=explode(',',$mat);
				$this->productos_model->asignar_material($prod[0]['id'],$mat);
			}
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se agregó exitosamente');
			
			redirect('productos/listar');
		}
	}
	
	public function schedule(){
		$data = array('main_content' => 'schedule' , 'title'=>'Agendar producción' );
		$this->load->view('templates/template',$data);
	}

}
?>