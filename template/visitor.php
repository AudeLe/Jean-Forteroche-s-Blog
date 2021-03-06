    <!-- Header with a nav bar displayed if the visitor is NOT connected -->
    <ul class="navbar-nav mr-auto">
        <!-- Opens the form to register yourself on the website -->
        <li class="nav-item">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registration">
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
                                    <input type="submit" value="S'inscrire" class="submitButton"/>
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

        <!-- Opens the form to connect on the website -->
        <li class="nav-item">
            <!-- Button trigger modal-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#connection">
                <i class="fas fa-sign-in-alt"></i>Connexion
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
                                    <label for="loginConnection">Identifiant</label><br />
                                    <input type="text" id="loginConnection" name="loginConnection"/>
                                </div>
                                <div>
                                    <label for="passwordVisitorConnection">Mot de passe</label><br />
                                    <input type="password" id="passwordVisitorConnection" name="passwordVisitorConnection"/>
                                </div>
                                <div>
                                    <input type="submit" value="Se connecter" class="submitButton"/>
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

        <!-- Link to the home page, we all the posts/chapters are displayed -->
        <li class="nav-item">
            <a class="nav-link" href="../public/index.php"><i class="fas fa-home"></i>Accueil du site</a>
        </li>
    </ul>