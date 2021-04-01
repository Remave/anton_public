<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
	<title>Главная</title>

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
				<?php echo $user->name; ?>
			</div>

			<div class="registerButtons">
				<div>
					<label for="in1">Email</label>
					<input id="in1" type="email">					
				</div>
				<div>
					<label for="in2">Password</label>
					<input id="in2" type="password">	
				</div>

				<div>
					<button id="btn">Войти</button>
					<a href="reg.php">Зарегистрироватся</a>
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
		const err = $('#errs');

		document.getElementById('btn').onclick = () => {
			if (in1.val().trim()!=='' && in2.val().trim()!=='') {
				$.ajax({
					url: '/server.php',
					dataType: "text",
					data: {
						opcode: 0,
						email: in1.val(),
						pass: in2.val()
					},
					success: function(res) {
						//ответ 0 OK
						if (res==='0') {
							document.location.href = 'http://vhod';
						}
						//ответ 1 Неверные данные
						if (res==='1') {
							err.text('Неверный пароль!');
						}
						if (res==='2') {
							err.text('Такого пользователя не найдено.');
						}
						
					},
					error: function(xhr, stat, err) {
						alert('Status: '+stat+'; Error: '+err)
					}
				});				
			}
			else err.text('Поля не заполнены.');

		}

	</script>
</body>
</html>