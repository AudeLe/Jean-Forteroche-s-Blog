<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
	
	<h1>Mon super blog !</h1>
	<p><a href="../public/index.php">Retour à la liste des billets</a></p>

	<div class="news">
		<h3>
			<?= htmlspecialchars($post['title']) ?><br />
			<em>le <?= $post['creation_date_fr'] ?></em>
		</h3>

		<p>
			<?= nl2br(htmlspecialchars($post['content'])) ?>
		</p>
	</div>

	<h2>Commentaires</h2>

	<form action="../public/index.php?action=addComment&id=<?= $post['id'] ?>" method="post">
		<div>
			<label for="author">Auteur</label><br />
			<input type="text" id="author" name="author" />
		</div>
		<div>
			<label for="comment">Commentaire</label><br />
			<textarea id="comment" name="comment"></textarea>
		</div>
		<div>
			<input type="submit">
		</div>
	</form>

	<?php
		while($comment = $comments->fetch()){
			?>
			<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> <button id="ReportedComment">Signaler</button></p>
            <p id="ReportedCommentArea"></p>
			<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>

			<?php
		}
		?>
	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>