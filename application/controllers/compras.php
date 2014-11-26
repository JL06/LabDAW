<?php
class Compras extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('compras_model');
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$res = $this->compras_model->listar();
		$data['title'] = "Compras";
		$data['main_content'] = "compras";
		$data['compras'] = $res;
		$this->load->view('templates/template',$data);
	}

	public function agregar()
	{
		$data['materiales'] = $this->compras_model->materiales();
		$data['title'] = "Nueva Compra";
		$data['main_content'] = "forma_compra";
		$data['link'] = "guardar";
		$this->load->view('templates/template',$data);
	}

	public function guardar()
	{
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
		$this->form_validation->set_rules('costo', 'Costo', 'required');
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'greater_than[0]');
		$this->form_validation->set_rules('costo', 'Costo', 'greater_than[-1]');
		if ($this->form_validation->run() == FALSE) 
		{
			$errores = validation_errors();
			$this->session->set_flashdata('mensaje', 'Error: '.$errores);
			$this->session->set_flashdata('class', 'alert alert-danger');
			redirect("compras/agregar");
			return;
		}

		$data['idmaterial'] = $this->input->post('material');
		$data['cantidad'] = $this->input->post('cantidad');
		$data['costo'] = $this->input->post('costo');
		$data['fecha'] = date("Ymd");

		if($this->db->insert('compras',$data))
		{
			$material = $this->materiales_model->material($data['idmaterial']);
			$this->db->where('id', $data['idmaterial']);
			$this->db->update('material', array('cantidadMaterial' => $data['cantidad'] + $material['cantidad'])); 
			$this->session->set_flashdata('mensaje', 'Se registro la compra exitosamente');
			$this->session->set_flashdata('class', 'alert alert-success');
			redirect("/compras");
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Error: No se pudo registrar la compra');
			$this->session->set_flashdata('class', 'alert alert-danger');
			redirect("/compras");
		}
	}

	public function actualizar_compra($id = NULL)
	{
		if ($id != NULL) 
		{
			$data = $this->compras_model->compra(array('compras.id'=>$id));
			//$data['materiales'] = $this->compras_model->materiales();
			$data['mat'] = $this->materiales_model->material($data['matid']);
			$data['main_content'] = 'forma_compra';
			$data['title'] = 'Actualizar compra';
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
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'required');
			$this->form_validation->set_rules('costo', 'Costo', 'required');
			$this->form_validation->set_rules('cantidad', 'Cantidad', 'greater_than[0]');
			$this->form_validation->set_rules('costo', 'Costo', 'greater_than[-1]');
			if ($this->form_validation->run() == FALSE) 
			{
				$errores = validation_errors();
				$this->session->set_flashdata('mensaje', 'Error: '.$errores);
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("compras/actualizar_compra/".$id);
				return;
			}

			//$data['idmaterial'] = $this->input->post('material');
			$data['cantidad'] = $this->input->post('cantidad');
			$data['costo'] = $this->input->post('costo');
			$data['fecha'] = $this->input->post('fecha');

			$compra = $this->compras_model->compra(array('compras.id'=>$id));
			$data['idmaterial'] = $compra['matid'];
			$material = $this->materiales_model->material($data['idmaterial']);

			if($this->compras_model->actualizar('compras', array('id' => $id), $data))
			{
				$this->db->where('id', $data['idmaterial']);
				$this->db->update('material', array('cantidadMaterial' => ($data['cantidad'] - $compra['cantidad']) + $material['cantidad'])); 
				$this->session->set_flashdata('mensaje', 'Se actualizo la compra exitosamente');
				$this->session->set_flashdata('class', 'alert alert-success');
				redirect("/compras");
			}
			else
			{
				$this->session->set_flashdata('mensaje', 'Error: No se pudo actualizar la compra');
				$this->session->set_flashdata('class', 'alert alert-danger');
				redirect("/compras");
			}
		} 
		else 
		{
			redirect("/compras");
		}
	}

	public function borrar($id = NULL)
	{
		if ($id != NULL) 
		{
			$compra = $this->compras_model->compra(array('compras.id'=>$id));
			$material = $this->materiales_model->material($compra['matid']);
			$this->db->where('id', $compra['matid']);
			$this->db->update('material', array('cantidadMaterial' => $material['cantidad'] - $compra['cantidad']));
			if ($this->db->delete('compras', array('id' => $id)))
			{
				$this->session->set_flashdata('class','alert alert-success');
				$this->session->set_flashdata('mensaje','La compra se eliminó exitosamente');
				redirect("compras");
			}
		} 
		else 
		{
			redirect("compras");
		}
	}

}

