<?php
class Usuarios extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('generic_model');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$res=$this->usuario_model->listar(array("activo"=>1));
		$data['title'] = "Usuarios";
		$data['main_content'] = "usuarios";
		$data['usuarios'] = $res;
		$this->load->view('templates/template',$data);
	}

	function agregar () 
	{
		$res = $this->generic_model->listar("rol");

		$data['title'] = "Nuevo Usuario";
		$data['main_content'] = "forma_usuario";
		$data['roles'] = $res;
		$data['titulo'] = "Crea un Usuario";
		$data['subtitulo'] = "Usuario nuevo";
		$data['link'] = "guardar";
		$this->load->view('templates/template',$data);
	}
	function guardar () {
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('correo', 'Correo eléctronico', 'valid_email');
		$this->form_validation->set_rules('correo', 'Correo eléctronico', 'required');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');
		$this->form_validation->set_rules('clave2', 'Contraseña', 'required');
		if (strcmp($this->input->post('clave'), $this->input->post('clave2')) != 0 OR $this->form_validation->run() == FALSE) {
			$errores = validation_errors();
			$this->session->set_flashdata('mensaje', 'Error: los dos campos de contraseña deben ser iguales'.$errores);
			redirect("usuarios/agregar");
			return;
		}

		$data['password'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
		$data['nombre'] = $this->input->post('nombre');
		$data['email'] = $this->input->post('correo');
		$data['genero'] =$this->input->post('genero');
		$data['idrol'] = $this->input->post('rol');
		$data['telefono'] = $this->input->post('telefono');
		
		if($this->db->insert('usuario',$data)){
			$this->session->set_flashdata('mensaje', 'El usuario fue agregado');
			redirect("usuarios");
		}

	}

	function actualizar($id = NULL) {
		if ($id != NULL) {
			$roles = $this->generic_model->listar("rol");
			$data = $this->usuario_model->usuario(array("usuario.id"=> $id));
			$data['main_content'] = 'forma_usuario';
			$data['title'] = 'Actualizar Usuario';
			$data['titulo'] = 'Actualizar Usuario';
			$data['subtitulo'] = 'Actualiza su información';
			$data['link'] = "guarda_actual/".$id;
			$data['roles'] = $roles;
			$this->load->view('templates/template',$data);
		} else {
			redirect("usuarios");
		}

	}

	function guarda_actual ($id = NULL) {
		if ($id != NULL) {
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('correo', 'Correo eléctronico', 'valid_email');
			$this->form_validation->set_rules('correo', 'Correo eléctronico', 'required');
			$this->form_validation->set_rules('clave', 'Contraseña', 'required');
			$this->form_validation->set_rules('clave2', 'Contraseña', 'required');
			if (strcmp($this->input->post('clave'), $this->input->post('clave2')) != 0 OR $this->form_validation->run() == FALSE) {
				$errores = validation_errors();
				$this->session->set_flashdata('mensaje', 'Error: los dos campos de contraseña deben ser iguales'.$errores);
				redirect("usuarios/agregar");
				return;
			}
			
			$data['password'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
			$data['nombre'] = $this->input->post('nombre');
			$data['email'] = $this->input->post('correo');
			$data['genero'] =$this->input->post('genero');
			$data['idrol'] = $this->input->post('rol');
			$data['telefono'] = $this->input->post('telefono');
			if ($this->usuario_model->actualizar("usuario", array('id' => $id), $data)) {
				$this->session->set_flashdata('mensaje', 'El usuario fue actualizado');
				redirect("usuarios");
			}
		} else {
			redirect("usuarios");
		}
	}

	public function borrar($id = NULL){
		if ($id != NULL) {
			if ($this->usuario_model->actualizar('usuario',array('id'=>$id),array('activo'=>0))) {
				$this->session->set_flashdata('class','alert alert-success');
				$this->session->set_flashdata('mensaje','El usuario se eliminó exitosamente');
				redirect("usuarios");
			}
		} else {
			redirect("usuarios");
		}
	}


}