<h1>Groupes</h1>

<div>
	<p>
		Tous (<?php echo $total; ?>)
	</p>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Nom</th>
			<th>Niveau</th>
			<th>Utilisateurs</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($groupes as $key => $value) : ?>
			<tr>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->level; ?></td>
				<td><?php echo $value->nbUsers; ?></td>
				<td>
					<a href="<?php echo Router::url('admin/groups/edit/'.$value->id); ?>"><i class="icon-pencil"> </i> &Eacute;diter</a>
					<br />
					<a href="<?php echo Router::url('admin/groups/delete/'.$value->id); ?>" onClick="return confirm('Voulez vous vraiment supprimer ce groupe ?')"><i class="icon-remove"> </i> Supprimer</a> 
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<a href="<?php echo Router::url('admin/groups/edit'); ?>" class="btn btn-primary">Ajouter un groupe</a>