<h1>Articles</h1>

<p>
	Tous (<?php echo $total; ?>) | Publiés (<?php echo $publied; ?>)
</p>

<p>
	<a href="<?php echo Router::url('author/articles/edit'); ?>" class="btn btn-primary">Ajouter un article</a>
	<?php if(isset($_GET['login']) AND ($this->session->user('login') == $_GET['login'])) : ?>
		<a href="<?php echo Router::url('author/articles/index/'); ?>" class="btn">Voir tous les articles</a>
	<?php else : ?>
		<a href="<?php echo Router::url('author/articles/index/?login='.$this->session->user('login')); ?>" class="btn">Voir mes articles</a>
	<?php endif; ?>
</p>

<br />

<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Titre</th>
			<th>Categorie</th>
			<th>Date</th>
			<th>&Eacute;tat</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($articles as $key => $value) : ?>
			<tr>
				<td>
					<a href="<?php echo Router::url('author/articles/edit/'.$value->id); ?>" title="&Eacute;diter l'article">
						<strong><?php echo $value->title; ?></strong>
					</a>
					<br />
					<em>par <strong><?php echo $value->user_name; ?></strong></em> 
				</td>
				<td>
					<?php echo $value->category; ?>
				</td>
				<td>
					Publié le : <strong><?php echo $value->created; ?></strong>
					<br />
					<?php if($value->modified != '00/00/0000') echo 'Modifié le : <strong>'.$value->modified.'</strong>'; ?>
				</td>
				<td>
					<span class="btn btn-mini btn-<?php echo ($value->online == 1) ? 'success' : 'inverse'; ?>">
						<?php echo ($value->online == 1) ? 'En ligne' : 'Hors ligne'; ?>
					</span>
				</td>
				<td>
					<a href="<?php echo Router::url('author/articles/edit/'.$value->id); ?>"><i class="icon-pencil"> </i> &Eacute;diter</a>
					<br />
					<a href="<?php echo Router::url('author/articles/delete/'.$value->id); ?>" onClick="return confirm('Voulez vous vraiment supprimer cet article ?')"><i class="icon-remove"> </i> Supprimer</a> 
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
