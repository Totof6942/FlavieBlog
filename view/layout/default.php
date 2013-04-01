<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?php echo isset($title_for_layout) ? $title_for_layout : 'Blog'; ?></title>
		<meta name="description" content="Boostrap from Twitter">
   	 	<meta name="author" content="Christophe Poulette &amps; Claude Dioudonnat">

    	<link rel="stylesheet" href="<?php echo Router::webroot('css/Default/style.css'); ?>">
	</head>

	<body>
		<div id="bodywrap">

		<?php
	    	$nav = $this->request->getController().'_'.$this->request->getAction();
	    ?>
	    			
			<section id="pagetop">
				<nav id="sitenav">
					<ul>
						<li <?php if($nav == 'articles_index') echo 'class="current"'; ?>>
							<a href="<?php echo Router::url(); ?>">Accueil</a>
						</li>
						<?php if($this->session->isLogged()) : ?>
							<?php if($this->session->user('level') > 2) : ?>
								<li>
									<a href="<?php echo Router::url('moderator/pages/index/'); ?>">Administration</a>
								</li>
							<?php endif; ?>
							<li>
								<a href="<?php echo Router::url('users/logout'); ?>">Déconnexion</a>
							</li>
						<?php else : ?>
							<li <?php if($nav == 'users_login') echo 'class="current"'; ?>>
								<a href="<?php echo Router::url('users/login'); ?>">Connexion</a>
							</li>
						<?php endif; ?>	
					</ul>
				</nav>
			</section>

			<header id="pageheader">
				<a href="<?php echo Router::url(); ?>">
					<h1>flavie<span>blog</span></h1>
				</a>
			</header>
			
			<div id="contents">
				<section id="main">
					<div id="leftcontainer">

						<?php echo $this->session->flash(); ?>
						<?php echo $content_for_layout; ?>

						<div class="clear"></div>
					</div>
				</section>
				
				<section id="sidebar">
					<div id="sidebarwrap">
						<h2>About FlavieBlog</h2>
						<p>
							Super blog développé dans le cadre d'un TP web à l'IUT informatique de Clermont-Ferrand. La classe quoi :D
						</p>

						<h2>Catégories</h2>
						<ul>
							<?php $categories = $this->request('Categories', 'getCategories'); ?>
							<?php foreach ($categories as $catergory) : ?>
								<li><a href="<?php echo Router::url('articles/category/slug:'.$catergory->slug); ?>"><?php echo $catergory->name; ?></a>(<?php echo $catergory->nbArticles; ?>)</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</section>

				<div class="clear"></div>
			</div>
		</div>

		<footer id="pagefooter">
			<div id="footerwrap">
				<div class="copyright">
					<p>
			          Webmasters : <a href="http://dioudonnat.fr">Claude Dioudonnat</a> &amp; <a href="http://poulette.org">Christophe Poulette</a>
			          <br />
			          Site respectant les normes HTML5 &amp; CSS3 W3C
			          <br />
			          &copy; 2012
			        </p>
				</div>
			</div>
		</footer>
		<script src="<?php echo Router::webroot('js/Admin/jquery.js'); ?>"></script>
		<script src="<?php echo Router::webroot('js/Admin/bootstrap.js'); ?>"></script>
		<script src="<?php echo Router::webroot('js/Admin/bootstrap-alert.js'); ?>"></script>
	</body>
</html>
