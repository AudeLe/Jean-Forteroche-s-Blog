<?php $title = htmlspecialchars('Edition de commentaire'); ?>

<?php ob_start(); ?>
	
	<h2>Commentaires</h2>

	<?php
		$comment = $editedComment->fetch();
	?>

	<form action="../public/index.php?action=editedComment&id=<?= $comment['id'] ?>" method="post">
		<div>
			<p>Auteur : <?= $comment['author'] ?></p>
		</div>
		<div>
			<label for="newComment">Commentaire</label><br />
			<textarea id="newComment" name="newComment"><?= $comment['comment'] ?></textarea>
		</div>
		<div>
			<input type="submit" value="Editer le commentaire" />
		</div>
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>