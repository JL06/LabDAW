<?php
class Permission_model extends Generic_model{

	function has_permission($idRole, $permission){
		return $this->read->('permiso', array('idRol' => $idRole,'permiso' => $permission));
	}
}
?>