<?php $title = htmlspecialchars('Page de profil'); ?>

<?php ob_start(); ?>

    <h1>Page de profil</h1>


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