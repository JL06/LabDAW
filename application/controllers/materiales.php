<?php
class Materiales extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->model('generic_model');
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
		$colores = $this->generic_model->listar("color");
		$data['title'] = "Nuevo Material";
		$data['main_content'] = "forma_material";
		$data['colores'] = $colores;
		$data['link'] = "guardar";

		$this->load->view('templates/template',$data);
	}

	public function guardar() 
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('unidad', 'Unidad', 'required');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'numeric');
		if ($this->form_validation->run() == FALSE)
		{
			$errores = validation_errors();
			$this->session->set_flashdata('mensaje', 'Error:'.$errores);
			$this->session->set_flashdata('class', 'alert alert-danger');
			redirect("materiales/agregar");
			return;
		}

		$data1['nombre'] = $this->input->post('nombre');
		$data1['unidad'] = $this->input->post('unidad');
		$data['cantidadMaterial'] =$this->input->post('cantidad');
		$data['idColor'] =$this->input->post('color');

		$material = $this->materiales_model->existe($data1['nombre']);
		if ($material == NULL) 
		{
			if ($this->generic_model->crear('tipomaterial', $data1)) 
			{
				$material = $this->materiales_model->existe($data1['nombre']);
			} 
			else 
			{
				//Error
			}
		}
		$data['idTipo'] = $material['id'];

		if ($this->generic_model->crear('material', $data)) 
		{
			$this->session->set_flashdata('mensaje','El material se agregó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("materiales");
		}
	}

	public function actualizar ($id = NULL) {
		if ($id != NULL) 
		{
			$colores = $this->generic_model->listar("color");
			$data = $this->materiales_model->material($id);
			$data['colores'] = $colores;
			$data['title'] = "Actualiza Material";
			$data['main_content'] = "forma_material";
			$data['link'] = "guarda_actual/".$id;
			$this->load->view('templates/template',$data);
		} 
		else 
		{
			redirect("materiales");
		}
	}

	public function guarda_actual ($id = NULL) 
	{
		if ($id != NULL) 
		{
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('unidad', 'Unidad', 'required');
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'numeric');
			if ($this->form_validation->run() == FALSE)
			{
				$errores = validation_errors();
				$this->session->set_flashdata('mensaje', 'Error:'.$errores);
				$this->session->set_flashdata('class', 'alert alert-danger:');
				redirect("materiales/actualizar".$id);
				return;
			}

			$data1['nombre'] = $this->input->post('nombre');
			$data1['unidad'] = $this->input->post('unidad');
			$data['cantidadMaterial'] =$this->input->post('cantidad');
			$data['idColor'] =$this->input->post('color');

			$material = $this->materiales_model->existe($data1['nombre']);
			if ($material == NULL) 
			{
				if ($this->generic_model->crear('tipomaterial', $data1)) 
				{
					$material = $this->materiales_model->existe($data1['nombre']);
				} 
				else 
				{
				//Error
				}
			}
			else 
			{
				$this->generic_model->actualizar("tipomaterial", array('id' => $material["id"]), $data1);
			}
			$data['idTipo'] = $material['id'];

			if ($this->materiales_model->actualizar("material", array('id' => $id), $data)) 
			{
				$this->session->set_flashdata('mensaje', 'El material fue actualizado exitosamente');
				$this->session->set_flashdata('class', 'alert alert-success');
				redirect("materiales");
			}

		} 
		else 
		{
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
}
/* End of file materiales.php */
/* Location: controllers/materiales.php */
