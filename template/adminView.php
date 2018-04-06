<?php $title = htmlspecialchars('Page d\'administration'); ?>

<?php ob_start(); ?>

    <h1>Page d'administration</h1>

    <button>Ajouter un nouvel article</button>
	<h2>Ajout d'article</h2>

	<form action="../public/index.php?action=addPost" method="post">
		<div>
			<label for="title">Titre</label><br />
			<input type="text" id="title" name="title">
		</div>
		<div>
			<label for="article">Article</label><br />
			<textarea id="article" name="article"></textarea>
		</div>
		<div>
			<input type="submit" value="Ajouter cet article">
		</div>
		
	</form>

    <h2>Changer son pseudo ou son mot de passe</h2>
    <p>Veuillez entrer vos identifiants actuels</p>
    <form action="../public/index.php?action=checkInformations" method="post">
        <div>
            <label for="checkLogin">Pseudo</label><br />
            <input type="text" id="checkLogin" name="checkLogin" />
        </div>
        <div>
            <label for="checkPassword">Mot de passe</label><br />
            <input type="password" id="checkPassword" name="checkPassword" />
        </div>
        <div>
            <input type="submit" value="Confirmer mes identifiants" />
        </div>
    </form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>