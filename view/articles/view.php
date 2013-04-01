<?php $title_for_layout = $article->title; ?>

<article class="post">
	<header>
		<h3><?php echo $article->title; ?></h3>
		<p class="postinfo">
			Publié  le <?php echo $article->created; ?>, dans <a href="<?php echo Router::url('articles/category/slug:'.$article->category_slug); ?>"><?php echo $article->category_name; ?></a>
		</p>
	</header>
	<p>
		<?php echo CCCode::parser($article->content); ?>
	</p>
	<div class="clear"></div>
</article>

