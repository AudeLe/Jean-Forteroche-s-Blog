<?php

    namespace Blog\src\controller;

    use Blog\src\DAO\ConnectionDAO;

    //require_once('../src/DAO/ConnectionDAO.php');

    class BackController{

        public function __construct(){

            $this->connectionManager = new ConnectionDAO();
        }

        public function getPosts(){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();
            $postsAdmin = $this->connectionManager->getPosts();
            $reportedVisitorComments = $this->connectionManager->getReportedComments();

            require('../template/adminView.php');
        }

        public function getComments($loginSession){
            //$getCommentsManager = new \Openclassrooms\Blog\Model\ConnectionDAO();
            $memberComments = $this->connectionManager->getMemberComments($loginSession);

            require('../template/memberView.php');
        }

        // Registration on the website
        public function registration($login, $passwordVisitor, $passwordVisitorCheck){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $this->connectionManager->registration($login, $passwordVisitor, $passwordVisitorCheck);

            header('Location: ../public/index.php');
        }

        // Connection on the website
        public function connection($login, $passwordVisitor){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $connectionDetails = $this->connectionManager->connection($login, $passwordVisitor);
            $memberComments = $this->connectionManager->getMemberComments($login);
            //header('Location: ../public/index.php');
        }

        public function checkInformations($checkLogin, $checkPassword){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $visitorInformations = $this->connectionManager->checkInformations($checkLogin, $checkPassword);

            require('../template/editInformations.php');
        }

        public function editInformations($idVisitor, $editLogin, $editPassword, $editPasswordCheck){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $this->connectionManager->editInformations($idVisitor, $editLogin, $editPassword, $editPasswordCheck);
        }

        public function reportComment($idComment){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $reportedComment = $this->connectionManager->reportComment($idComment);

            //require('../template/adminView.php');
        }

        public function getReportedComments(){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();
            $reportedVisitorComments = $this->connectionManager->getReportedComments();

            require('../template/adminView.php');
        }

    }