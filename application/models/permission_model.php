<?php
class Permission_model extends Generic_model
{

	function has_permission($id_role, $permission)
	{
		$permiso = $this->contar('permiso', array('idRol'=>$id_role,'permiso'=>$permission));
		return $permiso > 0;

	}
}
?>