<?php $title = htmlspecialchars('Déconnexion'); ?>

<?php ob_start(); ?>

    <p>Vous venez d'être déconnecté avec succès.</p>

    <a href="../public/index.php">Retourner sur la page d'accueil du site</a>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<?php session_destroy(); ?>
