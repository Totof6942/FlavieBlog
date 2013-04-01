<form action="<?php echo Router::url('admin/groups/edit/'.$id); ?>"  method="post" class="form-horizontal">
	
	<fieldset>

		<legend><h1><?php echo ($id) ? 'Modifier le groupe' : 'Ajouter un groupe'; ?></h1></legend>

		<?php echo $this->form->input('name', 'Nom du groupe', array('class' => 'span8', 'placeholder' => 'Nom du groupe', 'required' => 'required')); ?>

		<?php echo $this->form->input('level', 'Niveau du groupe', array('options' => $levels)); ?>

		<?php echo $this->form->input('id', 'hidden'); ?>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?php echo Router::url('admin/groups/index'); ?>" class="btn">Annuler</a>
		</div>

	</fieldset>	

</form>