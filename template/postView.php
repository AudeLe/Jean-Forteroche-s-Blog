<?php $this->title = 'Chapitre - '.$post->getTitle(); ?>

<h2><?= $post->getTitle(); ?></h2>

<em class="date">Créé le <?= $post->getCreationDate(); ?></em>
<div class="row">
    <div class="col-md-10">
        <div class="post">
            <?php $postIdActivated = $post->getId(); ?>

            <p><?= $post->getContent(); ?></p>
        </div>

        <form action="../public/index.php?action=addComment&id=<?= $post->getId(); ?>&memberId=<?= $_SESSION['id']; ?>" method="post">
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
                <input type="submit" class="submitButton"/>
            </div>
        </form>
    </div>

    <div class="col-md-2" id="listPostsInsert">
        <?php
        foreach($posts as $post):
        ?>
        <p>
            <?php
            if($postIdActivated == $post->getId()){
                ?>
                <a><?= $post->getTitle(); ?></a>
                <?php
            } else {
                ?>
                <a href="../public/index.php?action=post&id=<?= $post->getId(); ?>"><?= $post->getTitle(); ?></a>
                <?php
            }
            ?>
        </p>
        <?php endforeach; ?>
    </div>
</div>


<h4>Commentaires</h4>
<!--<div class="container-fluid row" id="comments">-->
    <?php
    foreach($comments[0] as $comment):
        ?>
        <div class="row comment">
            <div class="col-md-11">
                <h5><?= $comment->getAuthor(); ?></h5>
                <p><?= $comment->getComment(); ?></p>
                <p>Posté le <?= $comment->getCommentDate(); ?></p>
            </div>

            <div class=" reportButton col-md-1">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reportComment<?= $comment->getId(); ?>">Signaler</button>

                <!-- Modal -->
                <div class="modal fade" id="reportComment<?= $comment->getId(); ?>" tabindex="1" role="dialog" aria-labelledby="reportComment<?= $comment->getId(); ?>Label" aria-hidden="true">
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
            </div>
        </div>
    <?php endforeach;?>
<!--</div>-->

<div class="pages">
    <?php foreach($comments[1] as $page): ?>
        <span><?= $page ?></span>
    <?php endforeach; ?>
</div>





