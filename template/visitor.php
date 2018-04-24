    <ul class="nav justify-content-end">
        <li class="nav-item">
            <a href="../public/index.php">Accueil du site</a>
        </li>


        <li class="nav-item">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registration"> <!--id ="registration"-->
                Inscription
            </button>

            <!-- Modal -->
            <div class="modal fade" id="registration" tabindex="-1" role="dialog" aria-labelledby="registrationLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="registrationLabel">Formulaire d'inscription</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action = "../public/index.php?controller=backend&action=registration" id="registrationForm" method="post">
                                <div>
                                    <label for="login">Identifiant</label><br />
                                    <input type="text" id="login" name="login"/>
                                </div>
                                <div>
                                    <label for="passwordVisitor">Mot de passe</label><br />
                                    <input type="password" id="passwordVisitor" name="passwordVisitor"/>
                                </div>
                                <div>
                                    <label for="passwordVisitorCheck">Veuillez saisir à nouveau votre mot de passe</label><br />
                                    <input type="password" id="passwordVisitorCheck" name="passwordVisitorCheck"/>
                                </div>
                                <div>
                                    <input type="submit" value="S'inscrire"/>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <li>
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connection"> <!--id ="connection"-->
                Connexion
            </button>

            <!-- Modal -->
            <div class="modal fade" id="connection" tabindex="-1" role="dialog" aria-labelledby="connectionLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="connectionLabel">Connexion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="modal-body">
                            <form action = "../public/index.php?controller=backend&action=connection" id="connectionForm" method="post">
                                <div>
                                    <label for="login">Identifiant</label><br />
                                    <input type="text" id="login" name="login"/>
                                </div>
                                <div>
                                    <label for="passwordVisitor">Mot de passe</label><br />
                                    <input type="password" id="passwordVisitor" name="passwordVisitor"/>
                                </div>
                                <div>
                                    <input type="submit" value="Se connecter"/>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
