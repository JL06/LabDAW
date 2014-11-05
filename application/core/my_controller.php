<?php

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->comprueba_sesion();
		$this->load->model("generic_model");
		$this->load->helper('form');
		//$this->comprueba_permiso();
	}
	protected function comprueba_sesion()
	{
		if ($this->session->userdata('id') === FALSE) 
		{
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
		}
	}
	
	protected function comprueba_permiso()
	{
		$this->load->model("permission_model");
		$accion=$this->uri->segment(1)."/".$this->uri->segment(2);
		$rol=$this->session->userdata('rol');
		if ( ! $this->permission_model->has_permission($rol, $accion) && $accion != "/")
		{
			redirect("sesion/acceso_denegado");			
		}
		else
		{
			//$this->log();
		}
	}

	protected function validate_form($rules,$form_values,$entity="")
	{
		$valid=1;
		$unique_error="";
		foreach ($rules as $r) 
		{
			if($r['rules'] == 'unique')
			{
				
				if($entity == 'material')
				{
					$rep = $this->generic_model->repite($entity, $r['field'], array('idTipo'=>$form_values['idTipo'], 'idColor'=>$form_values['idColor']));
				}
				else
				{
					$rep = $this->generic_model->repite($entity, $r['field'], $form_values[$r['field']]);
					
				}

				if ($rep)
				{
					$unique_error ='El '.$r['label'].' ya está registrado. Registre uno diferente o modifique el que ya existe.';
					$valid=FALSE;
				}

			}
			else
			{
				$this->form_validation->set_rules($r['field'], $r['label'], $r['rules']);
			}
		}

		if ($this->form_validation->run() === FALSE)
		{
			$valid=validation_errors();
		}

		if ($valid != 1)
			$valid.=$unique_error;

		return $valid;
	}
	
	public function greater_or_equal($str,$num)
	{
		return $str >= $num;
	}
	protected function log()
	{
		$user=$this->session->userdata('id');
		$date = date("Y-m-d");
		$accion=$this->uri->segment(1)."/".$this->uri->segment(2);
		if($accion == "/")
			$accion="inicio";
		$this->permission_model->crear("log",array("accion"=>$accion, "idUsuario"=>$user,"fecha"=>$date));
	}

	protected function ymd_mdy($fecha)
	{
		$date = explode('-', $fecha);
		return $date[1].'-'.$date[2].'-'.$date[0];
	}

	protected function mdy_ymd($fecha)
	{
		$date = explode('-', $fecha);
		return $date[2].'-'.$date[0].'-'.$date[1];
	}


	protected function mdy_dmy($fecha)
	{
		$date = explode('-', $fecha);
		return $date[1].'-'.$date[0].'-'.$date[2];
	}
}
