<?php $this->title = 'Page d\'administration'; ?>


<!-- Add a chapter -->
<h2>Ajout d'article</h2>
    <div class="container-fluid row" id="addChapter">

        <form action="../public/index.php?action=addPost" method="post" class=" col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div>
                <label for="title">Titre du chapitre</label><br />
                <input type="text" id="title" name="title">
            </div>
            <div>
                <label for="article">Nouveau chapitre</label><br />
                <textarea id="article" name="article" class="writtingChapter"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter cet article" class="submitButton">
            </div>
        </form>

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="myPosts-tab" data-toggle="tab" href="#myPosts" role="tab" aria-controls="myPosts" aria-selected="true">Mes chapitres</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reportedCommentsArea-tab" data-toggle="tab" href="#reportedCommentsArea" role="tab" aria-controls="reportedCommentsArea" aria-selected="false">Commentaires signalés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Compte</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="myComments-tab" data-toggle="tab" href="#myComments" role="tab" aria-controls="myComments" aria-selected="true">Mes commentaires</a>
                </li>
            </ul>
        </div>

        <!-- Display all the posts/chapters existing for the admin to edit and/or delete -->
        <div class="tab-content col-md-12" id="myTabContent">
            <div class="tab-pane fade show active" id="myPosts" role="tabpanel" aria-labelledby="myPosts-tab">
                <table class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tr class="listPostsAdmin">
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 postsAdmin">Titre du chapitre</th>
                        <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6 postsAdmin">Chapitre</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 postsAdmin">Date de publication</th>
                        <th class="col-lg-1 col-md-1 col-sm-2 col-xs-2 postsAdmin">Modifer l'article</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 postsAdmin">Supprimer l'article</th>
                    </tr>

                    <?php

                    foreach($posts as $post):
                        ?>
                        <tr class="listPostsAdmin">
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 postsAdmin"><?= $post->getTitle(); ?></td>
                            <td class="col-lg-6 col-md-6 col-sm-2 col-xs-2 postsAdmin">
                                <div class="postContent"><?= $post->getContent(); ?>
                                    <span class="ellipsis">&#133;</span>
                                    <span class="fill"></span>
                                </div>
                            </td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 postsAdmin"><?= $post->getCreationDate(); ?></td>
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 postsAdmin"><a href="../public/index.php?action=editPost&id=<?= $post->getId(); ?>"><i class="fas fa-edit"></i></a></td>
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 postsAdmin"><a href="../public/index.php?action=deletePost&id=<?= $post->getId(); ?>"><i class="fas fa-trash alt"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </table>


            </div>


            <!-- Display all the reported comments for the admin to moderate -->

            <div class="tab-pane fade col-lg-12 col-md-12 col-sm-12 col-xs-12" id="reportedCommentsArea" role="tabpanel" aria-labelledby="reportedCommentsArea-tab">
                <div class="row">
                    <table class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <tr class="reportedComments">
                            <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 reportedComment">Chapitre</th>
                            <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 reportedComment">Auteur</th>
                            <th class="col-lg-5 col-md-5 col-sm-5 col-xs-5 reportedComment">Commentaire</th>
                            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment">Date du commentaire</th>
                            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment">Ignorer le commentaire</th>
                            <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment">Supprimer le commentaire</th>
                        </tr>

                        <?php
                        foreach($reportedComments as $reportedComment):
                            ?>
                            <tr class="reportedComments">

                                <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 reportedComment"><?= $reportedComment->getPostId()->getTitle(); ?></td>
                                <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 reportedComment"><?= $reportedComment->getAuthor(); ?></td>
                                <td class="col-lg-5 col-md-5 col-sm-5 col-xs-5 reportedComment"><?= $reportedComment->getComment(); ?></td>
                                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment"><?= $reportedComment->getCommentDate(); ?></td>
                                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment"><a href="../public/index.php?action=ignoreReportedComment&id=<?= $reportedComment->getId(); ?>"><i class="fas fa-thumbs-up"></i></a></td>
                                <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 reportedComment"><a href="../public/index.php?action=deleteComment&id=<?= $reportedComment->getId(); ?>"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>

                        <?php endforeach; ?>
                    </table>
                </div>
            </div>


            <!-- Elements allowing to change the credentials of the account -->
            <div class="tab-pane fade col-lg-12 col-md-12 col-sm-12 col-xs-12" id="account" role="tabpanel" aria-labelledby="account-tab">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 changeCredentials">
                        <h4>Changer son pseudo ou son mot de passe</h4>
                        <p>Veuillez entrer vos identifiants actuels</p>
                        <form action="../public/index.php?action=checkInformations" method="post">
                            <div>
                                <label for="checkLogin">Pseudo</label><br />
                                <input type="text" id="checkLogin" name="checkLogin" value="<?= $_SESSION['login'] ?>" readonly/>
                            </div>
                            <div>
                                <label for="checkPassword">Mot de passe</label><br />
                                <input type="password" id="checkPassword" name="checkPassword" />
                            </div>
                            <div>
                                <input type="submit" value="Confirmer mes identifiants" class="submitButton" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Display all the member's comments -->
            <div class="tab-pane fade" id="myComments" role="tabpanel" aria-labelledby="myComments-tab">
                <div class="row">
                    <table class="col-md-12">
                        <tr class="listCommentsMember">
                            <th class="col-md-2 commentsMember">Chapitre</th>
                            <th class="col-md-6 commentsMember">Commentaire</th>
                            <th class="col-md-2 commentsMember">Date de publication</th>
                            <th class="col-md-1 commentsMember">Modifer le commentaire</th>
                            <th class="col-md-1 commentsMember">Supprimer le commentaire</th>
                        </tr>

                        <?php
                        foreach ($comments as $comment){
                            ?>
                            <tr class="listCommentsMember">
                                <td class="col-md-2 commentsMember"><?= $comment->getPostId()->getTitle(); ?></td>
                                <td class="col-md-6 commentsMember"><?= $comment->getComment(); ?></td>
                                <td class="col-md-2 commentsMember"><?= $comment->getCommentDate(); ?></td>
                                <td class="col-md-1 commentsMember"><a href="../public/index.php?action=editComment&id=<?= $comment->getId(); ?>"><i class="fas fa-edit"></i></a></td>
                                <td class="col-md-1 commentsMember"><a href="../public/index.php?action=deleteComment&id=<?= $comment->getId(); ?>"><i class="fas fa-trash alt"></i></a></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>

                </div>
            </div>

        </div>
    </div>