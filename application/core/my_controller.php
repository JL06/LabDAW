<?php

class MY_Controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->comprueba_sesion();

		//$this->comprueba_permiso();
	}
	protected function comprueba_sesion() {
		if ($this->session->userdata('id') === FALSE) {
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
		}
	}
	
	protected function comprueba_permiso(){
		$this->load->model("permission_model");
		$accion=$this->uri->segment(1)."/".$this->uri->segment(2);
		$rol=$this->session->userdata('rol');
		if (!$this->permission_model->has_permission($rol, $accion) && $accion != "/"){
			redirect("sesion/acceso_denegado");			
		}else{
			//$this->log();
		}
	}

	protected function validate_form($rules,$form_values,$entity){
		$valid=1;
		$unique_error="";
		foreach ($rules as $r) {
			if($r['rules'] == 'unique'){
				$rep=$this->productos_model->repite($entity,$r['field'], $form_values[$r['field']] );

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

	protected function log(){
		$user=$this->session->userdata('id');
		$date = date("Y-m-d");
		$accion=$this->uri->segment(1)."/".$this->uri->segment(2);
		if($accion == "/")
			$accion="inicio";
		$this->permission_model->crear("log",array("accion"=>$accion, "idUsuario"=>$user,"fecha"=>$date));
	}
}
?>