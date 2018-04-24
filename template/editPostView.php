<?php $this->title = 'Edition de post'; ?>

	<h2>Edition de chapitre</h2>


	<form action="../public/index.php?action=editedPost&id=<?= $post->getId(); ?>" method="post">
		<div>
			<label for="newTitle">Titre du post</label><br />
			<textarea id="newTitle" name="newTitle"><?= $post->getTitle(); ?></textarea>
		</div>
		<div>
			<label for="newPost">Post</label><br />
			<textarea id="newPost" name="newPost"><?= $post->getContent(); ?></textarea>
		</div>
		<div>
			<input type="submit" value="Editer le post" />
		</div>
		
	</form>
