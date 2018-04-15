<?php
    session_start();
    if(isset($_SESSION['id']) && isset($_SESSION['login'])){
        $loginSession = $_SESSION['login'];
        echo 'Bonjour ' . $loginSession . ' de la page membre.';
    }
?>

<?php $title = htmlspecialchars('Page d\'administration'); ?>

<?php ob_start(); ?>

    <h1>Page d'administration</h1>

    <a href="../public/index.php">Retourner à la page d'accueil du site</a>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="myPosts-tab" data-toggle="tab" href="../public/index.php?action=getPosts" role="tab" aria-controls="myPosts" aria-selected="true">Mes chapitres</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="addAPost-tab" data-toggle="tab" href="#addAPost" role="tab" aria-controls="addAPost" aria-selected="true">Ajouter un chapitre</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="reportedCommentsArea-tab" data-toggle="tab" href="../public/index.php?action=getReportedComments" role="tab" aria-controls="reportedCommentsArea" aria-selected="false">Commentaires signalés</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Compte</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="myPosts" role="tabpanel" aria-labelledby="myPosts-tab">
            <!--<a href="../public/index.php?action=getPosts">Afficher les chapitres</a>-->

            <table>
                <tr>
                    <th>Titre du chapitre</th>
                    <th>Chapitre</th>
                    <th>Date de publication</th>
                    <th>Modifer l'article</th>
                    <th>Supprimer l'article</th>
                </tr>

                <?php
                while($data = $postsAdmin->fetch()){
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($data['title']) ?></td>
                        <td><?= nl2br(htmlspecialchars($data['content'])) ?></td>
                        <td><?= $data['creation_date_fr'] ?></td>
                        <td><a href="../public/index.php?action=editPost&id=<?= $data['id'] ?>">Editer le post</a></td>
                        <td><a href="../public/index.php?action=deletePost&id=<?= $data['id'] ?>">Supprimer le post</a></td>
                    </tr>
                    <?php
                }
                $postsAdmin->closeCursor();
                ?>
            </table>

        </div>

        <div class="tab-pane fade" id="addAPost" role="tabpanel" aria-labelledby="addAPost-tab">
            <h3>Ajout d'article</h3>

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
        </div>

        <div class="tab-pane fade" id="reportedCommentsArea" role="tabpanel" aria-labelledby="reportedCommentsArea-tab">
            <p>Commentaires signalés</p>
            <a href="../public/index.php?action=getReportedComments">Récupérer les commentaires signalés</a>

            <table>
                <tr>
                    <th>Numéro du chapitre</th>
                    <th>Auteur</th>
                    <th>Commentaire</th>
                    <th>Date du commentaire</th>
                    <th>Supprimer le commentaire</th>
                </tr>

                <?php
                while($reportedComment = $reportedVisitorComments->fetch()){
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($reportedComment['id']) ?></td>
                        <td><?= htmlspecialchars($reportedComment['post_id']) ?></td>
                        <td><?= nl2br(htmlspecialchars($reportedComment['author'])) ?></td>
                        <td><?= nl2br(htmlspecialchars($reportedComment['comment'])) ?></td>
                        <td><?= $reportedComment['comment_date_fr'] ?></td>
                        <td><a href="../public/index.php?action=deleteComment&id=<?= $reportedComment['id'] ?>">Supprimer le post</a></td>
                    </tr>
                    <?php
                }
                $reportedVisitorComments->closeCursor();
                ?>
            </table>

        </div>

        <div class="tab-pane fade" id="account" role="tabpanel" aria-labelledby="account-tab">
            <h3>Changer son pseudo ou son mot de passe</h3>
            <p>Veuillez entrer vos identifiants actuels</p>
            <form action="../public/index.php?action=checkInformations" method="post">
                <div>
                    <label for="checkLogin">Pseudo</label><br />
                    <input type="text" id="checkLogin" name="checkLogin" />
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


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>