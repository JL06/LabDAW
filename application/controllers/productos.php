<?php
class Productos extends MY_Controller
{		

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('productos_model');
		$this->load->model('materiales_model');
		$this->load->library('form_validation');
		$this->load->model('usuario_model');
	}
	public function index()
	{
		$this->listar();
	}

	public function listar() 
	{
		$data['productos']=$this->productos_model->get_productos(array('productos.activo'=>1));
		$data['main_content']="productos";
		$data['title']="Productos";
		$this->load->view('templates/template',$data);
	}

	public function registrar() 
	{
		$data['tipo']=$this->productos_model->leer('tipoproducto');
		$data['main_content']="producto_form";
		$data['title']="Registrar Producto";
		$data['materiales']=$this->materiales_model->get_materiales();
		$this->load->view('templates/template',$data);
	}


	public function insertar_producto() 
	{
		$form_values=$this->input->post();

		//separo los materiales del resto de los valores de la forma
		$mat=$form_values['materiales'];
		unset($form_values['materiales']);

		$nombre_tipo=$form_values['nombre-tipo'];
		unset($form_values['nombre-tipo']);

		if($nombre_tipo!==""){
			$data['nombre']=$nombre_tipo;
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
			$valid=$this->validate_form($rules, $data, 'tipoproducto');
			if ($valid !== 1){
				$this->session->set_flashdata('mensaje',$valid);
				$this->session->set_flashdata('class','alert alert-danger');
				redirect('productos/registrar');
			}

			if($this->productos_model->crear('tipoproducto', $data)){
				$form_values['idTipo']=$this->productos_model->leer('tipoproducto', array("nombre"=>$nombre_tipo))[0]['id'];
			}
			else{
				//inform error graciously
			}

		}
		
		//reglas de validación
		$rules=array(
			array('field' => 'nombre', 
				'rules' => 'unique',
				'label' =>'Nombre de producto'
				),
			array('field' => 'nombre', 
				'rules' => 'required|min_length[2]|max_length[50]',
				'label' =>'Nombre de producto'
				),
			array(
				'field' => 'tiempo',
				'rules' => 'required|greater_than[0]|numeric',
				'label' => 'Tiempo de elaboración'

				),
			array(
				'field' => 'cantidad',
				'rules'=>'numeric|is_natural',
				'label' => 'Cantidad'
				),
			array(
				'field' => 'precio',
				'rules'=>'numeric|greater_than[0]',
				'label' =>'Precio'
				)
			);

		//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
		$valid = $this->validate_form($rules,$form_values,'productos');

		if ($valid !== 1)
		{
			$this->session->set_flashdata('mensaje',$valid);
			$this->session->set_flashdata('class','alert alert-danger');
			redirect('productos/registrar');
		}

		if($this->productos_model->crear('productos',$form_values)) 
		{

			//obtener el producto recién insertado
			$prod=$this->productos_model->leer('productos',array('nombre'=>$form_values['nombre']));
			
			//si el usuario seleccionó al menos un material y el producto está en la base de datos
			if ( $mat != "" && isset($prod) ) 
			{
				//separar string con materiales a insertar
				$mat=explode(',',$mat);

				//si no pasa validación, mostrar error
				//PENDIENTE: regresar forma pre-llenada en caso de error
				if ( ! $this->validate_materials($mat) )
				{
					$this->session->set_flashdata('mensaje','La cantidad de material debe ser mayor a 0');
					$this->session->set_flashdata('class','alert alert-danger');
					redirect("productos/registrar");
				}

				$this->productos_model->asignar_material($prod[0]['id'],$mat);
			}
			$this->session->set_flashdata('class','alert alert-success');
			$this->session->set_flashdata('mensaje','El producto se agregó exitosamente');
			redirect('productos/listar');
		}
	}

	public function validate_materials($materials)
	{
		foreach ($materials as $m)
		{
			$m=explode(":", $m);
			if( !isset($m[1]) || !is_numeric($m[1]) || $m[1] <= 0 )
				return false;
		}
		return true;	
	}

	public function agendar()
	{
		$productos=$this->productos_model->leer('productos');
		$data = array(
			'main_content' => 'schedule' ,
			'title'=>'Agendar producción', 
			'productos' => $productos);
		$this->load->view('templates/template',$data);
	}

	public function calcular_agenda(){
		$prod_id=$this->input->post('idProducto');
		$cantidad=$this->input->post('cantidad');

		$producto=$this->productos_model->leer('productos',array('id'=>$prod_id));
		$tiempo=$producto[0]['tiempo']*$cantidad;
		$prod_nombre=$producto[0]['nombre'];

		$materiales=$this->materiales_model->get_materiales_producto($prod_id);

		$compra="Necesitas comprar: <br>
		<ul>";
			$flag_compra=0;

			$msg="Para crear ".$cantidad." ".$prod_nombre." necesitas: <br>
			<ul>
				<li>".$tiempo." horas</li>";
				foreach($materiales as $m){
					$c=$m['cantidad']*$cantidad;
					$msg.="<li>".$c." ".$m['unidad']." de ".$m['nombre']." ".$m['color']."</li>";
					if($c>$m['cantidadMaterial']){
						$c_c=$c-$m['cantidadMaterial'];
						$compra.="<li>".$c_c." ".$m['unidad']." de ".$m['nombre']." ".$m['color']."</li>";
						$flag_compra=1;
					}
				}
				$compra.="</ul>";
				$msg.="</ul><br>";
				if($flag_compra===1)
					$msg.=$compra;
				echo $msg;
			}

			public function actualizar_producto($prod_id)
			{
				$data['tipo']=$this->productos_model->leer('tipoproducto');
				$data['main_content']="producto_form";
				$data['title']="Actualizar Producto";
				$data['materiales']=$this->materiales_model->get_materiales();
				$data['producto']=json_encode($this->productos_model->get_productos(array('productos.id' => $prod_id))[0]);
				$data['prod_id']=$prod_id;
				$data['mat_actuales']=json_encode($this->materiales_model->get_materiales_producto($prod_id));
				$this->load->view('templates/template',$data);
			}

			public function actualizar($id)
			{
				$error="";
				$form_values=$this->input->post();
				$mat=$form_values['materiales'];
				unset($form_values['materiales']);

				$nombre_tipo=$form_values['nombre-tipo'];
				unset($form_values['nombre-tipo']);

				if($nombre_tipo!==""){
					$data['nombre']=$nombre_tipo;
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
					$valid=$this->validate_form($rules, $data, 'tipoproducto');
					if ($valid !== 1){
						$this->session->set_flashdata('mensaje',$valid);
						$this->session->set_flashdata('class','alert alert-danger');
						redirect('productos/registrar');
					}

					if($this->productos_model->crear('tipoproducto', $data)){
						$form_values['idTipo']=$this->productos_model->leer('tipoproducto', array("nombre"=>$nombre_tipo))[0]['id'];
					}
					else{
		//inform error graciously
					}

				}

//reglas de validación
				$rules=array(

					array('field' => 'nombre', 
						'rules' => 'required|min_length[2]|max_length[50]',
						'label' =>'Nombre de producto'
						),
					array(
						'field' => 'tiempo',
						'rules' => 'required|greater_than[0]|numeric',
						'label' => 'Tiempo de elaboración'

						),
					array(
						'field' => 'cantidad',
						'rules'=>'numeric|is_natural',
						'label' => 'Cantidad'
						),
					array(
						'field' => 'precio',
						'rules'=>'numeric|greater_than[0]',
						'label' =>'Precio'
						)
					);
//valid es true si la forma pasó la validación y un arreglo de mensajes de error si no pasó
				$valid=$this->validate_form($rules,$form_values,'productos');
				$existe = $this->productos_model->repite('productos','nombre',$form_values['nombre']);
				if ($existe)
				{
					$original=$this->productos_model->leer('productos',array('id'=>$id));
					if ( $original[0]['nombre'] !== $form_values['nombre']){
						$error = "El nombre de producto no está disponible\n";
					}
				}

				if ( $valid !== 1 OR $error !== "")
				{
					$this->session->set_flashdata('mensaje',$error.$valid);
					$this->session->set_flashdata('class','alert alert-danger');
					redirect('productos/actualizar_producto/'.$id);
				}

				if($this->productos_model->actualizar('productos',array('id' => $id),$form_values))
				{			
					if ($mat != "")
					{
						$mat=explode(',',$mat);

						if (!$this->validate_materials($mat))
						{
							$this->session->set_flashdata('mensaje','La cantidad de material debe ser mayor a 0');
							$this->session->set_flashdata('class','alert alert-danger');
							redirect("productos/actualizar_producto/".$id);
						}

						$this->productos_model->borrar('productomaterial',array('idProducto'=>$id));
						$this->productos_model->asignar_material($id,$mat);	

					}
					else
					{
						$this->productos_model->borrar('productomaterial',array('idProducto'=>$id));
					}

					$this->session->set_flashdata('class','alert alert-success');
					$this->session->set_flashdata('mensaje','El producto se actualizó exitosamente');

					redirect('productos/listar');
				}


			}

			public function borrar($prod_id)
			{

				if ($this->productos_model->actualizar('productos',array('id'=>$prod_id),array('activo'=>0))) {
					$this->session->set_flashdata('class','alert alert-success');
					$this->session->set_flashdata('mensaje','El producto se eliminó exitosamente');
					redirect("productos/listar");
				}
			}

			public function detalle($id)
			{
				$prod=$this->productos_model->get_productos(array("productos.id"=>$id));
				$data=array(
					"producto"=>$prod[0],
					"materiales"=>$this->materiales_model->get_materiales_producto($id),
					"main_content"=>"detalle_material",
					"title"=>$prod[0]['nombre']
					);
				$this->load->view("templates/template",$data);		

			}

			public function costo()
			{
				$materiales = $this->input->post("materiales");
				if ($materiales == NULL) 
				{
					echo 0;
					return;
				}
				$mats = explode(",", $materiales);
				$costo_total = 0;
				foreach ($mats as $mat) 
				{
					list($idmat, $cantidad) = explode(":", $mat);
					$ultimo = $this->materiales_model->ultimo_comprado($idmat);
					$costo = $ultimo["costo"]/$ultimo["cantidad"];
					$costo_producto = $costo * floatval($cantidad);
					$costo_total += $costo_producto;
				}
				echo round($costo_total, 2);
			}


			public function asignaciones()
			{
				$data['asignaciones'] = $this->productos_model->asignaciones();
				$data['main_content']="asignaciones";
				$data['title']="Asignaciones de productos a vendedores";
				$this->load->view('templates/template',$data);
			}

			public function asignar()
			{
				$data['productos']=$this->productos_model->get_productos(array('activo'=>1));
				$data['usuarios']=$this->usuario_model->listar(array("activo"=>1));
				$data['main_content']="asignar_producto";
				$data['title']="Asignar productos a vendedor";
				$data['link'] = "guardar_asignacion";
				$this->load->view('templates/template',$data);
			}

			public function guardar_asignacion()
			{
				$cantidad = $this->input->post("cantidad");
				if ($cantidad < 1) 
				{
					$this->session->set_flashdata('mensaje', 'Error: La cantidad debe ser mayor a 0');
					redirect("productos/asignar");
					return;
				}
				$data["idVendedor"] = $this->input->post("vendedor");
				$data["idProducto"] = $this->input->post("producto");
				$data["idAdmin"] = $this->session->userdata('id');
				$data['cantidad'] = $cantidad;

//Verifica si existe una asignacion previa, si es asi manda a modificarla
				$asignacion = $this->productos_model->asignacion($data["idProducto"], $data["idVendedor"]);
				if ($asignacion != NULL)
				{
					$this->session->set_flashdata('mensaje', 'La asignacion ya existe, puede modificarla');
					$this->session->set_flashdata('class', 'alert alert-warning');
					redirect("productos/asignaciones");
					return;
				}

//Verifica que exista la cantidad a asignar
				$producto_actual = $this->productos_model->producto($data['idProducto']);
				if ($producto_actual == NULL)
				{
					echo "error";
					die();
				}
				$cantidad_producto = $producto_actual['cantidadProducto'];

				if ($cantidad > $cantidad_producto)
				{
					$this->session->set_flashdata('mensaje', 'Error: La cantidad asignada es mayor a la existente');
					redirect("productos/asignar");
					return;
				}

				if($this->productos_model->crea_asignacion($data, $cantidad, $cantidad_producto))
				{
					$this->session->set_flashdata('mensaje', 'La asignacion fue realizada exitosamente');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect("productos/asignaciones");
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Error: No se pudo realizar operacion');
					redirect("productos/asignar");
				}
			}

			public function agrega_asignacion($idprod = NULL, $idv = NULL) 
			{
				if ($idprod == NULL || $idv == NULL)
				{
					redirect("productos/asignaciones");
				}
				$asignacion = $this->productos_model->asignacion($idprod, $idv);
				if ($asignacion == NULL)
				{
					echo "Error";
					die();
				}
				else
				{
					$data['asignacion'] = $asignacion;
					$data['cantidad'] = $asignacion['cantidad'];
					$data['main_content']="agrega_asignacion";
					$data['title']="Agrega asignacion";
					$this->load->view('templates/template',$data);
				}
			}

			public function suma_asignacion()
			{
				$idproducto = $this->input->post("producto");
				$idvendedor = $this->input->post("vendedor");
				$cantidad = $this->input->post("cantidad");

//Verifica que exista la cantidad a asignar
				$producto_actual = $this->productos_model->producto($idproducto);
				if ($producto_actual == NULL)
				{
					echo "error";
					die();
				}
				$cantidad_producto = $producto_actual['cantidadProducto'];

				if ($cantidad > $cantidad_producto)
				{
					$this->session->set_flashdata('mensaje', 'Error: La cantidad asignada es mayor a la existente');
					redirect("productos/agrega_asignacion/".$idproducto."/".$idvendedor);
				}

				if ($this->productos_model->suma_asignacion($idproducto, $idvendedor, $cantidad, $cantidad_producto)) {
					$this->session->set_flashdata('mensaje', 'Actualizacion exitosa');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect("productos/asignaciones");
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Error al actualizar');
					$this->session->set_flashdata('class', 'alert alert-danger');
					redirect("productos/agrega_asignacion/".$idproducto."/".$idvendedor);
				}
			}

			public function quita_asignacion($idprod = NULL, $idv = NULL)
			{
				if ($idprod == NULL || $idv == NULL)
				{
					redirect("productos/asignaciones");
				}
				$asignacion = $this->productos_model->asignacion($idprod, $idv);
				if ($asignacion == NULL)
				{
					echo "Error";
					die();
				}
				else
				{
					$data['asignacion'] = $asignacion;
					$data['cantidad'] = $asignacion['cantidad'];
					$data['main_content']="quita_asignacion";
					$data['title']="Agrega asignacion";
					$this->load->view('templates/template',$data);
				}
			}

			public function resta_asignacion()
			{
				$idproducto = $this->input->post("producto");
				$idvendedor = $this->input->post("vendedor");
				$cantidad = $this->input->post("cantidad");

//verifica que se le pueda restar la cantidad
				$asignacion = $this->productos_model->asignacion($idproducto, $idvendedor);
				if ($asignacion == NULL)
				{
					echo "error";
					die();
				}

				$cantidad_asignada = $asignacion['cantidad'];
				if ($cantidad > $cantidad_asignada)
				{
					$this->session->set_flashdata('mensaje', 'Error: No se le puede quitar mas de lo asignado');
					redirect("productos/quita_asignacion/".$idproducto."/".$idvendedor);
				}

				if($this->productos_model->resta_asignacion($idproducto, $idvendedor, $cantidad, $cantidad_asignada))
				{
					$this->session->set_flashdata('mensaje', 'Actualizacion exitosa');
					$this->session->set_flashdata('class', 'alert alert-success');
					redirect("productos/asignaciones");
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Error al actualizar');
					$this->session->set_flashdata('class', 'alert alert-danger');
					redirect("productos/quita_asignacion/".$idproducto."/".$idvendedor);
				}
			}

			public function borrar_asignacion($idprod = NULL, $idv = NULL)
			{
				if ($idprod == NULL || $idv == NULL)
				{
					redirect("productos/asignaciones");
				}
				$data = array('idProducto' => $idprod, 'idVendedor' => $idv);
				if ($this->db->delete('asignacion', $data))
				{
					$this->session->set_flashdata('mensaje', 'Asignacion borrada');
					redirect("productos/asignaciones");
				}
				else
				{
					$this->session->set_flashdata('mensaje', 'Error al borrar');
					redirect("productos/asignaciones");
				}
			}

			public function insertar_tipo(){
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
				$valid=$this->validate_form($rules, $form_values, 'tipoproducto');
				if($valid!==1 OR $valid !== 0)
				{
					$this->session->set_flashdata('mensaje',$valid);
					$this->session->set_flashdata('class','alert alert-danger');
					redirect('inicio/subcatalogos');
				}
				if ($valid == 0)
				{
					$this->session->set_flashdata('mensaje','El tipo de producto se agregó exitosamente');
					$this->session->set_flashdata('class','alert alert-danger');
					redirect('inicio/subcatalogos');	
				}
				if($this->productos_model->crear('tipoproducto', $form_values)){
					$this->session->set_flashdata('class','alert alert-success');
					$this->session->set_flashdata('mensaje','El tipo de producto se agregó exitosamente');
					redirect('inicio/subcatalogos');
				}
			}

			public  function actualizar_tipo(){
				$tipo_id=$this->input->post('tipo_id');

				$nombre=$this->productos_model->leer('tipoproducto',array('id'=>$tipo_id))[0]['nombre'];
				echo $nombre;
			}

			public  function actualizar_tipo2($tipo_id){
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
				$valid=$this->validate_form($rules, $form_values, 'tipoproducto');

				if($valid!==1){
					$this->session->set_flashdata('mensaje',$valid);
					$this->session->set_flashdata('class','alert alert-danger');
					redirect('inicio/subcatalogos');
				}

				if($this->productos_model->actualizar('tipoproducto',array('id'=>$tipo_id),$form_values)){
					$this->session->set_flashdata('class','alert alert-success');
					$this->session->set_flashdata('mensaje','El tipo de producto se actualizó exitosamente');
					redirect("inicio/subcatalogos");
				}
			}

			public function borrar_tipo($tipo_id){
				if($this->productos_model->actualizar('tipoproducto', array('id'=>$tipo_id), array('activo'=>0))){
					$this->session->set_flashdata('class','alert alert-success');
					$this->session->set_flashdata('mensaje','El tipo de producto se eliminó exitosamente');
					redirect("inicio/subcatalogos");
				}
			}

		}
		/* End of file productos.php */
/* Location: controllers/productos.php */