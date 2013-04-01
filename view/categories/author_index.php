<h1>Catégories</h1>

<br />

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Description</th>
			<th>Articles</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($categories as $key => $value) : ?>
			<tr>
				<td>
					<?php echo $value->name; ?>
				</td>
				<td>
					<?php echo $value->description; ?>
				</td>
				<td>
					<?php echo $value->nbArticles; ?>
				</td>
				<td>
					<a href="<?php echo Router::url('author/categories/edit/'.$value->id); ?>"><i class="icon-pencil"> </i> &Eacute;diter</a>
					<br />
					<a href="<?php echo Router::url('author/categories/delete/'.$value->id); ?>" onClick="return confirm('Voulez vous vraiment supprimer cette catégorie ?')"><i class="icon-remove"> </i> Supprimer</a> 
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<a href="<?php echo Router::url('author/categories/edit'); ?>" class="btn btn-primary">Ajouter une catégorie</a>