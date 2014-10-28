<?php
class Gastos_model extends Generic_model
{
	public function get_gastos($param="")
	{
		$this->db->select("gastos.id, nombre, costo, fecha");
		$this->db->from("gastos");
		$this->db->join("tipogasto","gastos.idTipoGasto=tipogasto.id");
		if ($param != "")
			$this->db->where($param);
		$query=$this->db->get();
		return $this->query_to_array($query);
	}
}
?>