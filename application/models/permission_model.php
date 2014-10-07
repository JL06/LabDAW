<?php
class Permission_model extends Generic_model
{

	function has_permission($idRole, $permission)
	{
		$permiso = $this->contar('permiso', array('idRol'=>$idRole,'permiso'=>$permission));
		return $permiso > 0;

	}
}
?>