<input id="user_id" type="hidden" value="<?=$user->id?>">
<div id="header">
	<div class="navs">
		<nav class="navs-pan">
			<a href="/"><span for="password" class="oi oi-dashboard" style="padding-right: 8px;"></span>CompFix</a>
		</nav>
		<div class="prsn-search-pox">
		</div>
		<div class="usrt-pan">
			<?php if($is_log): if($user->type==1):?>
				<a href="admin">Модерация</a>
				<?php else: ?>
				<a href="review">Написать отзыв</a>
				<a href="/user">Личный кабинет</a>
			<?php endif; ?>
				
				<a href="?op=out">Выйти</a>
			<?else:?>		
			<a href="/login">Войти</a>
			<?endif;?>
		</div>			
	</div>
</div>