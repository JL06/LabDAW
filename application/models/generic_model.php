<?php

class Generic_model extends CI_Model {
	function crear($entity, $param){
		return $this->db->insert($entity,$param);
	}

	function leer($entity, $param){
		$query = $this->db->get_where($entity,$param);
		return $this->query_to_array($query);
	}

	function listar($entity){
		$query = $this->db->get($entity);
		return $this->query_to_array($query);
	}

	function borrar($entity,$param){
		return $this->db->delete($entity,$param);
	}

	function actualizar($entity,$param,$new_data){
		return $this->db->update($entity,$new_data,$param);
	}
	function query_to_array($query){
		$result=array();
		foreach ($query->result_array() as $row)
		{
		   $result[]=$row;
		}
		return $result;
	}
}
?>