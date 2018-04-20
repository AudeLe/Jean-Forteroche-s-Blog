<?php $title = htmlspecialchars($post['title']); ?>

<?php ob_start(); ?>
	

	<p><a href="../public/index.php">Retour à la liste des chapitres</a></p>

	<div class="news">
		<h3>
			<?= htmlspecialchars($post['title']) ?><br />
			<em>publié le <?= $post['creation_date_fr'] ?></em>
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
			<p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?> <!--<button id="ReportedComment">Signaler</button>--></p>
            <!--<p id="ReportedCommentArea"></p>-->
			<p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <p>Numéro du commentaire <?= $comment['id'] ?></p>
            <p>Numéro du chapitre <?= $post['id'] ?></p>
            <!--<a href="../public/index.php?action=reportComment&id=<?= $comment['id'] ?>">Signaler</a>-->

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportComment<?= $comment['id']?>">
                Signaler un commentaire
            </button>

            <!-- Modal -->
            <div class="modal fade" id="reportComment<?= $comment['id']?>" tabindex="-1" role="dialog" aria-labelledby="reportComment<?= $comment['id']?>Label" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="reportComment<?= $comment['id']?>Label">
                                Signaler un commentaire
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>Êtes-vous sûr(e) de vouloir signaler ce commentaire ?</p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <a href="../public/index.php?action=reportComment&id=<?= $comment['id'] ?>">Signaler</a>
                        </div>

                    </div>
                </div>
            </div>

			<?php
		}
		?>
	<?php $content = ob_get_clean(); ?>

	<?php require('template.php'); ?>