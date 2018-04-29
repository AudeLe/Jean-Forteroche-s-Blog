<?php

    namespace BlogJeanForteroche\config;

    use BlogJeanForteroche\src\controller\FrontController;
    use BlogJeanForteroche\src\controller\BackController;

    class Router {

        private $frontController;
        private $backController;

        /**
         * Router constructor.
         */
        public function __construct(){
            $this->frontController = new FrontController();

            $this->backController = new BackController();
        }

        /**
         *
         */
        public function requestRouter(){

            try{

                if(isset($_GET['action'])){
                    // Lists of chapters - Home page - Default action
                    if($_GET['action'] == 'listPosts'){
                        $this->frontController->listPosts();
                    }

                                /* ----- POST/CHAPTER ----- */

                    // Specific post displayed
                    elseif($_GET['action'] == 'post') {
                        if (isset($_GET['id']) && $_GET['id'] > 0) {
                            $this->frontController->post($_GET['id']);
                        } else {
                            throw new \Exception('Aucun identifiant de billet envoyé');
                        }
                    }

                    // Add a chapter
                    elseif($_GET['action'] == 'addPost'){
                        if(!empty($_POST['title']) && !empty($_POST['article'])){
                            $this->frontController->addPost($_POST['title'], $_POST['article']);
                        } else {
                            throw new \Exception('Tous les champs ne sont pas remplis afin de valider l\'article');
                        }
                    }

                    // Recovering of the post the admin want to edit
                    elseif($_GET['action'] == 'editPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editPost($_GET['id']);
                        } else{
                            throw new \Exception('Impossible de récupérer le post.');
                        }
                    }

                    // Recording of the modification done on the chapter into the database
                    elseif($_GET['action'] == 'editedPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editedPost($_GET['id'], $_POST['newTitle'], $_POST['newPost']);
                        } else {
                            throw new \Exception('Aucune modification effectuée sur le post.');
                        }
                    }

                    // Deletion of a post
                    elseif($_GET['action'] == 'deletePost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->deletePost($_GET['id']);
                        } else {
                            throw new \Exception('Impossible de supprimer ce post.');
                        }
                    }


                                /* ----- ADMIN PAGE ----- */

                    // Return all the chapters and all the reported comments on the admin page
                    elseif($_GET['action'] == 'getChaptersAndReportedComments'){
                        $this->backController->getChaptersAndReportedComments();
                    }


                                /* ----- MEMBER PAGE ----- */

                    // Return all the comments of a member when he/she is connected
                    elseif($_GET['action'] == 'getMemberComments'){
                        if(isset($_GET['login'])){
                            $this->frontController->getMemberComments($_GET['login']);
                        } else {
                            throw new \Exception('Veuillez vous connecter afin d\'accéder à vos commentaires.');
                        }
                    }


                                /* ----- COMMENT ----- */

                    // Add a comment
                    elseif($_GET['action'] == 'addComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0 && isset($_GET['memberId']) && $_GET['memberId'] > 0){
                            // Verify if the inputs are not empty
                            if(!empty($_POST['author']) && !empty($_POST['comment'])){
                                $this->frontController->addComment($_GET['id'], $_GET['memberId'], $_POST['author'], $_POST['comment']);
                            } else {
                                throw new \Exception('Tous les champs ne sont pas remplis !');
                            }
                        } else {
                            throw new \Exception('Aucun identifiant de billet envoyé.');
                        }
                    }

                    // Recovering of the comment we want to edit
                    elseif($_GET['action'] == 'editComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editComment($_GET['id']);
                        } else {
                            throw new \Exception('Impossible de récupérer le commentaire.');
                        }
                    }

                    // Modification on the database of the selected comment
                    elseif($_GET['action'] == 'editedComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            if(isset($_GET['memberLogin'])){
                                $this->frontController->editedComment($_GET['id'], $_GET['memberLogin'], $_POST['newComment']);
                            } else {
                                throw new \Exception('Impossible d\'identifier l\'auteur du commentaire.');
                            }
                        } else {
                            throw new \Exception('Aucune modification effectuée sur le commentaire');
                        }
                    }

                    // Deletion of a comment
                    elseif($_GET['action'] == 'deleteComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->deleteComment($_GET['id']);
                        } else {
                            throw new \Exception('Impossible de supprimer ce commentaire.');
                        }
                    }

                    // Report a comment
                    elseif($_GET['action'] == 'reportComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0 && ($_GET['postId'] && $_GET['postId'] > 0)){
                            $this->frontController->reportComment($_GET['id'], $_GET['postId']);
                        } else{
                            throw new \Exception('Impossible de signaler ce commentaire.');
                        }
                    }

                    // Ignore a reported comment
                    elseif($_GET['action'] == 'ignoreReportedComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->ignoreReportedComment($_GET['id']);
                        } else {
                            throw new \Exception('Impossible d\'ignorer le commentaire signalé.');
                        }
                    }


                                /* ----- CONNECTION RELATED ----- */

                    // Registration on the website
                    elseif($_GET['action'] == 'registration'){
                        if(!empty($_POST['login']) && !empty($_POST['passwordVisitor']) && !empty($_POST['passwordVisitorCheck'])){
                            $this->backController->registration($_POST['login'], $_POST['passwordVisitor'], $_POST['passwordVisitorCheck']);
                        } else {
                            throw new \Exception('Impossible d\'enregistrer les informations de la personne.');
                        }
                    }

                    // Connection on the website
                    elseif($_GET['action'] == 'connection'){
                        if(!empty($_POST['loginConnection']) && !empty($_POST['passwordVisitorConnection'])){
                            $this->backController->connection($_POST['loginConnection'], $_POST['passwordVisitorConnection']);
                        } else {
                            throw new \Exception('Impossible de vous identifier.');
                        }
                    }

                    // Log out of the website
                    elseif($_GET['action'] == 'logOut'){
                        $this->backController->logOut();
                    }

                    // Checking the person's credentials before allowing the person connected to change them
                    elseif($_GET['action'] == 'checkInformations'){
                        if(!empty($_POST['checkLogin']) && !empty($_POST['checkPassword'])){
                            $this->backController->checkInformations($_POST['checkLogin'], $_POST['checkPassword']);
                        } else {
                            throw new \Exception('Impossible de vous identifier afin de changer vos informations.');
                        }
                    }

                    // Change the password
                    elseif($_GET['action'] == 'editPassword'){
                        if(!empty($_POST['editPassword']) && !empty($_POST['editPasswordCheck'])){
                            $this->backController->editPassword($_POST['editPassword'], $_POST['editPasswordCheck']);
                        } else {
                            throw new \Exception('Vous n\'avez pas entré les bonnes informations.');
                        }
                    }

                    // CHange the login
                    elseif($_GET['action'] == 'editLogin'){
                        if(!empty($_POST['editLogin'])){
                            $this->backController->editLogin($_POST['editLogin']);
                        } else {
                            throw new \Exception('Impossible de modifier votre pseudonyme.');
                        }

                    }

                    // Deletion of the account
                    elseif($_GET['action'] == 'deletionAccount'){
                        if(isset($_GET['id']) && $_GET['id'] > 0 && !empty($_POST['checkLoginDelete']) && !empty($_POST['checkPasswordDelete'])){
                            $this->backController->deletionAccount($_GET['id'], $_POST['checkLoginDelete'], $_POST['checkPasswordDelete']);
                        } else {
                            throw new \Exception('Impossible de supprimer ce compte.');
                        }

                    }

                } else {
                    // Default action. Display all the chapters
                    $this->frontController->listPosts();
                }
            } catch(\Exception $e){
                echo 'Erreur : ' . $e->getMessage();
            }

        }
    }