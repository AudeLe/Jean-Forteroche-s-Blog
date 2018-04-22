<?php

    session_start();
    session_regenerate_id(true); // Change the session id on each log in
    if(isset($_SESSION['id']) && isset($_SESSION['login'])){
        $loginSession = $_SESSION['login'];
        echo 'Bonjour ' . $loginSession;
    }
?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
        <title><?= $title ?></title>

        <!-- Meta-tags -->
        <meta name="description" content="Blog de Jean Forteroche" />
        <meta name="keywords" content="Jean Forteroche, chapitres, nouveaux chapitres, commentaires" />
        <meta name="author" content="Aude Leissen">
        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="3 month">
        <meta name="language" content="French">

        <!-- Open Graph data -->
        <meta property="og:title" content="Blog de Jean Forteroche"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://audeleissen.com/BlogJeanForteroche"/>
        <meta property="og:image" content="../public/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg"/>
        <meta property="og:description" content="Blog de Jean Forteroche - Un billet simple pour l'Alaska"/>

        <!-- Twitter Card data-->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="http://audeleissen.com/BlogJeanForteroche">
        <meta name="twitter:title" content="Blog de Jean Forteroche">
        <meta name="twitter:description" content="Blog de Jean Forteroche - Un billet simple pour l'Alaska">
        <meta name="twitter:creator" content="@AudeL">
        <meta name="twitter:image" content="../public/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg">

        <!-- IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Devices -->
        <meta name="viewport" content = "width = device-width, initial-scale = 1">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
		<link rel="stylesheet" href="../public/css/style.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/repond.min.js"></script>
        <![endif]-->

	</head>

	<body>
        <header>

            <?php
            if(isset($_SESSION['id']) && isset($_SESSION['login'])){
                ?>
                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="../public/index.php">Retourner à la page d'accueil du site</a>
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
                                        <a href="../template/logOut.php">Déconnexion</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            <?php }
            else {
                ?>

                <ul class="nav justify-content-end">
                    <li class="nav-item">
                        <a href="../public/index.php">Retourner à la page d'accueil du site</a>
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

                <?php
            }
            ?>
        </header>


        <div id="banner">
            <img src="../public/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg" alt="Mount Hayes and the eastern Alaska Range mountains"/>

            <div id="bannerDescription">
                <h1>Billet simple pour l'Alaska</h1>
                <h2>par Jean Forteroche</h2>
            </div>

        </div>

        <div id="content">
            <?= $content ?>
        </div>


        <!-- JavaScript Files -->
        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <!-- TinyMCE -->
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
        <!--<script src = "js/moderation.js"></script>-->
        <!--<script src = "js/connection.js"></script>-->

        <!-- Fontawesome -->
        <script src="https://use.fontawesome.com/b88df9d43b.js"></script>

	</body>
</html>