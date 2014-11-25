<?php
class Lugares extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('lugares_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$res = $this->lugares_model->leer("lugar", array("activo"=>1));
		$data['title'] = "Puntos de venta";
		$data['main_content'] = "lugares";
		$data['lugares'] = $res;
		$this->load->view('templates/template',$data);
	}

	public function agregar()
	{
		$data['title'] = "Nuevo Punto de Venta";
		$data['main_content'] = "forma_lugar";
		$data['link'] = "guardar";
		$this->load->view('templates/template',$data);
	}

	public function guardar()
	{
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		if ($this->form_validation->run() == FALSE) 
		{
			$errores = validation_errors();
			$this->session->set_flashdata('mensaje', 'Error: '.$errores);
			$this->session->set_flashdata('class', 'alert alert-danger');
			redirect("lugares/agregar");
			return;
		}

		$data['nombre'] = $this->input->post('nombre');

		if ($this->lugares_model->repetido(array('nombre'=>$data['nombre']))) 
		{
			if ($this->lugares_model->activo(array('nombre'=>$data['nombre']))) 
			{
				$this->session->set_flashdata('mensaje', 'Error: Ya existe un punto de venta con ese nombre');
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("lugares/agregar");
				return;
			}
			else
			{
				$lugar = $this->lugares_model->lugar(array('nombre'=>$data['nombre']));
				$info['activo'] = 1;
				$this->lugares_model->actualizar('lugar', array('id' => $lugar['id']), $info);
				$this->session->set_flashdata('mensaje', 'El Punto de venta fue agregado');
				$this->session->set_flashdata('class', 'alert alert-success');
				redirect("/lugares");
				return;
			}
			
		}

		if($this->db->insert('lugar',$data))
		{
			$this->session->set_flashdata('mensaje', 'El Punto de venta fue agregado');
			$this->session->set_flashdata('class', 'alert alert-success');
			redirect("/lugares");
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Error: No se pudo agregar el nuevo punto de venta');
			$this->session->set_flashdata('class', 'alert alert-danger');
			redirect("/lugares");
		}
	}

	public function actualizar($id = NULL)
	{
		if ($id != NULL) 
		{
			$data = $this->lugares_model->lugar(array('id'=>$id));
			$data['main_content'] = 'forma_lugar';
			$data['title'] = 'Actualizar Punto de venta';
			$data['link'] = "guarda_actual/".$id;
			$this->load->view('templates/template',$data);
		} 
		else 
		{
			redirect("lugares");
		}
	}

	public function guarda_actual($id = NULL)
	{
		if ($id != NULL) 
		{
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			if ($this->form_validation->run() == FALSE) 
			{
				$errores = validation_errors();
				$this->session->set_flashdata('mensaje', 'Error: '.$errores);
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("lugares/actualizar/".$id);
				return;
			}

			$data['nombre'] = $this->input->post('nombre');

			if ($this->lugares_model->repetido(array('nombre'=>$data['nombre']))) 
			{
				if ( ! $this->lugares_model->activo(array('nombre'=>$data['nombre']))) 
				{
					$lugar = $this->lugares_model->lugar(array('nombre'=>$data['nombre']));
					$info['activo'] = 1;
					$this->lugares_model->actualizar('lugar', array('id' => $lugar['id']), $info);
				}
				$this->session->set_flashdata('mensaje', 'Error: Ya existe un punto de venta con ese nombre');
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("lugares");
			}

			if($this->lugares_model->actualizar('lugar', array('id' => $id), $data))
			{
				$this->session->set_flashdata('mensaje', 'El Punto de venta fue actualizado');
				$this->session->set_flashdata('class', 'alert alert-success');
				redirect("/lugares");
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Error: No se pudo actualizar el punto de venta');
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("/lugares");
			}
		} 
		else 
		{
			redirect("lugares");
		}
	}

	public function borrar($id = NULL)
	{
		if ($id != NULL) 
		{
			if ($this->lugares_model->actualizar('lugar',array('id'=>$id),array('activo'=>0)))
			{
				$this->session->set_flashdata('class','alert alert-success');
				$this->session->set_flashdata('mensaje','El punto de venta se eliminó exitosamente');
				redirect("lugares");
			}
		} 
		else 
		{
			redirect("lugares");
		}
	}

}