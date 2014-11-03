<?php
class Sesion extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		if ($this->session->userdata('id') === FALSE) 
			$this->load->view('inicio_sesion');
		else
			redirect('inicio');
	}

	function iniciar()
	{
		$form_values = $this->input->post();
		$rules=array(
			array(
				'field'=>'correo',
				'rules'=>'required|valid_email',
				'label'=>'Correo'
				),
			array(
				'field'=>'clave',
				'rules'=>'required|alpha_numeric',
				'label'=>'Clave'
				)
			);
		$valid=$this->validate_form($rules,$form_values);
		if ($valid !=1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			redirect("sesion/index");
		}
		$usuario = $this->usuario_model->leer("usuario",array("email"=>$form_values["correo"],"activo"=>1));


		if (count($usuario) !== 1)
		{
			$this->session->set_flashdata('mensaje',"No hay un usuario registrado con ese correo");
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("sesion/index");
		}
		else
		{
			$usuario = $usuario[0];
			if( password_verify($form_values["clave"],$usuario["password"]) )
			{
				$info['nombre'] = $usuario['nombre'];
				$info['id'] = $usuario['id'];
				$info['correo'] = $usuario['email'];
				$info['genero'] = $usuario['genero'];
				$info['rol'] = $usuario['idRol'];
				$this->session->set_userdata($info);
				redirect("inicio");
			}
			else
			{
				//print_r($usuario);

				$this->session->set_flashdata('mensaje',"<label class='control-label'>La contraseña es incorrecta</label>");
				$this->session->set_flashdata('class',"has-error");
				redirect("sesion/index");
			}
		}

	}

	function cerrar() {
		$this->session->sess_destroy();
		$red = "Location: " . site_url("/sesion");
		header($red);
	}
	function acceso_denegado(){
		$data=array("main_content"=>"permission_denied","title"=>"Acceso denegado");
		$this->load->view("templates/template",$data);
	}

	function validate_form($rules,$form_values,$entity="")
	{
		$valid=1;
		$unique_error="";
		foreach ($rules as $r) 
		{
			if($r['rules'] == 'unique')
			{
				$rep = $this->generic_model->repite($entity,$r['field'],$form_values[$r['field']]);

				if ($rep)
				{
					$unique_error ='El '.$r['label'].' no está disponible';
					$valid=FALSE;
				}

			}
			else
			{
				$this->form_validation->set_rules($r['field'], $r['label'], $r['rules']);
			}
		}

		if ($this->form_validation->run() === FALSE)
		{
			$valid=validation_errors();
		}

		if ($valid != 1)
			$valid.=$unique_error;

		return $valid;
	}
}
/* End of file sesion.php */
/* Location: controllers/sesion.php */
