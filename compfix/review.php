<?php
require 'connect.php';

$is_log = 0;
if (isset($_COOKIE['_uid'])) {
	// session_start();
	$is_log = 1;
	$name = $_SESSION['USER'];
	$user = R::findOne('users', 'id=?', [$_COOKIE['_uid']]);
}
$url = $_GET['url'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>User | Prisonic</title>
	<meta name="viewport" content="width=916, initial-scale=1">
	<link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link href="open-iconic/font/css/open-iconic.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/mn.css">
</head>
<body>
	<?php require 'header.php'; ?>
	<div id="mn">
		<div class="mn_in">
			<div class="cont_ntvRec">
                <div class="title-blk">
					<span style="margin-left: 6px;">Напишите отзыв</span>
				</div>
			</div>
			<div class="cont_dv">
                <div class="div-rev-m">
                	<label for="review-header">Заголовок</label>
                	<div>
	                    <input id="review-header">               		
                	</div>
                	<label for="review-text">Текст</label>
                	<div>
	                    <textarea id="review-text" style="resize: auto;"></textarea>                		
                	</div>
 
                    <button type="button" class="btn btn-primary submitbtn rounded-pill" id="review-send">Отправить отзыв
                    </button>                    
                </div>

			</div>
		</div>
		<?R::close()?>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/mn_act.js"></script>
    <script>
        $('#review-send').click(function () {
            let header = $('#review-header').val();
            let text = $('#review-text').val();
            if (header!=='' && text!=='') {
                sendReview(header, text, $('#user_id').val(), 30);
            }
        });
    </script>

</body>
</html>