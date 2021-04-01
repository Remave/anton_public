<?php

require 'rb/rb.php';

$dbname = 'www_reg';

R::setup( 'mysql:host=localhost; dbname='.$dbname, 'root', '' );

if (!R::testConnection()) {
	exit('No connection');
}

?>