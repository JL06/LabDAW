<?php
class Reportes extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->model('reportes_model');
		$this->load->model('productos_model');
		$this->load->model('usuario_model');
		$this->load->model('ventas_model');
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

	function reporte_ventas()
	{
		$filter = $this->input->post("criterio");

		if ($filter == NULL)
			$filter ="producto";

		
		$from = $this->input->post("from");
		$to = $this->input->post("to");

		if ($from == NULL)
			$from = date("Y-m-01");

		if ($to == NULL)
			$to = date("Y-m-t");

		if ($filter !== "tiempo")
		{
			$select = $this->input->post("filtro");
			if ($select == NULL)
				$select="todos";

			if (is_array($select))
			{
				$select = implode(',',$select);

			}

			if ($filter == 'producto') 
			{
				$datos = json_encode($this->reportes_model->get_ventas_producto($select,$from,$to));
			}
			else
			{
				$datos = json_encode($this->reportes_model->get_ventas_vendedor($select,$from,$to));
			}

		}
		else
		{

			$datos=json_encode($this->reportes_model->get_ventas($from,$to));
		}

		$data['title'] = "Reporte de ventas";
		$data['main_content'] = "rep_ventas";
		$data['filter'] =$filter;
		$data['grafica'] = $datos;
		$data['fecha1'] =$from;
		$data['fecha2'] =  $to;

		$this->load->view('templates/template',$data);
	}

	function reporte_gastos()
	{
		$f1 = $this->input->post('from');
		$f2 = $this->input->post('to');
		if ($f1 == NULL)
			$f1=date("Y-m-01");
		
		
		if ($f2 == NULL)
			$f2=date("Y-m-t");

		$ver = $this->input->post("ver");
		
		if($ver == FALSE)
		{
			$gastos = $this->reportes_model->get_gastos($f1,$f2);
			$data['sel'] = "compras,gastos";

		}
		else if (count($ver) == 2)
		{
			$gastos = $this->reportes_model->get_gastos($f1,$f2);
			$data['sel'] = implode(",", $ver);

		}
		else if(count($ver) == 1)
		{
			$gastos = $this->reportes_model->get($ver[0],$f1,$f2);


			$data['sel'] = implode(",", $ver);

		}

		if (isset($gastos))
		{
			$data['gastos'] = json_encode($gastos);		
		}

		$data['fecha1'] =$f1;
		$data['fecha2'] =  $f2;
		$data['title'] = "Reporte de gastos";
		$data['main_content'] = "rep_gastos";
		$this->load->view('templates/template',$data);
	}

	function get_info_ventas()
	{
		$criterio = $this->input->post("filter");
		if ($criterio == "producto")
		{
			$info = $this->productos_model->get_productos(array('productos.activo'=>1));

		}
		else if ($criterio == "usuario")
		{
			$info = $this->usuario_model->get_usuarios(array('usuario.activo'=>1));
		}
		echo json_encode($info);
	}

}