<?php

class MY_Controller extends CI_Controller{
	public function __construct()
	{
            parent::__construct();
            //$this->comprueba_sesion();
    }
	protected function comprueba_sesion() {
		if ($this->session->userdata('id') === FALSE) {
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
		}
	}
	public function validar_forma() {
		
	}
}
?>