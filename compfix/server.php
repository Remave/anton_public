<?php

require 'connect.php';

$opcode = $_GET['opcode'];

$res = null;

if ($opcode == 10) { // Login
	$v1 = $_GET['val1'];
	$pass = $_GET['idkey'];
	if (isset($v1, $pass)) {
		$user = R::findOne('users','email = ? or login = ?',[$v1,$v1]);
		if ($user) {
			if ($pass===$user->pass) {
				session_start();
				$_SESSION['USER'] = $user->name;
				setcookie('_uid', $user->id, time()+3600*24*30);
				$res = 0;
			} else $res = 11;
		} else $res = 10;	
	}
	echo $res;
	die;
}
else if ($opcode == 11) { //Reg
	$name = $_GET['name'];
	$email = $_GET['email'];
	$pass = $_GET['pass'];

	if (R::findOne('users','email = ?',[$email])) {
		$res = 2;
	}
	else if (R::findOne('users','login = ?',[$name])) {
		$res = 3;
	} else {
		$user = R::dispense('users');
		$user->login = $name;
		// $user->pass = password_hash($pass, PASSWORD_DEFAULT);
		$user->pass = $pass;
		$user->email = $email;
		$user->type = 0;
		R::store($user);
		session_start();
		$_SESSION['USER'] = $name;
		setcookie('_uid', $user->id, time()+3600*24*30);
		$res = 0;
	}
	echo $res;
	die;
}
// Обновление рейтинга
else if ($opcode == 20) {
	$rev = $_GET['rev'];
	$user = $_GET['user'];
	$r = R::findOne('rating', 'rev_id = ? and user_id = ?', [$rev, $user]);
	if (!$r) {
		$up = R::dispense('rating');
		$up->rev_id = $rev;
		$up->user_id = $user;
		$up->rate = 1;
		R::store($up);
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating+1;
		R::store($revs);
		R::trash($r);
		$res=20;
	} if ($r->rate<=0) {
		$up = R::dispense('rating');
		$up->rev_id = $rev;
		$up->user_id = $user;
		$up->rate = 1;
		R::store($up);
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating+2;
		R::store($revs);
		R::trash($r);
		$res=21;
	} else if ($r->rate>0) {
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating-1;
		R::store($revs);
		R::trash($r);
		$res=20;
	} else $res=22;
	echo $res;
	die;
}
else if ($opcode == 21) {
	$rev = $_GET['rev'];
	$user = $_GET['user'];
	$r = R::findOne('rating', 'rev_id = ? and user_id = ?', [$rev, $user]);
	if (!$r) {
		$up = R::dispense('rating');
		$up->rev_id = $rev;
		$up->user_id = $user;
		$up->rate = -1;
		R::store($up);
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating-1;
		R::store($revs);
		R::trash($r);
		$res=21;
	} if ($r->rate>=0) {
		$up = R::dispense('rating');
		$up->rev_id = $rev;
		$up->user_id = $user;
		$up->rate = -1;
		R::store($up);
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating-2;
		R::store($revs);
		R::trash($r);
		$res=21;
	} else if ($r->rate<0) {
		$revs = R::load('reviews', $rev);
		$revs->rating = $revs->rating+1;
		R::store($revs);
		R::trash($r);
		$res=20;
	} else $res=22;
	echo $res;
	die;
}
//добавление отзывов
else if ($opcode == 30) {
	$header = $_GET['header'];
	$text = $_GET['text'];
	$user = $_GET['user'];
	// if () {
		$rev = R::dispense('reviews');
		// $rev->id = date('Ymdi');
		$rev->header = $header;
		$rev->text = $text;
		$rev->owner = $user;
		if (R::store($rev)) $res = 31;
		$res=30;
	// } else {
	// 	$res=31;
	// }
	echo $res;
	die;
}
// удаление и одабрение отзывав
else if ($opcode == 40) {
	$id = $_GET['id'];
	$rev = R::load('reviews', $id);
	$rev->approved=1;
	R::store($rev);
	echo $res=40;
	die;
}
else if ($opcode == 41) {
	$id = $_GET['id'];
	R::trash(R::load('reviews', $id));
	echo $res=41;
	die;
}

?>