<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?php echo isset($title_for_layout) ? $title_for_layout : '[Blog] - Admin'; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Boostrap from Twitter">
    <meta name="author" content="Christophe Poulette &amps; Claude Dioudonnat">

    <link rel="stylesheet" href="<?php echo Router::webroot('css/Admin/bootstrap.css'); ?>">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }totof
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="./css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>
    
    <?php
      $nav = $this->request->getController();
      $sidebar = $this->request->getController().'_'.$this->request->getAction();
    ?>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo Router::url('moderator/pages/index/'); ?>">Admin Blog</a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php $menus = $this->request('Menus', 'getMenu'); ?>
              <?php foreach($menus as $menu) : ?>
                <li <?php if($nav == $menu['slug']) echo 'class="active"'; ?>>
                  <a href="<?php echo Router::url($menu['url']) ?>"><?php echo $menu['name']; ?></a>
                </li> 
              <?php endforeach; ?>

              <li class="divider-vertical"></li>
              <li>
                <a href="<?php echo Router::url(); ?>">Voir le blog</a>
              </li>
            </ul>
            <ul class="nav pull-right">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $this->session->user('login'); ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo Router::url('users/view/login:'.$this->session->user('login')); ?>">Voir mon profil public</a></li>
                  <li class="divider"></li>
                  <li><a href="<?php echo Router::url('users/logout'); ?>">Déconnexion</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <?php 
                $controller = array(
                  'Articles' => 'articles',
                  'Catégories' => 'categories',
                  'Commentaires' => 'comments',
                  'Ustilisateurs' => 'users',
                  'Goupes' => 'groups'  
                );
              ?>
              <?php foreach($controller as $key => $value) : ?>
                <?php $menus = $this->request('Menus', 'getSidebare', $value); ?>
                <?php if(!empty($menus)) : ?>  
                  <li class="nav-header">
                    <?php echo $key; ?>
                  </li>
                <?php endif; ?>
                <?php foreach($menus as $menu) : ?>
                  <li <?php if($sidebar == $menu['slug']) echo 'class="active"'; ?>>
                    <a href="<?php echo Router::url($menu['url']) ?>"><?php echo $menu['name']; ?></a>
                  </li> 
                  <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">

          <?php echo $this->session->flash(); ?>
          <?php echo $content_for_layout; ?>

        </div>
      </div>
      <hr>

      <footer>
        <p>
          Webmasters : <a href="http://dioudonnat.fr">Claude Dioudonnat</a> &amp; <a href="http://poulette.org">Christophe Poulette</a>
          <br />
          Site respectant les normes HTML5 &amp; CSS3 W3C
          <br />
          &copy; 2012
        </p>
      </footer>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo Router::webroot('js/Admin/jquery.js'); ?>"></script>
    <script src="<?php echo Router::webroot('js/Admin/bootstrap-dropdown.js'); ?>"></script>
    <script src="<?php echo Router::webroot('js/Admin/bootstrap-alert.js'); ?>"></script>
  </body>
</html>
