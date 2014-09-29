<?php

class MY_Controller extends CI_Controller{
	public function __construct()
	{
		parent::__construct();
		$this->comprueba_sesion();
	}
	protected function comprueba_sesion() {
		if ($this->session->userdata('id') === FALSE) {
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
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
}
?>