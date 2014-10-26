<?php
class Ventas extends MY_Controller{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ventas_model');
		$this->load->library('form_validation');
	}
	public function listar() {
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
		if( $this->ventas_model->crear('ventas',$form_values)){
			if ($this->session->userdata('rol') == 1)
				$this->ventas_model->actualizar('productos',array('id'=>$form_values['idProducto']),'cantidadProducto = cantidadProducto-1');
			else
				$this->ventas_model->actualizar('asignacion',array('idProducto'=>$form_values['idProducto']),'cantidad = cantidad-1');

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
		$data['productos']=$this->ventas_model->leer('productos');
		$data['vendedor']=$this->ventas_model->leer('usuario');
		$data['lugar']=$this->ventas_model->leer('lugar');

		$this->load->view('templates/template',$data);
	}

	public function actualizar($venta_id){
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
			redirect('ventas/actualizar_venta/'.$id);
		}

		if($this->ventas_model->actualizar('ventas', array('id' => $venta_id), $form_values)){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','La venta se actualizó exitosamente');

			redirect('ventas/listar');
		}
	}
}
