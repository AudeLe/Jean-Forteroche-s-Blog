<?php $this->title = 'Page de profil'; ?>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="myComments-tab" data-toggle="tab" href="#myComments" role="tab" aria-controls="myComments" aria-selected="true">Mes commentaires</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="account-tab" data-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="false">Compte</a>
                </li>
            </ul>
        </div>
    </div>


    <!-- Display all the member's comments -->
    <div class="tab-content col-lg-12 col-md-12 col-sm-12 col-xs-12" id="myTabContent">
        <div class="tab-pane fade show active" id="myComments" role="tabpanel" aria-labelledby="myComments-tab">
            <div class="row">
                <table class="table-responsive col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <tr class="listCommentsMember">
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 commentsMember">Chapitre</th>
                        <th class="col-lg-6 col-md-6 col-sm-6 col-xs-6 commentsMember">Commentaire</th>
                        <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2 commentsMember">Date de publication</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 commentsMember">Modifer le commentaire</th>
                        <th class="col-lg-1 col-md-1 col-sm-1 col-xs-1 commentsMember">Supprimer le commentaire</th>
                    </tr>

                    <?php
                    foreach ($comments as $comment){
                        ?>
                        <tr class="listCommentsMember">
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 commentsMember"><?= $comment->getPostId()->getTitle(); ?></td>
                            <td class="col-lg-6 col-md-6 col-sm-6 col-xs-6 commentsMember"><?= $comment->getComment(); ?></td>
                            <td class="col-lg-2 col-md-2 col-sm-2 col-xs-2 commentsMember"><?= $comment->getCommentDate(); ?></td>
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 commentsMember"><a href="../public/index.php?action=editComment&id=<?= $comment->getId(); ?>"><i class="fas fa-edit"></i></a></td>
                            <td class="col-lg-1 col-md-1 col-sm-1 col-xs-1 commentsMember"><a href="../public/index.php?action=deleteComment&id=<?= $comment->getId(); ?>"><i class="fas fa-trash alt"></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>

            </div>
        </div>

            <!-- Allow the member to change his/her credentials and/or to delete his/her account -->
            <div class="tab-pane fade col-lg-12 col-md-12 col-sm-12 col-xs-12" id="account" role="tabpanel" aria-labelledby="account-tab">
                <h3>Gestion de compte</h3>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 changeCredentials">
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

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="deletionAccount">
                        <h4>Suppression de compte</h4>
                        <p>Veuillez entrer vos identifiants afin de confirmer la suppression de votre compte.</p>

                        <form action="../public/index.php?action=deletionAccount&id=<?= $_SESSION['id'] ?>" method="post">
                            <div>
                                <label for="checkLogin">Pseudo</label><br />
                                <input type="text" id="checkLogin" name="checkLogin" value="<?= $_SESSION['login'] ?>" readonly/>
                            </div>
                            <div>
                                <label for="checkPassword">Mot de passe</label><br />
                                <input type="password" id="checkPassword" name="checkPassword" />
                            </div>
                            <div>
                                <input type="submit" value="Supprimer mon compte" class="submitButton" />
                            </div>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
