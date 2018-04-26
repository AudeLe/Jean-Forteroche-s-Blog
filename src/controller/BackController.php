<?php

    namespace Blog\src\controller;

    use Blog\src\DAO\ConnectionDAO;
    use Blog\src\Classes\View;

    class BackController{

        /**
         * BackController constructor.
         */
        public function __construct(){
            $this->connectionManager = new ConnectionDAO();
        }

        /**
         *
         */
        // Recover all the chapters and all the reported comments to display them on the admin page
        public function getChaptersAndReportedComments(){
            $posts = $this->connectionManager->getChapters();
            $comments = $this->connectionManager->getReportedComments();


            $view = new View('adminView');
            $view->render([
                'posts' => $posts,
                'comments' => $comments
            ]);

        }

        /**
         * @param $login
         * @param $passwordVisitor
         * @param $passwordVisitorCheck
         */
        // Registration on the website
        public function registration($login, $passwordVisitor, $passwordVisitorCheck){

            $this->connectionManager->registration($login, $passwordVisitor, $passwordVisitorCheck);

            $view = new View('registration');
            $view->render([]);
        }

        /**
         * @param $login
         * @param $passwordVisitor
         */
        // Connection on the website
        public function connection($login, $passwordVisitor){

            $connectionDetails = $this->connectionManager->connection($login, $passwordVisitor);

        }


        /**
         *
         */
        // Log out the website
        public function logOut(){
            $this->connectionManager->logOut();

            $view = new View('logOut');
            $view->render([]);
        }

        /**
         * @param $checkLogin
         * @param $checkPassword
         */
        // Verify the person's credentials before allowing him/her to change them
        public function checkInformations($checkLogin, $checkPassword){

            $visitorInformations = $this->connectionManager->checkInformations($checkLogin, $checkPassword);

            require('../template/editInformations.php');
        }

        /**
         * @param $idVisitor
         * @param $editPassword
         * @param $editPasswordCheck
         */
        // Change the person's password
        public function editPassword($idVisitor, $editPassword, $editPasswordCheck){

            $this->connectionManager->editPassword($idVisitor, $editPassword, $editPasswordCheck);
        }

        /**
         * @param $idVisitor
         * @param $editLogin
         */
        // Change the person's login
        public function editLogin($idVisitor, $editLogin){

            $this->connectionManager->editLogin($idVisitor, $editLogin);

        }

        /**
         * @param $id
         */
        // Allow the person's to delete their account
        public function deletionAccount($id){
            $this->connectionManager->logOut();
            $this->connectionManager->deletionAccount($id);
        }

    }