<?php $title = htmlspecialchars('Modification d\'identifiant'); ?>

<?php ob_start(); ?>

<?php
    $idVisitor = $visitorInformations['id'];
?>

<h3>Changer son pseudo ou son mot de passe</h3>

<p>Changer son pseudonyme</p>
<form action="../public/index.php?action=editLogin" method="post">
    <div>
        <input type="text" id="idVisitor" name="idVisitor" value="<?= $idVisitor ?>" />
    </div>
    <div>
        <label for="editLogin">Nouveau pseudonyme</label><br />
        <input type="text" id="editLogin" name="editLogin" />
    </div>
    <div>
        <input type="submit" value="Modifier mon pseudo" />
    </div>
</form>

<p>Changer son mot de passe</p>
<p>Veuillez entrer votre nouveau mot de passe</p>
<form action="../public/index.php?action=editPassword" method="post">

    <div>
        <input type="text" id="idVisitor" name="idVisitor" value="<?= $idVisitor ?>" />
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
