<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>
	<h1>Mon super blog !</h1>
	<p>Derniers billets du blog :</p>

	<?php
		while($data = $posts->fetch()){
			?>
			<div class="news">
				<h3>
					<?= htmlspecialchars($data['title']) ?><br/ >
					<em>le <?= $data['creation_date_fr'] ?></em><a href="../public/index.php?action=editPost&id=<?= $data['id'] ?>"> - Editer le post</a><br />
					<a href="../public/index.php?action=deletePost&id=<?= $data['id'] ?>">Supprimer le post</a>
				</h3>

				<p>
					<?= nl2br(htmlspecialchars($data['content'])) ?><br />
					<em><a href="../public/index.php?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
				</p>
			</div>

			<?php
		}
		$posts->closeCursor();
	?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>