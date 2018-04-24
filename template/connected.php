
    <ul class="nav justify-content-end">
        <li class="nav-item">
            <?php
                if($_SESSION['status'] == 'admin'){
                    ?>
                    <a href="../public/index.php?action=getChaptersAndReportedComments"><?= $_SESSION['login'] ?></a>
                <?php
                } else {
                    ?>
                    <a href="?action=getMemberComments&login=<?= $_SESSION['login'] ?>"><?= $_SESSION['login'] ?></a>
                <?php
                }

            ?>
        </li>

        <li class="nav-item">
            <a href="../public/index.php">Accueil du site</a>
        </li>

        <li>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#logOut">
                Déconnexion
            </button>

            <!-- Modal -->
            <div class="modal fade" id="logOut" tabindex="-1" role="dialog" aria-labelledby="logOutLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="logOutLabel">
                                Déconnexion
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <p>Êtes-vous sûr(e) de vouloir vous déconnecter ?</p>
                        </div>

                        <div class="modal-footer">
                            <a href="../public/index.php?action=logOut">Déconnexion</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </div>

                    </div>
                </div>
            </div>
        </li>
    </ul>
