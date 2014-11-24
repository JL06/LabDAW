<?php
class Productos_model extends Generic_model 
{
	function get_productos($filter="")
	{
		$this->db->select('productos.id, productos.nombre, productos.precio, productos.descripcion, tipoproducto.nombre as tipo,tiempo,cantidadProducto,productos.idTipo');
		$this->db->from('productos');
		$this->db->join('tipoproducto','tipoproducto.id=productos.idTipo');
		if($filter!="")
			$this->db->where($filter);

		$query=$this->db->get();

		return $this->query_to_array($query);
	}

	public function asignar_material($prod_id,$mat) 
	{
		$insertData=array();
		
		foreach ($mat as $m) 
		{
			$m=explode(":", $m);
			$insertData[]=array('idProducto'=>$prod_id,'idMaterial'=>$m[0],'cantidad'=>$m[1]);	
		}
		if($this->db->insert_batch('productomaterial',$insertData))
			return true;

	}
	public function update_materiales($prod_id,$mat)
	{

		$updateData=array();
		
		foreach ($mat as $m) 
		{
			$m=explode(":", $m);
			$updateData[]=array('idProducto'=>$prod_id,'idMaterial'=>$m[0],'cantidad'=>$m[1]);	
		}
		if($this->db->update_batch('productomaterial',$updateData,'idProducto'))
		{
			return true;					
		}
	}

	public function contiene_materiales ($producto) {
		$materiales = $this->db->get_where('productomaterial', array('idProducto' => $producto));
		return $this->query_to_array($materiales);
	}
/*
	public function asignaciones()
	{
		$this->db->select("productos.nombre as producto, vendedor.nombre as vendedor,administrador.nombre as admin, fecha,cantidad, administrador.id as idad, vendedor.id as idv, productos.id as id");
		$this->db->from("asignacion");
		$this->db->join("productos","asignacion.idProducto = productos.id");
		$this->db->join("usuario as vendedor","vendedor.id = asignacion.idVendedor");
		$this->db->join("usuario as administrador","administrador.id = asignacion.idAdmin");
		$query=$this->db->get();
		return $this->query_to_array($query);
	}

	public function asignacion($idprod, $idv)
	{
		$this->db->select("productos.nombre as producto, vendedor.nombre as vendedor,administrador.nombre as admin, fecha,cantidad, administrador.id as idv, vendedor.id as idv, productos.id as id");
		$this->db->from("asignacion");
		$this->db->join("productos","asignacion.idProducto = productos.id");
		$this->db->join("usuario as vendedor","vendedor.id = asignacion.idVendedor");
		$this->db->join("usuario as administrador","administrador.id = asignacion.idAdmin");

		$this->db->where('vendedor.id', $idv);
		$this->db->where('productos.id', $idprod);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$asig = $query->row_array();
		} else {
			$asig = NULL;
		}
		return $asig;
	}
*/

	public function asignaciones()
	{
		$this->db->distinct();
		$this->db->select("admin, producto, cantidad, vendedor, uno.id, uno.idv");
		$this->db->from("(SELECT usuario.nombre as admin, productos.nombre as producto, cantidad, productos.id as id, asignacion.idvendedor as idv from asignacion, productos, usuario where asignacion.idProducto = productos.id and usuario.id = asignacion.idAdmin) uno");
		$this->db->join("(SELECT usuario.nombre as vendedor, productos.id as id, asignacion.idvendedor as idv from asignacion, usuario, productos where  usuario.id = asignacion.idVendedor order by cantidad) dos", "uno.id = dos.id and uno.idv = dos.idv");
		$query=$this->db->get();
		return $this->query_to_array($query);
	}

	public function asignacion($idprod, $idv)
	{
		$this->db->distinct();
		$this->db->select("producto, cantidad, vendedor, uno.id, uno.idv");
		$this->db->from("(SELECT usuario.nombre as admin, productos.nombre as producto, cantidad, productos.id as id, asignacion.idvendedor as idv from asignacion, productos, usuario where asignacion.idProducto = productos.id and usuario.id = asignacion.idAdmin) uno");
		$this->db->join("(SELECT usuario.nombre as vendedor, productos.id as id, asignacion.idvendedor as idv from asignacion, usuario, productos where  usuario.id = asignacion.idVendedor order by cantidad) dos", "uno.id = dos.id and uno.idv = dos.idv");
		$this->db->where('uno.idv', $idv);
		$this->db->where('uno.id', $idprod);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			$asig = $query->row_array();
		} else {
			$asig = NULL;
		}
		return $asig;
	}
	*/
	public function producto($id)
	{
		$query = $this->db->get_where("productos", array('id' => $id));
		if ($query->num_rows() > 0) {
			$res = $query->row_array();
		} else {
			$res = NULL;
		}
		return $res;
	}

	public function crea_asignacion($data, $cantidad, $cantidad_producto)
	{
		if ($this->db->insert("asignacion", $data)) 
		{
			$this->db->where('id', $data['idProducto']);
			$this->db->update('productos', array('cantidadProducto' => $cantidad_producto - $cantidad));
			return true;
		}
		else
		{
			return false;
		}
	}

	public function suma_asignacion($idproducto, $idvendedor, $cantidad, $cantidad_producto)
	{
		//obtener cantidad actual de la asignacion
		$asignacion = $this->asignacion($idproducto, $idvendedor);
		$cantidad_actual = $asignacion['cantidad'];

		$this->db->where(array('idProducto' => $idproducto, 'idVendedor' => $idvendedor));
		if ($this->db->update('asignacion', array('cantidad' => $cantidad + $cantidad_actual)))
		{
			$this->db->where('id', $idproducto);
			$this->db->update('productos', array('cantidadProducto' => $cantidad_producto - $cantidad));
			return true;
		}
		else
		{
			return false;
		}
	}

	public function resta_asignacion($idproducto, $idvendedor, $cantidad, $cantidad_asignada)
	{
		//
		$producto = $this->producto($idproducto);
		$cantidad_producto = $producto['cantidadProducto'];

		$this->db->where('id', $idproducto);
		if ($this->db->update('productos', array('cantidadProducto' => $cantidad_producto + $cantidad))) 
		{
			$this->db->where('idProducto', $idproducto);
			$this->db->where('idVendedor', $idvendedor);
			$this->db->update('asignacion', array('cantidad' => $cantidad_asignada - $cantidad));
			return true;
		}
		else
		{
			return false;
		}
	}
}	
//EOF
//models/prdductos_model.php