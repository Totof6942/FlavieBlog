<?php if(isset($title)) : ?>
	<h2><?php echo $title; ?></h2>
<?php endif; ?>

<?php foreach ($articles as $key => $value): ?>

	<article class="post">
		<header>
			<h3><a href="<?php echo Router::url("articles/view/id:{$value->id}/slug:$value->slug"); ?>"><?php echo $value->title; ?></a></h3>
			<p class="postinfo">
				Publié  le <?php echo $value->created; ?>, dans <a href="<?php echo Router::url('articles/category/slug:'.$value->category_slug); ?>"><?php echo $value->category_name; ?></a>
			</p>
		</header>
		<p>
			<?php echo CCCode::parser($value->content); ?>
		</p>
		<footer>
			<span class="author"><a href="<?php echo Router::url("users/view/login:$value->user_login"); ?>"><?php echo $value->user_name; ?></a></span>
			<span class="comments"><a href="#">21 Commentaires</a></span>
		</footer>
	</article>

<?php endforeach; ?>

<?php if($nbPages > 0) : ?>
	
	<div>
		<ul class="pager">

		<?php if($this->request->getPage() < $nbPages) : ?>
			<li class="previous">
				<a href="?page=<?php echo ($this->request->getPage() + 1); ?>">&larr; Plus anciens</a>
			</li>
		<?php endif; ?>

		<?php if($this->request->getPage() > 1) : ?>
			<li class="next">
				<a href="?page=<?php echo ($this->request->getPage() - 1); ?>">Plus récents &rarr;</a>
			</li>
		<?php endif; ?>

		</ul>
	</div>

<?php endif; ?>
