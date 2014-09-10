<?php
class Usuarios extends MY_Controller {
	public function index()
	{
		$this->db->select('usuario.nombre as nom, rol.nombre as tipo, email, genero, telefono');
		$this->db->from('usuario');
		$this->db->join('rol', 'usuario.idRol = rol.id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$res[] = $row;
			}
		} else {
			$res = false;
		}
		$data['title'] = "Usuarios";
		$data['main_content'] = "usuarios";
		$data['usuarios'] = $res;
		$this->load->view('templates/template',$data);
	}

	function agregar ($error = null) 
	{
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
		if (strcmp($_POST['clave'], $this->input->post('clave2')) != 0) {
			$red = "Location: " . site_url("/usuarios/agregar/1");
			header($red);
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
			redirect("/usuarios");
		}

	}

}