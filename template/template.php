<?php
    if(isset($_SESSION['id']) && isset($_SESSION['login'])){
        echo 'Bonjour ' . $_SESSION['login'];
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8"/>
		<title><?= $title ?></title>
		<link rel="stylesheet" href="../public/css/style.css" />
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

		<p><a href="../template/addPostView.php">Ajouter un nouvel article</a></p>

		<?= $content ?>

        <script src = "js/moderation.js"></script>
        <script src = "js/connection.js"></script>
	</body>
</html>