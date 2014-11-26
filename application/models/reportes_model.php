<?php
class Reportes_model extends Generic_model
{
	function get_sum($entity,$field,$date1, $date2)
	{
		$this->db->select("SUM( ".$field.") as total");
		$this->db->where("fecha BETWEEN '$date1' AND '$date2'");
		$query = $this->db->get($entity);
		return $this->query_to_array($query)[0]['total'];

	}
	function get_ventas($date1,$date2,$param="")
	{
		$this->db->select("fecha, cantidad * importe as total");
		if ($param ==="")
			$this->db->where("fecha BETWEEN '$date1' AND '$date2'");
		else
			$this->db->where("fecha BETWEEN '$date1' AND '$date2' AND ".$param);
		
		$query = $this->db->get("ventas");
		return $this->query_to_array($query);

	}
	function get_gastos($date1,$date2)
	{
		$this->db->select("fecha, cantidad * costo as total");
		$this->db->where("fecha BETWEEN  ".$this->db->escape($date1)." AND ".$this->db->escape($date2));
		$query1 = $this->query_to_array($this->db->get("compras"));

		$this->db->select("fecha, costo as total");
		$this->db->where("fecha BETWEEN  ".$this->db->escape($date1)." AND ".$this->db->escape($date2));
		$query2 =$this->query_to_array($this->db->get("gastos"));

		return array_merge($query1,$query2);

	}
	function get($element,$date1,$date2)
	{
		if($element == "compras")
		{
			$this->db->select("fecha, cantidad * costo as total");

		}
		else
		{
			$this->db->select("fecha, costo as total");	
		}
		$this->db->from($element);
		$this->db->where("fecha BETWEEN  ".$this->db->escape($date1)." AND ".$this->db->escape($date2));
		$query = $this->query_to_array($this->db->get());
		return $query;	
	}

	function get_ventas_vendedor($id,$from,$to)
	{
		if ($id == "todos")
		{
			$sql = "SELECT SUM(cantidad) as cantidadVentas, SUM(importe) as importe, usuario.nombre as vendedor
			FROM Ventas, Usuario
			WHERE idVendedor IN(SELECT id FROM usuario WHERE activo = 1) 
			AND usuario.id= ventas.idVendedor
			AND fecha BETWEEN ".$this->db->escape($from)." 
			AND ".$this->db->escape($to)." GROUP BY idVendedor";

		}
		else
		{

			$sql = "SELECT SUM(cantidad) as cantidadVentas, SUM(importe) as importe, usuario.nombre as vendedor,fecha 
			FROM Ventas, Usuario
			WHERE idVendedor IN(".$this->db->escape_str($id).")
			AND usuario.id= ventas.idVendedor
			AND fecha BETWEEN ".$this->db->escape($from)." AND ".$this->db->escape($to)." GROUP BY idVendedor";
		}

		$query = $this->db->query($sql); 
		return $this->query_to_array($query);
	}
	function get_ventas_producto($id,$from, $to)
	{
		if ($id == "todos" OR strpos($id,"todos")!== FALSE)
		{
			$sql = "SELECT SUM(cantidad) as cantidadVentas, SUM(importe) as importe,productos.nombre as producto 
			FROM Ventas,productos
			WHERE idProducto IN(SELECT id FROM productos WHERE activo = 1)
			AND productos.id = ventas.idProducto
			AND fecha BETWEEN ".$this->db->escape($from)." AND ".$this->db->escape($to)." GROUP BY idProducto ";
		}
		else
		{
			$sql = "SELECT SUM(cantidad) as cantidadVentas, SUM(importe) as importe,productos.nombre as producto  
			FROM Ventas,productos
			WHERE idProducto IN(".$this->db->escape_str($id).")
			AND productos.id = ventas.idProducto
			AND fecha BETWEEN ".$this->db->escape($from)." AND ".$this->db->escape($to)." GROUP BY idProducto";

		}

		$query = $this->db->query($sql); 
		return $this->query_to_array($query);
	}

}
?>