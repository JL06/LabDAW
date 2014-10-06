<?php
class Reportes extends MY_Controller {

	public function index()
	{
		$data['title'] = "Reportes";
		$data['main_content'] = "reportes";
		$this->load->view('templates/template',$data);
	}

	function balance() {
		$data['title'] = "Balance";
		$data['main_content'] = "balance";
		$this->load->view('templates/template',$data);
	}
	function reporte_ventas($criterio="producto"){
		$data['title'] = "Reporte de ventas";
		$data['main_content'] = "reporte_ventas";
		if($criterio == "producto"){
			$this->load->model("productos_model");
			$data['producto']=$this->productos_model->get_productos(array("activo"=>1));
		}
		$this->load->view('templates/template',$data);
	}


}