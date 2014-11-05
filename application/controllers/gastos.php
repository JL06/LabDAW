<?php
class Gastos extends MY_Controller{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('gastos_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data["gastos"]=$this->gastos_model->get_gastos();
		$data["main_content"]="gastos";
		$data["title"]="Gastos";
		$this->load->view("templates/template",$data);
	}
	public function agregar()
	{
		$data["gastos"]=$this->gastos_model->leer("tipogasto");
		$data["main_content"]="gasto_form";
		$data["title"]="Registrar gasto";

		$this->load->view("templates/template",$data);
	}

	public function guardar()
	{
		$nombre=$this->input->post("nombre");
		$rules=array(
			array(
				'field' => 'costo',
				'rules'=>'required|numeric|callback_greater_or_equal[0]',
				'label' => 'Costo'
				)
			);
		//si nombre es nulo, se agregara un gasto de tipo existente
		if($nombre === "")
		{
			$idGasto=$this->input->post("idTipoGasto");

		}
		else
		{
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
			$form_values=array("nombre"=>$nombre);
			$valid = $this->validate_form($rules,$form_values,'tipogasto');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('gastos/agregar');
			}

			if($this->gastos_model->crear("tipogasto",$form_values))
			{
				$idGasto = $this->gastos_model->leer("tipogasto",array("nombre"=>$nombre))[0]["id"];
			}else{
				//inform error graciously
			}
		}
		$rules=array(
			array('field' => 'costo', 
				'rules' => 'required|numeric',
				'label' =>'costo'
				),
			array('field' => 'fecha', 
				'rules'=>'required|alpha_dash',
				'label' =>'Fecha'
				)
			);
		
		$form_values=array("idTipoGasto"=>$idGasto,
			"costo"=>$this->input->post("costo"), 
			"fecha"=>$this->input->post("fecha"));
		$valid = $this->validate_form($rules,$form_values,'tipogasto');

		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('gastos/agregar');
		}

		if ($this->gastos_model->crear("gastos",$form_values))
		{
			$this->session->set_flashdata('mensaje','El gasto se agregó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("gastos");		
		}
	}

	public function guardar_actual($id)
	{
		$form_values=$this->input->post();

		if ($form_values['nombre']!="")
		{

			$rules=array(
				array(
					'field'=>'nombre',
					'rules'=>'unique',
					'label'=>'Nombre'
					),
				array(
					'field'=>'nombre',
					'rules'=>'required|min_length[2]|max_length[50]',
					'label'=>'Nombre'
					),
				array(
					'field'=>'costo',
					'rules'=>'required|greater_than[0]|numeric',
					'label'=>'Costo'
					)
				);
			$valid = $this->validate_form($rules,$form_values,'tipogasto');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('gastos/agregar');
			}
			if(! $this->gastos_model->crear('tipogasto',array('nombre'=>$form_values['nombre']))){
				$this->session->set_flashdata('mensaje','Ocurrió un error, inténtelo de nuevo');
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('gastos/agregar');			
			}
			else
			{
				$form_values['idTipoGasto']=$this->gastos_model->leer('tipogasto',array('nombre'=>$form_values['nombre']))[0]['id'];

			}
		}

		unset($form_values['nombre']);

		$rules=array(
			array(
				'field'=>'costo',
				'rules'=>'required|greater_than[0]|numeric',
				'label'=>'Costo'
				)
			);
		$valid = $this->validate_form($rules,$form_values,'gastos');

		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('gastos/agregar');
		}

		if($this->gastos_model->actualizar('gastos',array('id'=>$id),$form_values))
		{
			$this->session->set_flashdata('mensaje','El gasto se actualizó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect('gastos');
		}
		else
		{
			$this->session->set_flashdata('mensaje','Ocurrió un error. Inténtelo de nuevo.');
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('gastos/actualizar');	
		}
	}
	public function actualizar($id)
	{
		$data["gastos"]=$this->gastos_model->leer("tipogasto");
		$data["main_content"]="gasto_form";
		$data["title"]="Actualizar gasto";
		$data['gasto']=$this->gastos_model->get_gastos(array('gastos.id'=>$id))[0];
		$this->load->view("templates/template",$data);

	}
	public function borrar($id)
	{
		
		if ($this->gastos_model->borrar('gastos',array('id'=>$id))) 
		{
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se eliminó exitosamente');
			redirect("gastos");
		}
	}
}
