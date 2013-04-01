<form action="<?php echo Router::url('admin/users/edit/'.$id); ?>"  method="post" enctype="multipart/form-data" class="form-horizontal">
	
	<fieldset>

		<legend><h1><?php echo ($id) ? 'Modifier l\'utilisateur' : 'Ajouter un utilisateur'; ?></h1></legend>
	
		<?php echo $this->form->input('login', 'Login de l\'utilisateur', array('class' => 'span6', 'placeholder' => 'Login')); ?>

		<?php echo $this->form->input('name', 'Nom de l\'utilisateur', array('class' => 'span6', 'placeholder' => 'Prénom et Nom')); ?>

		<?php echo $this->form->input('email', 'Email de l\'utilisateur', array('class' => 'span6', 'placeholder' => 'Email')); ?>

		<?php echo $this->form->input('password', 'Mot de passe de l\'utilisateur', array('type' => 'password', 'class' => 'span6', 'placeholder' => 'Mot de passe')); ?>

		<?php echo $this->form->input('confirmation', 'Confirmation du mot de passe', array('type' => 'password','class' => 'span6', 'placeholder' => 'Confirmation mot de passe')); ?>

		<?php echo $this->form->input('group_id', 'Groupe de l\'utilisateur', array('options' => $groups)); ?>

		<?php echo $this->form->input('avatar', 'Avatar de l\'utilisateur', array('type' => 'file')); ?>

		<?php echo $this->form->input('id', 'hidden'); ?>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?php echo Router::url('admin/users/index'); ?>" class="btn">Annuler</a>
		</div>

	</fieldset>	

</form>