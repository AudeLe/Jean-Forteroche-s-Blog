<?php $title = htmlspecialchars('Modification d\'identifiant'); ?>

<?php ob_start(); ?>

<?php
    $idVisitor = $visitorInformations['id'];
?>

<h2>Changer son pseudo ou son mot de passe</h2>
<p>Veuillez entrer votre nouveau mot de passe</p>
<form action="../public/index.php?action=editInformations" method="post">
    <!--<div>
        <label for="checkLogin">Pseudo</label><br />
        <input type="text" id="checkLogin" name="checkLogin" />
    </div>-->
    <div>
        <input type="text" id="idVisitor" name="idVisitor" value="<?= $idVisitor ?>" />
    </div>
    <div>
        <label for="editLogin">Nouveau pseudonyme</label><br />
        <input type="text" id="editLogin" name="editLogin" />
    </div>
    <div>
        <label for="editPassword">Mot de passe</label><br />
        <input type="password" id="editPassword" name="editPassword" />
    </div>
    <div>
        <label for="editPasswordCheck">Veuillez entrer de nouveau votre mot de passe</label><br />
        <input type="password" id="editPasswordCheck" name="editPasswordCheck" />
    </div>
    <div>
        <input type="submit" value="Modifier mon mot de passe" />
    </div>
</form>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
