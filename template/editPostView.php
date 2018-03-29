<?php $title = htmlspecialchars('Edition de post'); ?>

<?php ob_start(); ?>
	<h2>Post</h2>

	<?php
		$post = $editedPost->fetch();
	?>

	<form action="home.php?action=editedPost&id=<?= $post['id']?>" method="post">
		<div>
			<label for="newTitle">Titre du post</label><br />
			<textarea id="newTitle" name="newTitle"><?= $post['title'] ?></textarea>
		</div>
		<div>
			<label for="newPost">Post</label><br />
			<textarea id="newPost" name="newPost"><?= $post['content'] ?></textarea>
		</div>
		<div>
			<input type="submit" value="Editer le post" />
		</div>
		
	</form>

<?php $content = ob_get_clean(); ?>

<?php require ('template.php'); ?>