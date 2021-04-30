
const
	CAcs   = 0;
	CMan   = 2;
	CReg   = 11;
	CLogin = 10;

function servRes(val1, idkey, code) {
	$.ajax({
		url: '../server.php',
		method: "GET",
		data: {
			opcode: code,
			val1: val1, 
			idkey: idkey
		},
		dataType: "text",
		success: function(res){
			console.log('responce: '+res);
			if (res=='0') {
				// Success
				document.location.href = 'http://compfix';
			}
			else if (res=='11') {
				// Pass no
				$('.dv-wrdn').css('display','block');
				$('.dv-wrdn').text('Wrong password.');
			}
			else if (res=='10') {
				// User no
				$('.dv-wrdn').css('display','block');
				$('.dv-wrdn').text('User with this address or login doen\'t exist.');
			}
			else {
				alert('The answer has not been returned. Repeat Login.');
			}
			inlog.prop('disabled', false);
			inpass.prop('disabled', false);
			$('a').attr('href', '/signup');
			btnlog.prop('disabled', false);	
			// $('.dv-wrdn').css('display','none');
			btnlog.html('Login');	
			
		},
		error: function(jq_, st, th){
			alert('Status: '+st+' '+th);
		}

	});
}
function servReg(name, email, pass, code) {
	$.ajax({
		url: '../server.php',
		method: "GET",
		data: {
			opcode: code,
			name: name,
			email: email,
			pass: pass
		},
		dataType: "text",
		success: function(res){
			console.log('responce: '+res);
			if (res=='0') {
				// Success
				document.location.href = 'http://compfix';
			}
			else if (res=='2') {
				// email no
				$('.dv-wrdn').css('display','block');
				$('.dv-wrdn').text('A user with this email address already exists.');
			}
			else if (res=='3') {
				// id no
				$('.dv-wrdn').css('display','block');
				$('.dv-wrdn').text('A user with this login already exists.');
			}
			else {
				alert('The answer has not been returned. Repeat sign up.');
			}
			$('#username').prop('disabled', false);
			$('#nid').prop('disabled', false);
			$('#email').prop('disabled', false);
			$('#date-day').prop('disabled', false);
			$('#date-mounth').prop('disabled', false);
			$('#date-year').prop('disabled', false);
			$('#password').prop('disabled', false);
			$('#password-conf').prop('disabled', false);
			$('a').attr('href', '/signup');
			$('#signup').prop('disabled', false);	
			// $('.dv-wrdn').css('display','none');
			$('#signup').html('Login');	
			
		},
		error: function(jq_, st, th){
			alert(st+': '+th);
		}

	});
}

const loadpulse = '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>';
var inlog = $('#username');
var inpass = $('#password');
var btnlog = $('#log');

// Actions

$('#log').click(function() {
	if (inlog.val()!=''&&inpass.val()!='') {
		inlog.prop('disabled', true);
		inpass.prop('disabled', true);
		$('a').removeAttr('href');
		btnlog.prop('disabled', true);		
		btnlog.html(loadpulse);
		servRes(inlog.val(), inpass.val(), CLogin);
	} else {

	}
});


$('#signup').click(function() {
	$name = $('#username').val();
	$email = $('#email').val();
	$pass1 = $('#password').val();
	$pass2 = $('#password-conf').val();
	$('.dv-wrdn').css('display','none');
	if ($name!=='' && $email!=='' && $pass1!=='' && $pass2!=='') {
		if ($pass1 === $pass2) {
			$('#username').prop('disabled', true);
			$('#email').prop('disabled', true);
			$('#password').prop('disabled', true);
			$('#password-conf').prop('disabled', true);
			$('a').removeAttr('href');
			$('#signup').prop('disabled', true);
			$('#signup').html(loadpulse);
			servReg($name, $email, $pass1, CReg);
		} else {
			$('.dv-wrdn').css('display','block');
			$('.dv-wrdn').text('Password mismatch!');
		}
	} else {
		$('.dv-wrdn').css('display','block');
		$('.dv-wrdn').text('Fields are not filled.');
	}
});

// var bth_day = document.querySelector('input[name=bth-day]'),
// bth_month = document.querySelector('input[name=bth-mounth]'),
// bth_year = document.querySelector('input[name=bth-year]');	

// bth_day.addEventListener('input', function() {
// 	if (bth_day.value<10)
// 		bth_day.value='0'+bth_day.value;
// })
// bth_month.addEventListener('input', function() {
// 	if (bth_month.value<10)
// 		bth_month.value='0'+bth_month.value;
// })
// bth_year.addEventListener('change', function() {
// 	if (bth_year.value>bth_year.max)
// 		bth_year.value=bth_year.max;
// 	if (bth_year.value<bth_year.min)
// 		bth_year.value=bth_year.min;
// })
// bth_day.addEventListener('change', function() {
// 	if (bth_day.value>bth_day.max)
// 		bth_day.value=bth_day.max;
// })
// bth_month.addEventListener('change', function() {
// 	if (bth_month.value>bth_month.max)
// 		bth_month.value=bth_month.max;
// })

