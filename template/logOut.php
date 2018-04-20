<?php header('refresh:5; url=../public/index.php'); ?>

<?php $title = htmlspecialchars('Déconnexion'); ?>

<?php ob_start(); ?>

    <p>Vous venez d'être déconnecté avec succès.</p>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<?php session_destroy(); ?>
