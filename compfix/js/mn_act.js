const backbody = $('body');
const
	usbtn  = $('.usbtn'),
	snmenu = $('.blk-menuYs');

usbtn.focus(function() {
	snmenu.css('display','block');
});
snmenu.focusout(function() {
	if (!snmenu.target.matches('.dropbtn')) {
		if (snmenu.css('display')=='display') snmenu.css('display','none');
	}
});
//598
const stepscr = 281*3;
$('.btn-ritscrl').click(function() {
	$('.is-nwsup').animate({scrollLeft: '+='+stepscr},400);
});
$('.btn-leftscrl').click(function() {
	$('.is-nwsup').animate({scrollLeft: '-='+stepscr},400);
});

$('.btn-rate-up').click(function () {
	rateUpdate($(this).val(), $('#user_id').val(), 20);
});
$('.btn-rate-down').click(function () {
	rateUpdate($(this).val(), $('#user_id').val(), 21);
});

function rateUpdate(rev, user, code) {
	$.ajax({
		url: '../server.php',
		method: "GET",
		data: {
			opcode: code,
			rev: rev,
			user: user
		},
		dataType: "text",
		success: function(response){
			console.log(response);
			document.location.href = '/';
		},
		error: function(jq_, st, th){
			alert(st+': '+th);
		}

	});
}

function sendReview(header, text, user, code) {
	$.ajax({
		url: '../server.php',
		method: "GET",
		data: {
			opcode: code,
			header: header,
			text: text,
			user: user
		},
		dataType: "text",
		success: function(response){
			console.log('res: '+response);
			if (response==30) {
				alert('Отзыв отправлен. Ожидайте модерацию.');
				document.location.href='/';				
			}

			else if (response==31) alert('Ошибка отправки отзыва повторите попытку.');
		},
		error: function(jq_, st, th){
			alert(st+': '+th);
		}

	});
}

function revUpdate(id, code) {
	$.ajax({
		url: '../server.php',
		data: {
			opcode: code, id: id
		},
		dataType: 'text',
		success: function(response){
			console.log('res: '+response);
			if (response==40) {
				alert('Отзыв опубликован.');
				document.location.reload();			
			}
			if (response==41) {
				alert('Отзыв удалет.');
				document.location.reload();			
			}

		},
		error: function(jq_, st, th){
			alert(st+': '+th);
		}

	});
}