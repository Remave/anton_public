<?php
require 'connect.php';

function _iniusermas($id)
{
	$user = R::findONE('users', 'id=?', $id);
	$_SESSION['USER'] = $user->name;
	return $user;
}

?>