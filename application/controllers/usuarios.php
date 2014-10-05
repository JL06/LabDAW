<?php
class Usuarios extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('usuario_model');
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

	function editar_usuario(){
		$data=array(
			'main_content'=>'edit_user',
			'title'=>'Editar usuario'
			);
		$this->load->view('templates/template',$data);
	}

	public function borrar($userId){
		
		if ($this->usuario_model->actualizar('usuario',array('id'=>$userId),array('activo'=>0))) {
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El usuario se eliminó exitosamente');
			redirect("usuarios");


		}
	}
}