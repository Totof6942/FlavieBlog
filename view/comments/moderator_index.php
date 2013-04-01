<h1>Commentaires</h1>

<p>
	Tous (<?php echo $total; ?>)
</p>

<br />

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Article</th>
			<th>Auteur</th>
			<th>Date</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($comments as $key => $value) : ?>
			<tr>
				<td>
					<a href="<?php echo Router::url("articles/view/id:{$value->article_id}/slug:$value->article_slug"); ?>" title="Voir l'article (front office)">
						<strong><?php echo $value->article_title; ?></strong>
					</a>
				</td>
				<td>
					<a href="<?php echo Router::url('users/view/login:'.$value->user_login); ?>" title="Voir le profil public de l'utilisateur">
						<?php echo $value->user_name; ?>
					</a>
				</td>
				<td>
					Publié le : <strong><?php echo $value->created; ?></strong>
				</td>
				<td>
					<a href="<?php echo Router::url('moderator/comments/delete/'.$value->id); ?>" onClick="return confirm('Voulez vous vraiment supprimer ce commentaire ?')"><i class="icon-remove"> </i> Supprimer</a> 
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if($nbPages > 1) : ?>
	<div class="pagination">
		<ul>
			<li <?php if($this->request->getPage() == 1) echo 'class="active"'; ?>><a href="?page=1" title="Première page">&larr;</a></li>

			<?php for($i = 1 ; $i <= $nbPages ; $i++): ?>
				<li <?php if($i == $this->request->getPage()) echo 'class="active"'; ?>><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
			<?php endfor; ?>
		
			<li <?php if($this->request->getPage() == $nbPages) echo 'class="active"'; ?>><a href="?page=<?php echo $nbPages; ?>" title="Dernière page">&rarr;</a></li>
		</ul>
	</div>
<?php endif; ?>