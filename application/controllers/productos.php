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

	public function registrar() {
		$data['tipo']=$this->productos_model->leer('tipoproducto');
		$data['main_content']="producto_form";
		$data['title']="Registrar Producto";
		$data['materiales']=$this->materiales_model->get_materiales();
		$this->load->view('templates/template',$data);
	}


	private function insertar_producto() {

		$form_values=$this->input->post();
		//separo los materiales del resto de los valores de la forma
		$mat=$form_values['materiales'];
		unset($form_values['materiales']);
		
		//reglas de validación
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre de producto'
				),
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre de producto'
				),
			array(
				'field' => 'tiempo',
				'rules' => 'required|greater_than[0]|numeric',
				'label' => 'Tiempo de elaboración'

				),
			array(
				'field' => 'cantidad',
				'rules'=>'numeric|is_natural',
				'label' => 'Cantidad'
				),
			array(
				'field' => 'precio',
				'rules'=>'numeric|greater_than[0]',
				'label' =>'Precio'
				)
			);

		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid=$this->validate_form($rules,$form_values,'productos');

		if ( $valid != 1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('productos/registrar');
		}

		if($this->productos_model->crear('productos',$form_values)) {

			$prod=$this->productos_model->leer('productos',array('nombre'=>$form_values['nombre']));
			
			if ($mat != "" && isset($prod)) {
				$mat=explode(',',$mat);

				if (!$this->validate_materials($mat)){
					$this->session->set_flashdata('mensaje','La cantidad de material debe ser mayor a 0');
					$this->session->set_flashdata('class','alert alert-danger');
					redirect("productos/registrar");
				}

				$this->productos_model->asignar_material($prod[0]['id'],$mat);
			}
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se agregó exitosamente');
			
			redirect('productos/listar');
		}
	}
	public function validate_materials($materials){
		foreach ($materials as $m) {
			$m=explode(":", $m);
			if( !isset($m[1]) || !is_numeric($m[1]) || $m[1] <= 0 )
				return false;
		}
		return true;	
	}
	public function agendar(){
		$data = array('main_content' => 'schedule' , 'title'=>'Agendar producción' );
		$this->load->view('templates/template',$data);
	}
	public function actualizar_producto($prodId){
		$data['tipo']=$this->productos_model->leer('tipoproducto');
		$data['main_content']="producto_form";
		$data['title']="Actualizar Producto";
		$data['materiales']=$this->materiales_model->get_materiales();
		$data['producto']=json_encode($this->productos_model->get_productos(array('productos.id' => $prodId))[0]);
		$data['prodId']=$prodId;
		$data['mat_actuales']=json_encode($this->materiales_model->get_materiales_producto($prodId));
		$this->load->view('templates/template',$data);
	}
	private function actualizar($id){
		$form_values=$this->input->post();
		$mat=$form_values['materiales'];
		unset($form_values['materiales']);

		//reglas de validación
		$rules=array(
			
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre de producto'
				),
			array(
				'field' => 'tiempo',
				'rules' => 'required|greater_than[0]|numeric',
				'label' => 'Tiempo de elaboración'

				),
			array(
				'field' => 'cantidad',
				'rules'=>'numeric|is_natural',
				'label' => 'Cantidad'
				),
			array(
				'field' => 'precio',
				'rules'=>'numeric|greater_than[0]',
				'label' =>'Precio'
				)
			);

		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid=$this->validate_form($rules,$form_values,'productos');

		if ( $valid != 1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('productos/actualizar_producto/'.$id);
		}

		if($this->productos_model->actualizar('productos',array('id' => $id),$form_values)) {

			
			if ($mat != "") {
				$mat=explode(',',$mat);

				if (!$this->validate_materials($mat)){
					$this->session->set_flashdata('mensaje','La cantidad de material debe ser mayor a 0');
					$this->session->set_flashdata('class','alert alert-danger');
					redirect("productos/actualizar_producto/".$id);
				}

				$this->productos_model->borrar('productomaterial',array('idProducto'=>$id));
				$this->productos_model->asignar_material($id,$mat);				
			}else{
				$this->productos_model->borrar('productomaterial',array('idProducto'=>$id));
			}
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se actualizó exitosamente');
			
			redirect('productos/listar');
		}


	}

	private function borrar($prodId){
		
		if ($this->productos_model->actualizar('productos',array('id'=>$prodId),array('activo'=>0))) {
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se eliminó exitosamente');
			redirect("productos/listar");
		}
	}

	public function detalle($id){
		$prod=$this->productos_model->get_productos(array("productos.id"=>$id));
		$data=array(
			"producto"=>$prod[0],
			"materiales"=>$this->materiales_model->get_materiales_producto($id),
			"main_content"=>"detalle_material",
			"title"=>$prod[0]['nombre']
			);
		$this->load->view("templates/template",$data);		

	}
}
?>