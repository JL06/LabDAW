<?php
class Sesion extends CI_Controller {
	public function index()
	{
		if ($this->session->userdata('id') === FALSE) 
			$this->load->view('inicio_sesion');
		else
			redirect('inicio');
	}

	function iniciar () {
		$mail = $this->input->post('correo');
		$clave = $this->input->post('clave');
		if ($mail != false && $clave != false) {
			$correo['email'] = $mail;
			$this->db->where("activo",1);
			$res = $this->db->get_where("usuario", $correo);
			if ($res->num_rows() == 0) {
				$red = "Location: " . site_url("/sesion/error");
				header($red);
			}
			foreach ($res->result_array() as $row) {
				$usuario = $row;
			}

			if (password_verify($clave, $usuario['password'])) {

				$info['nombre'] = $usuario['nombre'];
				$info['id'] = $usuario['id'];
				$info['correo'] = $usuario['email'];
				$info['genero'] = $usuario['genero'];
				$info['rol'] = $usuario['idRol'];
				$this->session->set_userdata($info);

				redirect("inicio");
				header($red);
			} else {
				$red = "Location: " . site_url("/sesion/error");
				header($red);
			}
		} else {
			$red = "Location: " . site_url("/sesion");
			header($red);
		}
	}

	function error() {
		$datos['error'] = true;
		$this->load->view('inicio_sesion', $datos);
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
}
/* End of file sesion.php */
/* Location: controllers/sesion.php */
