<?php $this->title = 'Edition de commentaire'; ?>

	
	<h2>Commentaires</h2>
    <div class="row">
        <div class="col-md-12">
            <form action="../public/index.php?action=editedComment&id=<?= $comment->getId(); ?>&memberLogin=<?= $comment->getAuthor(); ?>" method="post">
                <div>
                    <input type="hidden" value="<?= $comment->getPostId(); ?>" />
                </div>
                <div>
                    <p>Auteur : <?= strip_tags($comment->getAuthor()); ?></p>
                </div>
                <div>
                    <label for="newComment">Commentaire</label><br />
                    <textarea id="newComment" name="newComment"><?= strip_tags($comment->getComment()); ?></textarea>
                </div>
                <div>
                    <input type="submit" value="Editer le commentaire" />
                </div>
            </form>
        </div>
    </div>

