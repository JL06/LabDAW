<?php
class Reportes extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->model('reportes_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['title'] = "Reportes";
		$data['main_content'] = "reportes";
		$this->load->view('templates/template',$data);
	}

	function balance() 
	{
		$f1 = $this->input->post('from');
		$f2 = $this->input->post('to');
		
		if ($f1 == NULL)
			$f1=date("Y-m-01");
		
		
		if ($f2 == NULL)
			$f2=date("Y-m-t");

		$ventas = $this->reportes_model->get_sum("ventas","importe * cantidad", $f1,$f2);
		$compras =  $this->reportes_model->get_sum("compras","costo * cantidad",$f1,$f2);
		$gastos =  $this->reportes_model->get_sum("gastos","costo",$f1,$f2);
		
		$data['total'] = $ventas - $compras - $gastos;
		$data['sum_importe_ventas'] = $ventas === NULL? 0 : $ventas;
		$data['sum_compras'] = $compras === NULL? 0 : $compras;
		$data['sum_gastos'] = $gastos === NULL? 0 : $gastos;

		$data['gastos'] = json_encode($this->reportes_model->get_gastos($f1,$f2));
		$data['ventas'] = json_encode($this->reportes_model->get_ventas($f1,$f2));
		$data['fecha1'] =$f1;
		$data['fecha2'] =  $f2;
		$data['title'] = "Balance";
		$data['main_content'] = "balance";
		$this->load->view('templates/template',$data);
	}

	function reporte_ventas($criterio="producto")
	{
		$data['title'] = "Reporte de ventas";
		$data['main_content'] = "reporte_ventas";
		if($criterio == "producto"){
			$this->load->model("productos_model");
			$data['producto']=$this->productos_model->get_productos(array("activo"=>1));
		}
		$this->load->view('templates/template',$data);
	}


}