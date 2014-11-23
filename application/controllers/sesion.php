<?php
class Sesion extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('sesion_model');
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
				'rules'=>'required',
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
			if( MD5($form_values["clave"]) ===$usuario["password"] )
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

				$this->session->set_flashdata('mensaje',"<label class='control-label'>La contraseña es 

					incorrecta</label>");
				$this->session->set_flashdata('class',"has-error");
				redirect("sesion/index");
			}
		}

	}

	function cerrar() 
	{
		$this->session->sess_destroy();
		$red = "Location: " . site_url("/sesion");
		header($red);
	}

	function acceso_denegado()
	{
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

	public function recupera()
	{

		$this->form_validation->set_rules('mail', 'Correo eléctronico', 'valid_email|required');
		if ($this->form_validation->run() == FALSE) 
		{
			$errores = validation_errors();
			$this->session->set_flashdata('class', 'alert alert-danger');
			$this->session->set_flashdata('mensaje', 'Error: '.$errores);
			redirect("sesion");
			return;
		}

		
		$correo = $this->input->post("mail");

		if ( ! $this->sesion_model->existe($correo)) {
			$this->session->set_flashdata('class', 'alert alert-danger');
			$this->session->set_flashdata('mensaje', 'Error: No esta registrado el correo '.$correo);
			redirect("sesion");
			return;
		}

		$this->load->helper('string');
		$token = random_string('alnum', 16);
		$url = site_url("/sesion/reset/".$token);

		date_default_timezone_set('America/Mexico_City');
		$fecha = date("Y:m:d H:i:s");
		$this->sesion_model->agrega($correo, $token, $fecha);

		$this->load->library('email');
		$this->email->from('noreply@labdaw.com', 'Sistema de Administracion');
		$this->email->to($correo); 
		$this->email->subject('Contraseña olvidada');
		$this->email->message('Accede a esta liga para crear una nueva contraseña: '.$url);	
		$this->email->send();

		$this->load->view("confirmacion");
	}

	public function reset($token = NULL)
	{
		if ($token != NULL AND strlen($token) == 16)
		{
			$id = $this->sesion_model->usuario($token);
			if ($id != -1) {
				
				date_default_timezone_set('America/Mexico_City');

				$fecha = $this->sesion_model->fecha($token);
				$db = DateTime::createFromFormat("Y-m-d H:i:s", $fecha);

				$actual = new DateTime(date("Y:m:d H:i:s"));
				$intervalo = $db->diff($actual);
				$dias = $intervalo->format('%a');
				//echo $intervalo->format('%h horas, %i minutos %d dias %y year, dias %a');
				//$horas = $intervalo->format('%h');
				//echo "horas: ".$horas." dias: ".$dias;

				if ($dias < 1) {
					$data['token'] = $token;
					$this->load->view("reset", $data);
				}
				else
				{
					$info['token'] = 1;
					$this->sesion_model->actualizar('recupera', array('token' => $token), $info);
					redirect("sesion");
				}
			}
			else
			{
				redirect("sesion");
			}
		}
		else
		{
			redirect("sesion");
		}
	}

	public function guarda_reset($token = NULL)
	{
		if ($token != NULL AND strlen($token) == 16)
		{
			$id = $this->sesion_model->usuario($token);
			if ($id != -1) 
			{
				$this->form_validation->set_rules('clave', 'Contraseña', 'required');
				$this->form_validation->set_rules('clave2', 'Contraseña', 'required');
				if (strcmp($this->input->post('clave'), $this->input->post('clave2')) != 0 OR $this->form_validation->run() == FALSE) 
				{
					$errores = validation_errors();
					$this->session->set_flashdata('mensaje', 'Error: los dos campos de contraseña deben ser iguales'.$errores);
					redirect("sesion/reset/".$token);
					return;
				}

				$data['password'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
				if($this->sesion_model->actualizar('usuario', array('id' => $id), $data))
				{
					$info['token'] = 0;
					$this->sesion_model->actualizar('recupera', array('token' => $token), $info);
					$this->session->set_flashdata('mensaje', 'Se actualizo la contraseña exitosamente');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect("sesion");
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Error: No se pudo cambiar la contraseña');
					$this->session->set_flashdata('class', 'alert alert-danger');
					redirect("sesion/reset/".$token);
				}
			}
			else
			{
				redirect("sesion");
			}
		}
		else
		{
			redirect("sesion");
		}
	}
	function mail()
	{
		$this->load->view("templates/mail");
	}
}
/* End of file sesion.php */
/* Location: controllers/sesion.php */
