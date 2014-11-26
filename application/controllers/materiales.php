<?php
class Materiales extends MY_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
	}

	public function index() 
	{
		$data['materiales']=$this->materiales_model->get_materiales(array('material.activo'=>1));
		$data['main_content']="materiales";
		$data['title']="Materiales";
		$this->load->view('templates/template',$data);
	}

	public function listar() 
	{
		$data['materiales']=$this->materiales_model->get_materiales(array('material.activo'=>1));
		$data['main_content']="materiales";
		$data['title']="Materiales";
		$this->load->view('templates/template',$data);
	}

	public function agregar() 
	{
		$colores = $this->materiales_model->leer("color",array('activo'=>1));
		$data['title'] = "Nuevo Material";
		$data['main_content'] = "forma_material";
		$data['colores'] = $colores;
		$data['materiales']=$this->materiales_model->leer("tipomaterial");
		$data['link'] = "guardar";
		$data['unidades']=$this->materiales_model->get_unidades();
		$this->load->view('templates/template',$data);
	}

	public function guardar() 
	{


		$nombre=$this->input->post('nombre');
		$color=$this->input->post('color-input');


		if ($nombre === "")
		{
			$data['idTipo'] = $this->input->post("idMaterial");

		}
		else
		{
			$data1['nombre'] = $nombre;
			
			$data1['unidad'] = $this->input->post('unidad');
			$rules=array(
				array('field' => 'nombre', 
					'rules' => 'unique',
					'label' =>'Nombre'
					),
				array('field' => 'nombre', 
					'rules' => 'required|min_length[2]|max_length[50]',
					'label' =>'Nombre'
					)
				);
			$valid = $this->validate_form($rules,$data1,'tipomaterial');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('materiales/agregar');
			}

			
			if ($this->materiales_model->crear('tipomaterial', $data1)) {
				$data['idTipo']=$this->materiales_model->leer("tipomaterial",array("nombre"=>$nombre))[0]['id'];
			}else{
				//inform error graciously
			}
			
		}

		if($color===""){
			$data['idColor'] =$this->input->post('color');
		}else{
			$data2['nombre']=$color;
			$data2['activo']=1;
			$rules=array(
				array('field' => 'nombre', 
					'rules' => 'unique',
					'label' =>'Nombre'
					),
				array('field' => 'color-input', 
					'rules' => 'required|min_length[2]|max_length[50]',
					'label' =>'Nombre'
					)
				);
			$valid = $this->validate_form($rules,$data2,'color');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('materiales/agregar');
			}

			if ($this->materiales_model->crear('color', $data2)) {
				$data['idColor']=$this->materiales_model->leer("color",array("nombre"=>$color))[0]['id'];
			}

		}

		$data['cantidadMaterial'] =$this->input->post('cantidad');

		$rules=array(
			array(
				'field'=>'idTipo',
				'rules'=>'unique',
				'label'=>'material'
				),
			array(
				'field'=>'cantidad',
				'rules'=>'numeric|required',
				'label'=>'Cantidad'
				)
			);
		$valid = $this->validate_form($rules,$data,'material');

		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('materiales/agregar');
		}
		
		if ($this->materiales_model->crear('material', $data)) 
		{
			$this->session->set_flashdata('mensaje','El material se agregó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("materiales");
		}
	}

	public function actualizar ($id = NULL) {
		if ($id != NULL) 
		{
			$colores = $this->materiales_model->listar("color");
			$data = $this->materiales_model->material($id);
			$data['colores'] = $colores;
			$data['title'] = "Actualiza Material";
			$data['main_content'] = "forma_material";
			$data['link'] = "guarda_actual/".$id;
			$data['materiales']=$this->materiales_model->leer("tipomaterial");
			$data['unidades']=$this->materiales_model->get_unidades();
			$this->load->view('templates/template',$data);
		} 
		else 
		{
			redirect("materiales");
		}
	}

	public function guarda_actual ($id = NULL) 
	{

		$nombre=$this->input->post('nombre');

		if ($nombre == "")
		{
			$data['idTipo'] = $this->input->post("idMaterial");

		}
		else
		{
			$data1['nombre'] = $nombre;
			
			$data1['unidad'] = $this->input->post('unidad');
			$rules=array(
				array(
					'field' => 'nombre', 
					'rules' => 'unique',
					'label' =>'Nombre'
					),
				array(
					'field' => 'nombre', 
					'rules' => 'min_length[2]|max_length[50]',
					'label' =>'Nombre'
					)
				);
			$valid = $this->validate_form($rules,$data1,'tipomaterial');

			if ($valid !== 1)
			{
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('materiales/agregar');
			}

			
			if ($this->materiales_model->crear('tipomaterial', $data1)) {
				$data['idTipo']=$this->materiales_model->leer("tipomaterial",array("nombre"=>$nombre))[0]['id'];
			}else{
				//inform error graciously
			}
			
		}
		$data['cantidadMaterial'] =$this->input->post('cantidad');
		$data['idColor'] =$this->input->post('color');

		$rules=array(
			array('field'=>'cantidad',
				'rules'=>'numeric|callback_greater_or_equal[0]|required',
				'label'=>'Cantidad'
				)
			);
		$valid = $this->validate_form($rules,$data,'material');
		$existe = $this->materiales_model->repite('material','idTipo',array('idTipo'=>$data['idTipo'],'idColor'=>$data['idColor']));
		if ($existe)
		{
			$original=$this->materiales_model->leer('material',array('id'=>$id));
			if ( $original[0]['idTipo'] !== $form_values['idTipo'] &&  $original[0]['idColor'] !== $form_values['idColor']){
				$error = "El material ya está registrado. Registre uno diferente o modifique el que ya existe\n";
				$valid=FALSE;
			}
		}
		if ($valid !== 1)
		{
			$valid.=$error;
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('materiales/actualizar/'.$id);
		}
		
		if ($this->materiales_model->actualizar('material', array("id"=>$id),$data)) 
		{
			$this->session->set_flashdata('mensaje','El material se actualizó exitosamente');
			$this->session->set_flashdata('class','alert alert-success');
			redirect("materiales");
		}
	}

	public function borrar($id = NULL) {
		if ($id != NULL) 
		{
			if ($this->materiales_model->actualizar('material',array('id'=>$id),array('activo'=>0))) 
			{
				$this->session->set_flashdata('mensaje','El material se eliminó exitosamente');
				$this->session->set_flashdata('class', 'alert alert-success');
			} 
			else 
			{
				$this->session->set_flashdata('mensaje','El material no se pudo eliminar');
				$this->session->set_flashdata('class', 'alert alert-danger');
			}
			redirect("materiales");
		} 
		else 
		{
			redirect("materiales");
		}
	}

	public function get_unidad(){
		$idMaterial=$this->input->post("selMat");

		echo $this->materiales_model->leer("tipomaterial",array("id"=>$idMaterial)) [0]["unidad"];

	}

	public function insertar_tipo(){
		$form_values=$this->input->post();
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre'
				),
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre'
				),
			array('field' => 'unidad', 
				'rules' => 'required|min_length[1]|max_length[10]',
				'label' =>'Nombre'
				)
			);
		$valid=$this->validate_form($rules, $form_values, 'tipomaterial');
		
		if($valid!==1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('inicio/subcatalogos');
		}

		if($this->materiales_model->crear('tipomaterial', $form_values)){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El tipo de material se agregó exitosamente');
			redirect('inicio/subcatalogos');
		}
	}

	public function actualizar_tipo(){
		$tipo_id=$this->input->post('tipo_id');

		$tipo=$this->materiales_model->leer('tipomaterial',array('id'=>$tipo_id))[0];

		echo json_encode($tipo);
	}

	public function actualizar_tipo2($tipo_id){
		$form_values=$this->input->post();
		$nombre1=$this->materiales_model->leer('tipomaterial', array('id'=>$tipo_id))[0]['nombre'];
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre'
				),
			array('field' => 'unidad', 
				'rules' => 'required|min_length[1]|max_length[10]',
				'label' =>'Nombre'
				)
			);
		if($form_values['nombre']!=$nombre1)
			array_push($rules,array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre'
				));

		$valid=$this->validate_form($rules, $form_values, 'tipomaterial');

		if($valid!==1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('inicio/subcatalogos');
		}

		if($this->materiales_model->actualizar('tipomaterial',array('id'=>$tipo_id),$form_values)){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El tipo de gasto se actualizó exitosamente');
			redirect("inicio/subcatalogos");
		}

	}

	public function borrar_tipo($tipo_id){
		if($this->materiales_model->actualizar('tipomaterial', array('id'=>$tipo_id), array('activo'=>0))){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El tipo de material se eliminó exitosamente');
			redirect("inicio/subcatalogos");
		}
	}

	public function insertar_color(){
		$form_values=$this->input->post();
		unset($form_values['unidad']);
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre'
				),
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre'
				)
			);
		$valid=$this->validate_form($rules, $form_values, 'color');
		//var_dump($valid);
		if ($valid === "0")
		{
			$this->session->set_flashdata('mensaje',"El color se agregó exitosamente");
			$this->session->set_flashdata('class','alert alert-success');
			redirect('inicio/subcatalogos');
		}
		if($valid!=="1" && $valid!=="0"){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('inicio/subcatalogos');
		}
		else if($this->materiales_model->crear('color', $form_values)){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El color se agregó exitosamente');
			redirect('inicio/subcatalogos');
		}
	}

	public function actualizar_color(){
		$color_id=$this->input->post('color_id');

		$nombre=$this->materiales_model->leer('color',array('id'=>$color_id))[0]['nombre'];
		echo $nombre;
	}

	public function actualizar_color2($color_id){
		$form_values=$this->input->post();
		unset($form_values['unidad']);
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre'
				),
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre'
				)
			);
		$valid=$this->validate_form($rules, $form_values, 'color');
		if($valid!==1){
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('inicio/subcatalogos');
		}

		if($this->materiales_model->actualizar('color',array('id'=>$color_id),$form_values)){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El color se actualizó exitosamente');
			redirect("inicio/subcatalogos");
		}

	}

	public function borrar_color($color_id){
		if($this->materiales_model->actualizar('color', array('id'=>$color_id), array('activo'=>0))){
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El color se eliminó exitosamente');
			redirect("inicio/subcatalogos");
		}
	}

}
/* End of file materiales.php */
/* Location: controllers/materiales.php */
