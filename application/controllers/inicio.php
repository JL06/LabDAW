<?php
class Inicio extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data=array(
			'main_content'=>'inicio',
			'title'=>'Inicio'
			);
		$this->load->view('templates/template',$data);
	}
	public function subcatalogos()
	{
		$this->load->model("gastos_model");

		$data=array(
			'main_content'=>'subcatalogos',
			'title'=>'Subcatalogos'
			);
		$data['tipogasto'] = $this->gastos_model->leer("tipogasto",array("activo"=>1));
		$data['tipoproducto']= $this->gastos_model->leer("tipoproducto",array("activo"=>1));
		$data['tipomaterial']= $this->gastos_model->leer("tipomaterial",array("activo"=>1));
		$data['colores']=$this->gastos_model->leer("color",array("activo"=>1));

		$this->load->view('templates/template',$data);
	}
}