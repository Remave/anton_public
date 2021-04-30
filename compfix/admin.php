<?php
require 'connect.php';

$is_log = 0;
if (isset($_COOKIE['_uid'])) {
	// session_start();
	$is_log = 1;
	$name = $_SESSION['USER'];
	$user = R::findOne('users', 'id=?', [$_COOKIE['_uid']]);
}



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
					<span style="margin-left: 6px;">Модерация отзывав</span>
				</div>
			</div>
			<div class="cont_dv">
				<div class="cont_rev">
					<?php
					$revs = R::getAll( 'SELECT * FROM reviews WHERE approved=0' );
					if ($revs)
					foreach ($revs as $val):
					?>
					<div class="dv-rev-blk">
						<div class="dv-pop-left">
							<button class="rev-chk btn-pop-rate" value="<?=$val['id']?>" title="Одобрить отзыв"><img src="src/feather/check.svg"></button>
							<button class="rev-x btn-pop-rate" value="<?=$val['id']?>" title="Удалить отзыв"><img src="src/feather/x.svg"></button>
						</div>
						<div class="dv-rev-ext">
							<div class="dv-header-flex">
								<h5><?=$val['header']?></h5>
								<span class="nm-ln"><?=R::findOne('users','id = ?',[$val['owner']])->login?></span>
							</div>
							
							<p class="p-ext"><?=$val['text']?></p>
						</div>
					</div>					
					<?php endforeach; else echo '<p>Нет новых отзывов.</p>' ?>
				</div>
			</div>
		</div>
		<?R::close()?>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="js/mn_act.js"></script>
	<script type="text/javascript">
		$('.rev-chk').click(function (argument) {
			revUpdate($(this).val(), 40)
		});
		$('.rev-x').click(function (argument) {
			revUpdate($(this).val(), 41)
		});
	</script>
</body>
</html>