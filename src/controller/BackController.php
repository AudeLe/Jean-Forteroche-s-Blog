<?php

    namespace Blog\src\controller;

    use Blog\src\DAO\ConnectionDAO;
    use Blog\src\Classes\View;

    class BackController{

        public function __construct(){

            $this->connectionManager = new ConnectionDAO();
        }

        public function getChaptersAndReportedComments(){

            $posts = $this->connectionManager->getChapters();
            $comments = $this->connectionManager->getReportedComments();


            $view = new View('adminView');
            $view->render([
                'posts' => $posts,
                'comments' => $comments
            ]);

        }

        // Registration on the website
        public function registration($login, $passwordVisitor, $passwordVisitorCheck){

            $this->connectionManager->registration($login, $passwordVisitor, $passwordVisitorCheck);

            $view = new View('registration');
            $view->render([]);
        }

        // Connection on the website
        public function connection($login, $passwordVisitor){

            $connectionDetails = $this->connectionManager->connection($login, $passwordVisitor);

        }


        public function logOut(){
            $this->connectionManager->logOut();

            $view = new View('logOut');
            $view->render([]);
        }

        public function checkInformations($checkLogin, $checkPassword){

            $visitorInformations = $this->connectionManager->checkInformations($checkLogin, $checkPassword);

            require('../template/editInformations.php');
        }

        public function editPassword($idVisitor, $editPassword, $editPasswordCheck){
            //$connectionManager = new \Openclassrooms\Blog\Model\ConnectionDAO();

            $this->connectionManager->editPassword($idVisitor, $editPassword, $editPasswordCheck);
        }

        public function editLogin($idVisitor, $editLogin){

            $this->connectionManager->editLogin($idVisitor, $editLogin);

        }

        public function deletionAccount($id){
            $this->connectionManager->logOut();
            $this->connectionManager->deletionAccount($id);
        }

    }