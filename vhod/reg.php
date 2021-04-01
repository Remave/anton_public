<?php
require 'dbconnect.php';

if (isset($_SESSION['USER'])) {
	$user = R::findOne('users', 'id = ?' [$_SESSION['USER']]);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<title>Регистрация</title>
</head>
<body>
<div class="allWrap">
	<header class="header">
		<div class="logo"></div>
		<div class="headerDiscription"></div>
	</header>

	<main class="main">
		<div class="registration">

			<div class="counter">
				
			</div>

			<div class="registerButtons">
				<div>
					<label for="in1">Email</label>
					<input id="in1" type="email">					
				</div>
				<div>
					<label for="in2">Ник</label>
					<input id="in2" type="text" pattern="/([A-Za-z0-9-_@#!?]+)/">	
				</div>
				<div>
					<label for="in3">Пароль</label>
					<input id="in3" type="password">	
				</div>
				<div>
					<label for="in4">Повторите пароль</label>
					<input id="in4" type="password">	
				</div>
				<div>
					<button id="btn">Зарегистрироватся</button>
					<a href="index.php">Войти</a>
				</div>
				<div>
					<p id="errs" style="color: #A00;"></p>
				</div>

			</div>

		</div>

		<div class="orderWrap">
			<div class="order"></div>
			<div class="order"></div>
			<div class="order"></div>
		</div>
	</main>
</div>
	<footer class="footer">
		<div class="footerDescription">
			
		</div>

		<div class="contactsWrap">
			<div class="contacts"></div>
			<div class="contacts"></div>
			<div class="contacts"></div>
		</div>
		
	</footer>

	<script src="ajax.js"></script>
	<script type="text/javascript">
		const in1 = $('#in1');
		const in2 = $('#in2');
		const in3 = $('#in3');
		const in4 = $('#in4');
		const err = $('#errs');

		document.getElementById('btn').onclick = () => {
			if (in1.val().trim()!=='' && in2.val().trim()!=='' && in3.val().trim()!=='' && in4.val().trim()!=='') {
				if (!/([A-Za-z0-9-_@#!?]+)/g.exec(in2.val())) {
					err.text('В никнейме может содержатся только латинские буквы цивры и символы - _ @ # ! ?');
				}
				else
				if (in3.val().trim() === in4.val().trim()) {
					$.ajax({
						url: '/server.php',
						dataType: "text",
						data: {
							opcode: 1,
							email: in1.val(),
							name: in2.val(),
							pass: in3.val()
						},
						success: function(res) {
							//ответ 0 OK
							if (res==='0') {
								document.location.href = 'http://vhod';
							}
							if (res==='1') {
								err.text('Пользователь с такой почтой уже есть.');
							}
							
						},
						error: function(xhr, stat, err) {
							alert('Status: '+stat+'; Error: '+err)
						}
					});
					
				} else {
					err.text('Пароли не совпадают!');
				}				
			} else {
				err.text('Заполните все поля.');
			}
			
		}

	</script>
</body>
</html>