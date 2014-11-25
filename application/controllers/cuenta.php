<?php
class Cuenta extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('usuario_model');
		//$this->load->model('generic_model');
		$this->load->library('form_validation');
	}

	public function index() 
	{
		$id = $this->session->userdata('id');
		$data = $this->usuario_model->usuario( $id);
		$data['title'] = "Mi Cuenta";
		$data['main_content'] = "mi_cuenta";
		$this->load->view('templates/template',$data);
	}

	public function actualiza() 
	{
		$id = $this->session->userdata('id');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('correo', 'Correo eléctronico', 'valid_email');
		$this->form_validation->set_rules('correo', 'Correo eléctronico', 'required');

		if ($this->form_validation->run() == FALSE) 
		{
			$errores = validation_errors();
			$this->session->set_flashdata('mensaje', 'Error: '.$errores);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("cuenta");
			return;
		}

		$data['nombre'] = $this->input->post('nombre');
		$data['email'] = $this->input->post('correo');
		$data['genero'] =$this->input->post('genero');
		$data['telefono'] = $this->input->post('telefono');
		if ($this->usuario_model->actualizar("usuario", array('id' => $id), $data))
		{
			$this->session->set_flashdata('mensaje', 'Información actualizada');
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_userdata('nombre', $data['nombre']);
			redirect("cuenta");
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Error: la información no pudo ser actualizada');
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("cuenta");
		}
	}

	public function clave_nueva() 
	{
		$id = $this->session->userdata('id');
		$usuario = $this->usuario_model->usuario_completo(array("usuario.id"=> $id));
		$clave_actual = $this->input->post('clave0');
		$clave_usuario = $usuario['password'];

		if ($usuario['password'] != MD5($clave_actual))
		{
			// No es la clave
			$this->session->set_flashdata('mensaje', 'Error: Contraseña incorrecta');
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("cuenta");
			return;
		}

		$clave = $this->input->post("clave");
		$clave2 = $this->input->post("clave2");

		if (strcmp($clave, $clave2) != 0) 
		{
			// no son iguales
			$this->session->set_flashdata('mensaje', 'Error: Los campos de nueva contraseña deben ser iguales');
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("cuenta");
			return;
		}
		
		$data['password'] = MD5($clave);

		if ($this->usuario_model->actualizar("usuario", array('id' => $id), $data)) 
		{
			$this->session->set_flashdata('mensaje', 'La contraseña fue cambiada con exito');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("cuenta");
		}
		else
		{
			$this->session->set_flashdata('mensaje', 'Error: la contraseña no pudo ser actualizada');
			$this->session->set_flashdata('class','alert alert-danger');
			redirect("cuenta");
		}
	}
}

/* End of file cuenta.php */
/* Location: controllers/cuenta.php */