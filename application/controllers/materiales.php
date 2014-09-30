<?php
class Materiales extends MY_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
	}
	public function listar() {
		$data['materiales']=$this->materiales_model->get_materiales(array('material.activo'=>1));
		$data['main_content']="materiales";
		$data['title']="Materiales";
		$this->load->view('templates/template',$data);
	}

}
?>