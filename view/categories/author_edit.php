<form action="<?php echo Router::url('author/categories/edit/'.$id); ?>"  method="post" class="form-horizontal">
	
	<fieldset>

		<legend><h1><?php echo ($id) ? 'Modifier la catégorie' : 'Ajouter une catégorie'; ?></h1></legend>
	
		<?php echo $this->form->input('name', 'Nom', array('class' => 'span8', 'placeholder' => 'Nom de la catégorie', 'required' => 'required')); ?>
		
		<?php echo $this->form->input('description', 'Description', array('class' => 'span8', 'placeholder' => 'Description de la catégorie', 'required' => 'required')); ?>
		
		<?php echo $this->form->input('slug', 'Url', array('class' => 'span8', 'placeholder' => 'Url de la catégorie')); ?>

		<?php echo $this->form->input('id', 'hidden'); ?>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?php echo Router::url('author/categories/index'); ?>" class="btn">Annuler</a>
		</div>

	</fieldset>	

</form>