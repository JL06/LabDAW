<?php
class Materiales extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
	}

	public function index() 
	{
		$data['materiales']=$this->materiales_model->get_materiales(array('material.activo'=>1));
		$data['main_content']="materiales";
		$data['title']="Materiales";
		$this->load->view('templates/template',$data);
	}

	public function listar() 
	{
		$data['materiales']=$this->materiales_model->get_materiales(array('material.activo'=>1));
		$data['main_content']="materiales";
		$data['title']="Materiales";
		$this->load->view('templates/template',$data);
	}

	public function agregar() 
	{
		$colores = $this->materiales_model->listar("color");
		$data['title'] = "Nuevo Material";
		$data['main_content'] = "forma_material";
		$data['colores'] = $colores;
		$data['materiales']=$this->materiales_model->leer("tipomaterial");
		$data['link'] = "guardar";
		$data['unidades']=$this->materiales_model->get_unidades();
		$this->load->view('templates/template',$data);
	}

	public function guardar() 
	{


		$nombre=$this->input->post('nombre');


		if ($nombre === "")
		{
			$data['idTipo'] = $this->input->post("idMaterial");

		}
		else
		{
			$data1['nombre'] = $nombre;
			
			$data1['unidad'] = $this->input->post('unidad');
			$rules=array(
				array('field' => 'nombre', 
					'rules' => 'unique',
					'label' =>'Nombre'
					),
				array('field' => 'nombre', 
					'rules' => 'required|min_length[2]|max_length[50]',
					'label' =>'Nombre'
					)
				);
			$valid = $this->validate_form($rules,$data1,'tipomaterial');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('materiales/agregar');
			}

			
			if ($this->materiales_model->crear('tipomaterial', $data1)) {
				$data['idTipo']=$this->materiales_model->leer("tipomaterial",array("nombre"=>$nombre))[0]['id'];
			}else{
				//inform error graciously
			}
			
		}
		$data['cantidadMaterial'] =$this->input->post('cantidad');
		$data['idColor'] =$this->input->post('color');

		$rules=array(
			array(
				'field'=>'idTipo',
				'rules'=>'unique',
				'label'=>'material'
				),
			array(
				'field'=>'cantidad',
				'rules'=>'numeric|required',
				'label'=>'Cantidad'
				)
			);
		$valid = $this->validate_form($rules,$data,'material');

		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('materiales/agregar');
		}
		
		if ($this->materiales_model->crear('material', $data)) 
		{
			$this->session->set_flashdata('mensaje','El material se agregó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("materiales");
		}
	}

	public function actualizar ($id = NULL) {
		if ($id != NULL) 
		{
			$colores = $this->materiales_model->listar("color");
			$data = $this->materiales_model->material($id);
			$data['colores'] = $colores;
			$data['title'] = "Actualiza Material";
			$data['main_content'] = "forma_material";
			$data['link'] = "guarda_actual/".$id;
			$data['materiales']=$this->materiales_model->leer("tipomaterial");
			$data['unidades']=$this->materiales_model->get_unidades();
			$this->load->view('templates/template',$data);
		} 
		else 
		{
			redirect("materiales");
		}
	}

	public function guarda_actual ($id = NULL) 
	{

		$nombre=$this->input->post('nombre');

		if ($nombre == "")
		{
			$data['idTipo'] = $this->input->post("idMaterial");

		}
		else
		{
			$data1['nombre'] = $nombre;
			
			$data1['unidad'] = $this->input->post('unidad');
			$rules=array(
				array(
					'field' => 'nombre', 
					'rules' => 'unique',
					'label' =>'Nombre'
					),
				array(
					'field' => 'nombre', 
					'rules' => 'min_length[2]|max_length[50]',
					'label' =>'Nombre'
					)
				);
			$valid = $this->validate_form($rules,$data1,'tipomaterial');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('materiales/agregar');
			}

			
			if ($this->materiales_model->crear('tipomaterial', $data1)) {
				$data['idTipo']=$this->materiales_model->leer("tipomaterial",array("nombre"=>$nombre))[0]['id'];
			}else{
				//inform error graciously
			}
			
		}
		$data['cantidadMaterial'] =$this->input->post('cantidad');
		$data['idColor'] =$this->input->post('color');

		$rules=array(
			array('field'=>'cantidad',
				'rules'=>'numeric|callback_greater_or_equal[0]|required',
				'label'=>'Cantidad'
				)
			);
		$valid = $this->validate_form($rules,$data,'material');
		$existe = $this->materiales_model->repite('material','idTipo',array('idTipo'=>$data['idTipo'],'idColor'=>$data['idColor']));
		if ($existe)
		{
			$original=$this->materiales_model->leer('material',array('id'=>$id));
			if ( $original[0]['idTipo'] !== $form_values['idTipo'] &&  $original[0]['idColor'] !== $form_values['idColor']){
				$error = "El material ya está registrado. Registre uno diferente o modifique el que ya existe\n";
			}
		}
		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('materiales/actualizar/'.$id);
		}
		
		if ($this->materiales_model->actualizar('material', array("id"=>$id),$data)) 
		{
			$this->session->set_flashdata('mensaje','El material se actualizó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("materiales");
		}
	}

	public function borrar($id = NULL) {
		if ($id != NULL) 
		{
			if ($this->materiales_model->actualizar('material',array('id'=>$id),array('activo'=>0))) 
			{
				$this->session->set_flashdata('mensaje','El material se eliminó exitosamente');
				$this->session->set_flashdata('class', 'alert alert-success');
			} 
			else 
			{
				$this->session->set_flashdata('mensaje','El material no se pudo eliminar');
				$this->session->set_flashdata('class', 'alert alert-danger');
			}
			redirect("materiales");
		} 
		else 
		{
			redirect("materiales");
		}
	}

	public function get_unidad(){
		$idMaterial=$this->input->post("selMat");

		echo $this->materiales_model->leer("tipomaterial",array("id"=>$idMaterial)) [0]["unidad"];

	}

}
/* End of file materiales.php */
/* Location: controllers/materiales.php */
