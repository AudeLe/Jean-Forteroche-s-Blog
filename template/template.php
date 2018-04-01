<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8"/>
		<title><?= $title ?></title>
		<link rel="stylesheet" href="../public/css/style.css" />
	</head>

	<body>


        <button id ="connection">Connexion</button>
        <form action = "../public/index.php?action=connection" id="connectionForm">
            <div>
                <label for="login">Identifiant</label><br />
                <input type="text" id="login" name="login"/>
            </div>
            <div>
                <label for="password">Mot de passe</label><br />
                <input type="password" id="password" name="password"/>
            </div>
            <div>
                <input type="submit" value="S'inscrire"/>
            </div>
        </form>
		<p><a href="../template/addPostView.php">Ajouter un nouvel article</a></p>

		<?= $content ?>

        <script src = "js/moderation.js"></script>
        <script src = "js/connection.js"></script>
	</body>
</html>