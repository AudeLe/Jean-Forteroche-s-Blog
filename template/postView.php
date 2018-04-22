<?php $this->title = "Chapitre - ".$post->getTitle(); ?>

<div>
    <h3><?= $post->getTitle(); ?></h3>
    <p><?= $post->getContent(); ?></p>
    <p>Créé le <?= $post->getCreationDate(); ?></p>
</div>

<a href="../public/index.php">Retour à l'accueil</a>
<div id="comments">
    <h4>Commentaires</h4>
    <?php
    foreach($comments as $comment){
        ?>
        <h5><?= $comment->getAuthor(); ?></h5>
        <p><?= $comment->getComment(); ?></p>
        <p>Posté le <?= $comment->getCommentDate(); ?></p>

    <?php
    }
    ?>
</div>