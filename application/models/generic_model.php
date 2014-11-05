<?php

class Generic_model extends CI_Model {


	function crear($entity, $param)
	{
		return $this->db->insert($entity,$param);
	}

	function leer($entity, $param="")
	{
		if ($param !== "")
			$this->db->where($param);
		$query = $this->db->get($entity);
		return $this->query_to_array($query);
	}

	function listar($entity)
	{
		$query = $this->db->get($entity);
		return $this->query_to_array($query);
	}

	function borrar($entity,$param)
	{
		return $this->db->delete($entity,$param);
	}

	function actualizar($entity,$param,$new_data)
	{
		return $this->db->update($entity,$new_data,$param);
	}

	function repite($entity,$column,$element)
	{
		if ($entity == 'material')
			$this->db->where("idTipo = ".$element['idTipo']." AND idColor = ".$element['idColor']);
		else
			$this->db->where_in($column,$element);

		$this->db->from($entity);
		$rep = $this->db->count_all_results();

		if ($rep > 0)
			return TRUE;
	}

	function contar($entity, $param)
	{
		$this->db->from($entity);
		$this->db->where($param);
		return $this->db->count_all_results();
	}

	function query_to_array($query)
	{
		$result=array();
		foreach ($query->result_array() as $row)
		{
			$result[]=$row;
		}
		return $result;
	}
}
?>