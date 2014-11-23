<?php
class Ventas_model extends Generic_model{
	function get_ventas($filter="")
	{
		$this->db->select('ventas.id,productos.nombre as producto,tipoproducto.nombre as tipo,usuario.nombre as usuario ,lugar.nombre as lugar, importe as precio,fecha, cantidad, cantidad * importe as total');
		$this->db->from('ventas');
		$this->db->join('productos','productos.id = ventas.idProducto');
		$this->db->join('lugar','lugar.id = ventas.idLugar');
		$this->db->join('usuario','usuario.id = ventas.idVendedor');
		$this->db->join('tipoproducto','tipoproducto.id = productos.idTipo');
		if ($filter !="")
			$this->db->where($filter);

		$query = $this->db->get();
		
		return $this->query_to_array($query);
	}	

	function actualizar_venta($filter="")
	{
		$this->db->select('idProducto,cantidad,idVendedor,idLugar,fecha');
		$this->db->from('ventas');
		if($filter != ""){
			$this->db->where($filter);
		}

		$query=$this->db->get();

		return $this->query_to_array($query);
	}
}
?>