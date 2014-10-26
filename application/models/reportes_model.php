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
	function get_ventas($date1,$date2)
	{
		$this->db->select("fecha, cantidad * importe as total");
		$this->db->where("fecha BETWEEN '$date1' AND '$date2'");
		$query = $this->db->get("ventas");
		return $this->query_to_array($query);

	}
	function get_gastos($date1,$date2)
	{
		$this->db->select("fecha, cantidad * costo as total");
		$this->db->where("compras.fecha BETWEEN '$date1' AND '$date2'");
		$query1 = $this->query_to_array($this->db->get("compras"));

		$this->db->select("fecha, costo as total");
		$this->db->where("gastos.fecha BETWEEN '$date1' AND '$date2'");
		$query2 =$this->query_to_array($this->db->get("gastos"));

		return array_merge($query1,$query2);

	}
}
?>