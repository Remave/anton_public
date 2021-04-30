<?php
// require 'initset.php';
require 'connect.php';

$is_log = 0;
if (isset($_COOKIE['_uid'])) {
	// session_start();
	$is_log = 1;
	$name = $_SESSION['USER'];
	$user = R::findOne('users', 'id=?', [$_COOKIE['_uid']]);
}
if ($_GET['op']==='out') {
	unset($_COOKIE['_uid']); 
    setcookie('_uid', null, -1);
    unset($_SESSION['USER']);
    header('Location: /');
}

// _iniusermas();

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>CompFix - Агрегатор отзывов</title>
	<meta name="viewport" content="width=916, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
	<link href="open-iconic/font/css/open-iconic-bootstrap.css" rel="stylesheet">
	<!-- <link href="open-iconic/font/css/open-iconic.css" rel="stylesheet"> -->
	<link rel="stylesheet" type="text/css" href="css/mn.css">
</head>
<body>
	
	<?php require 'header.php'; ?>
	<div id="mn">
		<div class="mn_in">
			
			<div class="cont_ntvRec">
				<div class="title-blk">
					<span style="margin-left: 6px;">Популярное</span>
				</div>
				<div class="isimp-nin">
					<div class="is-nwsup">
						<div class="isin-nws">
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Мастерская 1</span>
							</a>
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Мастерская 2</span>
							</a>
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Мастерская 3</span>
							</a>
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Сервис</span>
							</a>
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Сервис</span>
							</a>
							<a href="" class="isto-iniblk dvtDimp">
								<span class="inSpnT">Сервис</span>
							</a>
						</div>
					</div>
					<div class="iswin-sh">
						<button class="btn-leftscrl">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left">
								<polyline points="15 18 9 12 15 6"></polyline>
							</svg>
						</button>
						<button class="btn-ritscrl">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right">
								<polyline points="9 18 15 12 9 6"></polyline>
							</svg>
						</button>
					</div>
				</div>
			</div>
			
			<div class="cont_dv">
				<div class="title-blk">
					<span style="margin-left: 6px;">Отзывы</span>
				</div>
				<div class="cont_rev">
					<?php
					$revs = R::getAll( 'SELECT * FROM reviews WHERE approved=1 ORDER BY rating DESC' );
					foreach ($revs as $val):
					?>
					<div class="dv-rev-blk">
						<div class="dv-pop-left">
							<?if($is_log && $user->id!==$val['owner']):?>
							<?if(R::findOne('rating', 'rev_id = ? and user_id = ?', [$val['id'], $user->id])->rate>0):?>
							<button class="btn-pop-rate btn-rate-up arrow-chk" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-top"></span></button>
							<div class="rate-id"><?=$val['rating']?></div>
							<button class="btn-pop-rate btn-rate-down" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-bottom"></span></button>
							<?elseif(R::findOne('rating', 'rev_id = ? and user_id = ?', [$val['id'], $user->id])->rate<0):?>
							<button class="btn-pop-rate btn-rate-up" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-top"></span></button>
							<div class="rate-id"><?=$val['rating']?></div>
							<button class="btn-pop-rate btn-rate-down arrow-chk" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-bottom"></span></button>
							<?else:?>
							<button class="btn-pop-rate btn-rate-up" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-top"></span></button>
							<div class="rate-id"><?=$val['rating']?></div>
							<button class="btn-pop-rate btn-rate-down" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-bottom"></span></button>
							<?endif;?>
							<?else:?>
							<button class="btn-pop-rate" style="cursor: default;" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-top"></span></button>
							<div class="rate-id"><?=$val['rating']?></div>
							<button class="btn-pop-rate" style="cursor: default;" value="<?=$val['id']?>"><span class="oi oi-arrow-thick-bottom"></span></button>
							<?endif;?>
						</div>
						<div class="dv-rev-ext">
							<div class="dv-header-flex">
								<h5><?=$val['header']?></h5>
								<span class="nm-ln"><?='от '.R::findOne('users','id = ?',[$val['owner']])->login?></span>
							</div>
							
							<p class="p-ext"><?=$val['text']?></p>
						</div>
					</div>					
					<?php endforeach; ?>
					<!-- <div class="dv-rev-blk">
						<div class="dv-pop-left">
							<button class="btn-pop-rate"><span class="oi oi-arrow-thick-top"></span></button>
							<div class="rate-id">1234</div>
							<button class="btn-pop-rate"><span class="oi oi-arrow-thick-bottom"></span></button>
						</div>
						<div class="dv-rev-ext">
							<h5>Отзыв</h5>
							<p class="p-ext">Lorem, ipsum dolor sit amet consectetur adipisicing, elit. Aperiam eligendi excepturi eveniet ipsum beatae porro laborum modi quisquam sint dignissimos laudantium distinctio doloribus magnam officia aliquam, aliquid quaerat odit rerum.</p>
						</div>
					</div> -->
					
				</div>
			</div>
			<div class="cont_dv">
				<?php require 'footer.php'; ?>
			</div>
		</div>
		<?R::close()?>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script src="js/mn_act.js"></script>
</body>
</html>