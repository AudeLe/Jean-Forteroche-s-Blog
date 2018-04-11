<?php

    session_start();
    session_regenerate_id(true); // Change the session id on each log in
    if(isset($_SESSION['id']) && isset($_SESSION['login'])){
        echo 'Bonjour ' . $_SESSION['login'];
    }
?>

<!DOCTYPE html>
<html>
	<head>
        <title><?= $title ?></title>
		<meta charset = "utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content = "width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../public/css/bootstrap-3.3.7-dist/css/bootstrap.css" />
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

        <script src = "js/moderation.js"></script>
        <script src = "js/connection.js"></script>
	</body>
</html>