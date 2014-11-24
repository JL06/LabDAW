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
		$this->load->model("usuario_model");
		$this->load->model("reportes_model");
		$id = $this->session->userdata('id');
		$rol = $this->session->userdata("rol");
		$data=array(
			'main_content'=>'inicio',
			'title'=>'Inicio'
			);
		$data["usuario"] = $this->usuario_model->usuario($id);
		if ($data["usuario"]["tipo"] == "admin")
			$data["usuario"]["tipo"] = "Administrador";
		else if ($data["usuario"]["tipo"] == "vendor")
			$data["usuario"]["tipo"] = "Vendedor";
		
		$data["historial"] = $this->historial($this->usuario_model->get_log($id));
		$ventas = $this->reportes_model->get_ventas(date("Y-m-01"),date("Y-m-t"),"idVendedor=".$id);

		$asignaciones = $this->usuario_model->get_asignaciones($rol,$id);

		$data["ventas"] = json_encode($ventas);
		$data['asignaciones'] = $asignaciones;
		$this->load->view('templates/template',$data);
	}
	public function historial($log)
	{
		$hist = array();

		foreach ($log as $l) 
		{
			$action = explode("/",$l["accion"]);
			if (isset($action[1]))
			{
				if (strpos($action[1],"insertar") !== FALSE OR strpos($action[1],"guardar ") !== FALSE)
				{
					$a = "Agregaste";
					switch ($action[0]) {
						case 'ventas':
						$a.=" una venta";
						break;

						case 'productos':
						$a.=" un producto";
						break;

						case 'usuario':
						$a.=" un usuario";
						break;

						case 'compras':
						$a.=" una compra";
						break;
						case 'gastos':
						$a.=" un gasto";
						break;

						default:
						$a="";
						break;

					}
					if ($a !=="")
						$hist[]= array("accion" => $a,"fecha" => $l['hora']);
				}

				if (strpos($action[1],"actualizar") !== FALSE OR strpos($action[1],"guardar_actual") !== FALSE OR strpos($action[1],"guarda_actual") !== FALSE)
				{
					$a = "Actualizaste";
					switch ($action[0]) {
						case 'ventas':
						$a.=" una venta";
						break;

						case 'productos':
						$a.=" un producto";
						break;

						case 'usuario':
						$a.=" un usuario";
						break;

						case 'compras':
						$a.=" una compra";
						break;
						case 'gastos':
						$a.=" un gasto";
						break;

						default:
						$a="";
						break;

					}
					if ($a !=="")
						$hist[]= array("accion" => $a,"fecha" => $l['hora']);
				}
				if (strpos($action[1],"borrar") !== FALSE)
				{
					$a = "Eliminaste";
					switch ($action[0]) {
						case 'ventas':
						$a.=" una venta";
						break;

						case 'productos':
						$a.=" un producto";
						break;

						case 'usuario':
						$a.=" un usuario";
						break;

						case 'compras':
						$a.=" una compra";
						break;
						case 'gastos':
						$a.=" un gasto";
						break;

						default:
						$a="";
						break;

					}
					if ($a !=="")
						$hist[]= array("accion" => $a,"fecha" => $l['hora']);
				}
				if ($action[1] == "guarda_reset")
				{
					$hist[]= array(
						"accion" => "Actualizaste tu contraseña",
						"fecha" => $l['hora']
						);
				}

			}
		}
		return $hist;
	}
	public function subcatalogos()
	{
		$this->load->model("gastos_model");

		$data=array(
			'main_content'=>'subcatalogos',
			'title'=>'Administrar subcatálogos'
			);
		$data['tipogasto'] = $this->gastos_model->leer("tipogasto",array("activo"=>1));
		$data['tipoproducto']= $this->gastos_model->leer("tipoproducto",array("activo"=>1));
		$data['tipomaterial']= $this->gastos_model->leer("tipomaterial",array("activo"=>1));
		$data['colores']=$this->gastos_model->leer("color",array("activo"=>1));

		$this->load->view('templates/template',$data);
	}
}

/* End of file inicio.php */
/* Location: controllers/inicio.php */