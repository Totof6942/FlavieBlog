<h2><?php echo $user->name; ?></h2>

<article class="entry">
	<div class="avatar"> 
		<img src="<?php echo IMG.DS.'Avatars'.DS.$user->avatar; ?>" alt="avatar">

		<p class="author">
			<span class="name"><a href="#"><?php echo $user->group_name; ?></a></span>
			<span class="name"><?php echo $user->login; ?></span>
		</p>

	</div>

	<div class="comment">

	<p>
		Ce membre a écrit <?php echo $nbArticles; ?> article<?php if($nbArticles > 1) echo 's'; ?> <?php if($nbArticles > 0) : ?>(<a href="<?php echo Router::url('articles/user/login:'.$user->login); ?>">afficher</a>)<?php endif; ?>
	</p>

	</div>
	<div class="clear"></div>
</article>