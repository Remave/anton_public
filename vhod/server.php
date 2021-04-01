<?php

require 'dbconnect.php';

$opcode = $_GET['opcode'];

$name = $_GET['name'];
$email = $_GET['email'];
$pass = $_GET['pass'];
$res = '1';

//Вход
if ($opcode==='0') {
	$user = R::findOne('users', 'email = ?', [$email]);
	if ($user) {
		if (password_verify($pass, $user->pass)) {
			session_start();
			$_SESSION['USER'] = $user;
			$res = '0';			
		} else $res = '1';

	} else $res = '2';

	echo $res;
	die;
}
//Рег
else if ($opcode==='1') {
	//Находим пользователь с таким же email, если его нет то создаем юзера
	if (!R::findOne('users', 'email = ?', [$email])) {
		$user = R::dispense('users');
		$user->email = $email;
		$user->name = $name;
		$user->pass = password_hash($pass, PASSWORD_DEFAULT);
		R::store($user);
		$res = '0';
	}
	else $res = '1';

	echo $res;
	die;

} else {
	echo '1';
	die;
}

//Закрываем соединение с базой
R::close();

?>