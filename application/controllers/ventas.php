<?php
class Ventas extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ventas_model');
		$this->load->library('form_validation');
	}
	public function listar() {
		if ($this->session->userdata('rol') == 2)
			$data['ventas']=$this->ventas_model->get_ventas(array('idVendedor'=>$this->session->userdata('id')));
		else
			$data['ventas']=$this->ventas_model->get_ventas();

		$data['main_content']="ventas";
		$data['title']="Ventas";
		$this->load->view('templates/template',$data);
	}

	public function registrar(){
		$productos=$this->ventas_model->leer('productos','activo = 1 AND cantidadProducto > 0');
		$vendors=$this->ventas_model->leer('usuario');
		$lugares=$this->ventas_model->leer('lugar');
		$data = array('main_content' => 'venta_form','title'=>'Registrar Venta','productos'=>$productos,'vendedor'=>$vendors,'lugar'=>$lugares );

		$this->load->view('templates/template',$data);

	}
	public function insertar_venta()
	{
		$form_values=$this->input->post();
		$rules=array(
			array(
				'field'=>'cantidad',
				'rules'=>'required|numeric|is_natural_no_zero',
				'label'=>'Cantidad'
				),
			array(
				'field'=>'fecha',
				'rules'=>'required|alpha_dash',
				'label'=>'Fecha'
				)
			);

		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid=$this->validate_form($rules,$form_values,'ventas');


		if ( $valid != 1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('ventas/registrar');
		}
		
		$form_values['importe']=$this->ventas_model->leer("productos",array("id"=>$form_values['idProducto']))[0]['precio'];
		$form_values['idVendedor']=$this->session->userdata('id');

		$id_producto = $form_values['idProducto'];
		$cant = $this->ventas_model->leer("productos",array("id"=>$id_producto))[0]['cantidadProducto'];
		if ($cant < $form_values['cantidad']){
			$this->session->set_flashdata('mensaje',"No hay suficientes productos para la venta");
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('ventas/registrar');
		}


		if( $this->ventas_model->crear("ventas",$form_values)){

			if ($this->session->userdata('rol') == 1)
				$this->ventas_model->actualizar('productos',array('id'=>$form_values['id_producto']),'cantidadProducto = cantidadProducto-1');
			else
				$this->ventas_model->actualizar('asignacion',array('id_producto'=>$form_values['id_producto']),'cantidad = cantidad-1');

			$this->session->set_flashdata('mensaje', 'La venta se registró exitosamente');
			$this->session->set_flashdata('class','alert alert-success');

			redirect('ventas/listar');
		}else{
			$this->session->set_flashdata('mensaje',"Ocurrió un error, inténtelo nuevamente.");
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('ventas/registrar');
		}
	}

	public function borrar($venta_id){
		if( $this->ventas_model->borrar('ventas', array('id' => $venta_id))) {
			$this->session->set_flashdata('mensaje', 'La venta se eliminó exitosamente');
			$this->session->set_flashdata('class', 'alert alert-success');
			redirect('ventas/listar');			
		}else{
			$this->session->set_flashdata('mensaje',"Ocurrió un error, inténtelo nuevamente.");
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('ventas/listar');			
		}
	}

	public function actualizar_venta($venta_id){
		$data['main_content']="venta_form";
		$data['title']="Actualizar Venta";
		$venta = $this->ventas_model->actualizar_venta(array('ventas.id' => $venta_id))[0];
		$data['venta']=json_encode($venta);
		$data['venta_id']=$venta_id;
		$data['productos']=$this->ventas_model->leer('productos','activo = 1 AND cantidadProducto > 0');
		$data['productos'][]=$this->ventas_model->leer('productos','id = '.$venta['idProducto'])[0];
		$data['vendedor']=$this->ventas_model->leer('usuario');
		$data['lugar']=$this->ventas_model->leer('lugar');

		$this->load->view('templates/template',$data);
	}

	public function actualizar($venta_id)
	{
		$form_values=$this->input->post();
		$this->load->model("productos_model");

		$rules=array(
			array(
				'field'=>'cantidad',
				'rules'=>'required|numeric|is_natural_no_zero',
				'label'=>'Cantidad'
				),
			array(
				'field'=>'fecha',
				'rules'=>'required|alpha_dash',
				'label'=>'Fecha'
				)
			);

		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid=$this->validate_form($rules,$form_values,'ventas');

		if ( $valid != 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('ventas/actualizar_venta/'.$id);
		}

		
		$venta_original = $this->ventas_model->leer('ventas',array('ventas.id'=>$venta_id))[0];

		//producto seleccionado en la forma
		$producto = $this->ventas_model->leer("productos",array("id"=>$form_values['idProducto']))[0];
		
		$producto_original = $this->ventas_model->leer("productos",array("id"=>$venta_original['idProducto']))[0];


		//AJUSTE DE STOCK
		if ($form_values['idProducto'] == $venta_original['idProducto'])
		{
			if ($venta_original['cantidad'] != $form_values['cantidad']) 
			{

				$stock= $producto_original['cantidadProducto'] + $venta_original['cantidad'] - $form_values['cantidad'];
			//var_dump($venta_original);

				if ($stock >= 0)
				{
					$this->productos_model->actualizar("productos",array('id'=>$producto_original['id']),array('cantidadProducto'=>$stock));

				}
				else
				{
					$this->session->set_flashdata('mensaje',"No hay suficientes productos para la venta");
					$this->session->set_flashdata('class','alert alert-danger');
					redirect('ventas/actualizar_venta/'.$venta_original['id']);
				}

			}

		}
		else
		{

			$cant= $producto['cantidadProducto'];

			if ($cant < $form_values['cantidad'])
			{
				$this->session->set_flashdata('mensaje',"No hay suficientes productos para la venta");
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('ventas/actualizar_venta/'.$venta_original['id']);
			}
			else
			{
				$stock = $producto_original['cantidadProducto'] + $venta_original['cantidad'];
				$this->productos_model->actualizar("productos",array('id'=>$producto_original['id']),array('cantidadProducto'=>$stock));

				$stock= $producto['cantidadProducto'] - $form_values['cantidad'];
				$this->productos_model->actualizar("productos",array('id'=>$form_values['idProducto']),array('cantidadProducto'=>$stock));
				
			}
		}




		if ($this->session->userdata('rol') == 2)
		{
			$mail['venta_original']= $this->ventas_model->get_ventas("ventas.id = ".$venta_id)[0];
			$mail['vendedor'] = $this->session->userdata("nombre");
			$mail['fecha_cambio'] = date('Y-m-d');
			$prod= $this->productos_model->producto($form_values['idProducto']);

			$mail['venta_cambio']=array(
				'producto' => $prod['nombre'],
				'lugar' => $this->ventas_model->leer("lugar",array('id'=>$form_values['idLugar']))[0]['nombre'],
				'fecha' => $form_values['fecha'],
				'cantidad' =>$form_values['cantidad'],
				'total' => $form_values['cantidad'] * $prod['precio']
				);
			$this->load->model("usuario_model"); 
			$admin = $this->usuario_model->get_usuarios(array('activo'=>1,'idRol'=>1));
			
			$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.googlemail.com',
				'smtp_port' => 465,
				'smtp_user' => 'anaglezr13@gmail.com',
				'smtp_pass' => 'anita123#',
				'mailtype'  => 'html', 
				'charset'   => 'utf-8'
				);
			$this->load->library('email', $config);
			$this->email->set_newline("\r\n");
			
			foreach ($admin as $a) 
			{
				$this->email->from('anaglezr13@gmail.com', 'Sistema de administración de ventas');
				$this->email->clear();
				$mail['name']	= $a['nombre'];
				$mail['email'] = $a['email'];
				$mensaje = $this->load->view("templates/mail",$mail,TRUE);
				$this->email->to($a['email'], 'Sistema de administración de ventas');
				$this->email->subject('Notificación de cambio');
				$this->email->message($mensaje);

				if (!$this->email->send()) {
					show_error($this->email->print_debugger());

				}
			}
		}

		if($this->ventas_model->actualizar('ventas', array('id' => $venta_id), $form_values))
		{

			$this->session->set_flashdata('mensaje','La venta se actualizó exitosamente');


			$this->session->set_flashdata('class','alert alert-success');

			redirect('ventas/listar');
		}
	}

	function get_cantidad()
	{
		$id_prod=$this->input->post("selProd");
		if ($id_prod !=NULL) {
			echo $this->ventas_model->leer("productos",array("id"=>$id_prod))[0]["cantidadProducto"];
		}
	}
}
