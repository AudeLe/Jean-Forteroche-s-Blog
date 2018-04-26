<?php $this->title = htmlspecialchars('Page de profil'); ?>


    <h1>Page de profil</h1>

    <a href="../public/index.php">Retourner à la page d'accueil du site</a>


    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="myComments-tab" data-toggle="tab" href="#myComments" role="tab" aria-controls="myComments" aria-selected="true">Mes commentaires</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Compte</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="myComments" role="tabpanel" aria-labelledby="myComments-tab">
            

            <table>
                <tr>
                    <th>Numéro du post</th>
                    <th>Commentaire</th>
                    <th>Date de publication</th>
                    <th>Modifer le commentaire</th>
                    <th>Supprimer le commentaire</th>
                </tr>

                <?php
                foreach ($comments as $comment){
                    ?>
                <tr>
                    <td><?= $comment->getPostId()->getTitle(); ?></td>
                    <td><?= $comment->getComment(); ?></td>
                    <td><?= $comment->getCommentDate(); ?></td>
                    <td><a href="../public/index.php?action=editComment&id=<?= $comment->getId(); ?>">Modifier le commentaire</a></td>
                    <td><a href="../public/index.php?action=deleteComment&id=<?= $comment->getId(); ?>">Supprimer le commentaire</a></td>
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

            <!-- BUtton trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target =#deletionAccount>Supprimer mon compte</button>

            <!-- Modal -->
            <div class="modal fade" id="deletionAccount" tabindex="-1" role="dialog" aria-labelledby="deletionAccountLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="deletionAccountLabel">Suppression de compte</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>Êtes-vous sûr(e) de vouloir supprimer votre compte ?</p>
                            <p>Cette action est irréversible.</p>
                        </div>

                        <div class="modal-footer">
                            <a href="../public/index.php?action=deletionAccount&id=<?= $_SESSION['id'] ?>">Supprimer mon compte</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>