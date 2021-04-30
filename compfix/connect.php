<?php

require 'rb/rb.php';

//Connect database
R::setup( 'mysql:host=localhost;dbname=compfix', 'root', '' );

session_name('LOGIN_UID');
// session_start();

if (!R::testConnection()) {
	exit('No connection');
}
?>