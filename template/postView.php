<?php $this->title = "Chapitre - ".$post->getTitle(); ?>

<div>
    <?php $postIdActivated = $post->getId(); ?>
    <h3><?= $post->getTitle(); ?></h3>
    <p><?= $post->getContent(); ?></p>
    <p>Créé le <?= $post->getCreationDate(); ?></p>
</div>

<form action="../public/index.php?action=addComment&id=<?= $post->getId(); ?>" method="post">
    <div>
        <label for="author">Pseudo</label>
        <?php
            if(!isset($_SESSION['id'])){
                ?>
                <input type="text" id="author" name="author"/>
            <?php
            } else {
                ?>
                <input type="text" id="author" name="author" value="<?= $_SESSION['login'] ?>" readonly/>

            <?php
            }

        ?>
    </div>
    <div>
        <label for="comment">Commentaire</label>
        <textarea id="comment" name="comment"></textarea>
    </div>
    <div>
        <input type="submit"/>
    </div>
</form>

<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments">
    <h4>Commentaires</h4>
    <?php
    foreach($comments as $comment):
        ?>
        <h5><?= $comment->getAuthor(); ?></h5>
        <p><?= $comment->getId(); ?></p>
        <p><?= $comment->getComment(); ?></p>
        <p>Posté le <?= $comment->getCommentDate(); ?></p>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportComment<?= $comment->getId(); ?>">Signaler</button>
    
        <!-- Modal -->
        <div class="modal fade" id="reportComment<?=$comment->getId(); ?>" tabindex="1" role="dialog" aria-labelledby="reportComment<?=$comment->getId(); ?>Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportComment<?= $comment->getId(); ?>Label">
                            Signaler un commentaire
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p>Êtes-vous sûr(e) de vouloir signaler ce commentaire ?</p>
                        <a href="../public/index.php?action=reportComment&id=<?= $comment->getId(); ?>&postId=<?= $comment->getPostId();?>">Signaler</a>
                    </div>

                    <div class="modal-footer"
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>

                    </div>
                </div>
            </div>
        </div>

    <?php endforeach;?>
</div>


<?php

    foreach($posts as $post):
        ?>
        <div class="news">
        <?php
        if( $postIdActivated == $post->getId()){
            ?>
                <h3><?= $post->getTitle(); ?></h3>

            <?php
        } else {
            ?>
                <h3><a href="../public/index.php?action=post&id=<?= $post->getId(); ?>"><?= $post->getTitle(); ?></a></h3>
            <?php
        }
        ?>
        </div>
    <?php endforeach; ?>


