<?php
class Usuarios extends CI_Controller {
	public function index()
	{
		$this->comprueba_sesion();
		$this->db->select('usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		$query = $this->db->get();
		//$query = $this->db->query("SELECT * FROM usuario;");
		foreach ($query->result() as $row) {
			$res[] = $row;
		}
		$data['title'] = "Usuarios";
		$data['main_content'] = "usuarios";
		$data['usuarios'] = $res;
		$this->load->view('templates/template',$data);
	}

	function agregar ($error = null) 
	{
		//$this->comprueba_sesion();
		$rol = $this->db->get("rol");
		foreach ($rol->result() as $row) {
			$res[] = $row;
		}

		if ($error == 1) {
			$data['errorclave'] = true;
		}

		$data['title'] = "Nuevo Usuario";
		$data['main_content'] = "crear_usuario";
		$data['roles'] = $res;
		$this->load->view('templates/template',$data);
	}

	function guardar () {
		//$this->comprueba_sesion();
		if (strcmp($this->input->post('clave'), $this->input->post('clave2')) != 0) {
			$red = "Location: " . site_url("/usuarios/agregar/1");
			header($red);
			return;
		}
		$data['password'] = password_hash($this->input->post('clave'), PASSWORD_DEFAULT);
		$data['nombre'] = $this->input->post('nombre');
		$data['email'] = $this->input->post('correo');
		$data['genero'] = $this->input->post('genero');
		$data['idrol'] = $this->input->post('rol');
		$data['telefono'] = $this->input->post('telefono');
		
		$this->db->insert('usuario',$data);
		$red = "Location: " . site_url("/usuarios");
		header($red);
	}

	private function comprueba_sesion() {
		if ($this->session->userdata('id') === FALSE) {
			$red = "Location: " . site_url("/sesion");
			header($red);
			die();
		}
	}

}