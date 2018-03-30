<?php $title = htmlspecialchars('Ajout d\'article'); ?>

<?php ob_start(); ?>
	<h2>Ajout d'article</h2>

	<form action="../public/index.php?action=addPost" method="post">
		<div>
			<label for="title">Titre</label><br />
			<input type="text" id="title" name="title">
		</div>
		<div>
			<label for="article">Article</label><br />
			<textarea id="article" name="article"></textarea>
		</div>
		<div>
			<input type="submit" value="Ajouter cet article">
		</div>
		
	</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>