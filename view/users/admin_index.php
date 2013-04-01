<h1>Utilisateurs</h1>

<div>
	<p>
		Tous (<?php echo $total; ?>)
	</p>
</div>

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Login</th>
			<th>Nom</th>
			<th>Email</th>
			<th>Groupe</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($users as $key => $value) : ?>
			<tr>
				<td><?php echo $value->login; ?></td>
				<td><?php echo $value->name; ?></td>
				<td><?php echo $value->email; ?></td>
				<td><?php echo $value->group_name; ?></th>
				<td>
					<a href="<?php echo Router::url('admin/users/edit/'.$value->id); ?>"><i class="icon-pencil"> </i> &Eacute;diter</a>
					<br />
					<a href="<?php echo Router::url('admin/users/delete/'.$value->id); ?>" onClick="return confirm('Voulez vous vraiment supprimer cet utilisateur ?')"><i class="icon-remove"> </i> Supprimer</a> 
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<a href="<?php echo Router::url('admin/users/edit'); ?>" class="btn btn-primary">Ajouter un utilisateur</a>