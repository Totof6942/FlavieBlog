<h2>Connexion</h2>

<article class="post">

	<form action="<?php echo Router::url('users/login'); ?>"  method="post" class="form-horizontal">

		<?php echo $this->form->input('login','Identifiant'); ?>

		<?php echo $this->form->input('password','Mot de passe',array('type'=>'password')); ?>

		<div class="form-actions">
			<button type="submit" class="btn btn-inverse">Connexion</button>
		</div>
	</form>

	<div class="clear"></div>

</article>
