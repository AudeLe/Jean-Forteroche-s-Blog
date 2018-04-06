<?php

    require_once('../src/DAO/ConnectionDAO.php');

    // Registration on the website
    function registration($login, $passwordVisitor, $passwordVisitorCheck){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

        $connectionManager -> registration($login, $passwordVisitor, $passwordVisitorCheck);

        header('Location: ../public/index.php');
    }

    // Connection on the website
    function connection($login, $passwordVisitor){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

        $connectionManager -> connection($login, $passwordVisitor);

        //header('Location: ../public/index.php');
    }

    function checkInformations($checkLogin, $checkPassword){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

        $visitorInformations = $connectionManager -> checkInformations($checkLogin, $checkPassword);

        require('../template/editInformations.php');
    }

    function editInformations($idVisitor, $editLogin, $editPassword, $editPasswordCheck){
        $connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

        $connectionManager -> editInformations($idVisitor, $editLogin, $editPassword, $editPasswordCheck);
    }
