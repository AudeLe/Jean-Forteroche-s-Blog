<?php

    //session_start();
    //session_regenerate_id(true); // Change the session id on each log in
    /*if(isset($_SESSION['id']) && isset($_SESSION['login'])){
        $loginSession = $_SESSION['login'];
        echo 'Bonjour ' . $loginSession;
    }*/
?>


<!DOCTYPE html>
<html>
	<head>
        <title><?= $title ?></title>
		<meta charset = "utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content = "width=device-width, initial-scale=1">

        <!--<link rel="stylesheet" href="../public/css/bootstrap-4.1.0/dist/css/bootstrap.css" />-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

		<link rel="stylesheet" href="../public/css/style.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/repond.min.js"></script>
        <![endif]-->

        <!-- Ajouter les meta-tags -->
	</head>

	<body>


        <button id ="registration">Inscription</button>
        <form action = "../public/index.php?action=registration" id="registrationForm" method="post">
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

        <button id ="connection">Connexion</button>
        <form action = "../public/index.php?action=connection" id="connectionForm" method="post">
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

        <a href="../template/logOut.php">Déconnexion</a>

		<?= $content ?>

        <!--<script src = "css/bootstrap-4.1.0/dist/js/bootstrap.js"></script>-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <script src = "js/moderation.js"></script>
        <script src = "js/connection.js"></script>
	</body>
</html>