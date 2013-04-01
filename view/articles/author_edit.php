<form action="<?php echo Router::url('author/articles/edit/'.$id); ?>"  method="post" class="form-horizontal">
	
	<fieldset>

		<legend><h1><?php echo ($id) ? 'Modifier l\'article' : 'Ajouter un article'; ?></h1></legend>
	
		<?php echo $this->form->input('title', 'Titre', array('class' => 'span8', 'required' => 'required', 'placeholder' => 'Titre de l\'article')); ?>

		<?php echo $this->form->input('slug', 'Url', array('class' => 'span8', 'placeholder' => 'Url')); ?>


  		<?php echo $this->form->input('category_id','Catégorie', array('options' => $categories)); ?>


		<?php echo $this->form->input('content', 'Contenu', array('type' => 'textarea', 'rows' => 10, 'cols' => 50, 'class' => 'span8', 'required' => 'required')); ?>

		<?php echo $this->form->input('online','En ligne',array('type'=>'checkbox')); ?>

		<?php echo $this->form->input('id', 'hidden'); ?>

		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Enregistrer</button>
			<a href="<?php echo Router::url('author/articles'); ?>" class="btn">Annuler</a>
		</div>

	</fieldset>	

</form>