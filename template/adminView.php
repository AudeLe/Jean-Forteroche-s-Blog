<?php $this->title = 'Page d\'administration'; ?>


    <h1>Page d'administration</h1>

    <!-- Add a chapter -->
    <div>
        <h2>Ajout d'article</h2>

        <form action="../public/index.php?action=addPost" method="post">
            <div>
                <label for="title">Titre du chapitre</label><br />
                <input type="text" id="title" name="title">
            </div>
            <div>
                <label for="article">Nouveau chapitre</label><br />
                <textarea id="article" name="article"></textarea>
            </div>
            <div>
                <input type="submit" value="Ajouter cet article">
            </div>

        </form>
    </div>


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
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="myPosts" role="tabpanel" aria-labelledby="myPosts-tab">
            <table>
                <tr>
                    <th>Titre du chapitre</th>
                    <th>Chapitre</th>
                    <th>Date de publication</th>
                    <th>Modifer l'article</th>
                    <th>Supprimer l'article</th>
                </tr>

                <?php

                foreach($posts as $post){
                    ?>
                    <tr>
                        <td><?= $post->getTitle(); ?></td>
                        <td><?= $post->getContent(); ?></td>
                        <td><?= $post->getCreationDate(); ?></td>
                        <td><a href="../public/index.php?action=editPost&id=<?= $post->getId(); ?>">Editer le post</a></td>
                        <td><a href="../public/index.php?action=deletePost&id=<?= $post->getId(); ?>">Supprimer le post</a></td>
                    </tr>
                <?php
                    }
                    ?>
            </table>

        </div>



        <div class="tab-pane fade" id="reportedCommentsArea" role="tabpanel" aria-labelledby="reportedCommentsArea-tab">
            <table>
                <tr>
                    <th>Numéro du chapitre</th>
                    <th>Auteur</th>
                    <th>Commentaire</th>
                    <th>Date du commentaire</th>
                    <th>Supprimer le commentaire</th>
                </tr>

                <?php
                foreach($comments as $comment){
                    ?>
                    <tr>

                        <td><?= $comment->getPostId(); ?></td>
                        <td><?= $comment->getAuthor(); ?></td>
                        <td><?= $comment->getComment(); ?></td>
                        <td><?= $comment->getCommentDate(); ?></td>
                        <td><a href="../public/index.php?action=deleteComment&id=<?= $comment->getId(); ?>">Supprimer le post</a></td>
                    </tr>
                <?php
                }
                ?>
            </table>

        </div>

        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
            <h3>Changer son pseudo ou son mot de passe</h3>
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
                    <input type="submit" value="Confirmer mes identifiants" />
                </div>
            </form>
        </div>

    </div>

