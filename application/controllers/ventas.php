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

	public function register_form(){
		$productos=$this->ventas_model->leer('productos');
		$vendors=$this->ventas_model->leer('usuario');
		$lugares=$this->ventas_model->leer('lugar');
		$data = array('main_content' => 'venta_form','title'=>'Registrar Venta','productos'=>$productos,'vendedor'=>$vendors,'lugar'=>$lugares );

		$this->load->view('templates/template',$data);

	}
	public function insertar_venta(){
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
			redirect('ventas/register_form');
		}
		if( $this->ventas_model->crear('ventas',$form_values)){
			$this->session->set_flashdata('mensaje', 'La venta se registró exitosamente');
			redirect('ventas/listar');
		}
	}
}
?>