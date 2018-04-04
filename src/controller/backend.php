<?php

    require_once('../src/DAO/ConnectionManager.php');

    // Registration on the website
    function registration($login, $passwordVisitor){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionManager();

        $connectionManager -> registration($login, $passwordVisitor);

        header('Location: ../public/index.php');
    }

    // Connection on the website
    function connection($login, $passwordVisitor){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionManager();

        $connectionManager -> connection($login, $passwordVisitor);

        header('Location: ../public/index.php');
    }
    