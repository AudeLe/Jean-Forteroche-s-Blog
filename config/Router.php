<?php

    namespace Blog\config;



    //require('../src/controller/FrontController.php');
    //require('../src/controller/BackController.php');

    use Blog\src\controller\FrontController;
    use Blog\src\controller\BackController;

    //use Openclassrooms\Blog\Model\FrontController;
    //use Openclassrooms\Blog\Model\BackController;

    class Router {

        private $frontController;
        private $backController;

        public function __construct(){
            $this->frontController = new FrontController();

            $this->backController = new BackController();
        }

        /*public function __construct(){
            $this->backController = new \BackController();
        }*/

        public function requestRouter(){

            try{
                if(isset($_GET['action'])){
                    if($_GET['action'] == 'listPosts'){
                        $this->frontController->listPosts();
                    }

                    elseif($_GET['action'] == 'post'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->post($_GET['id']);
                        } else {
                            throw new Exception('Aucun identifiant de billet envoyé');
                        }
                    }

                    elseif($_GET['action'] == 'getChaptersAndReportedComments'){
                        $this->backController->getChaptersAndReportedComments();
                    }

                    elseif($_GET['action'] == 'getMemberComments'){
                        if(isset($_GET['login'])){
                            $this->frontController->getMemberComments($_GET['login']);
                        } else {
                            throw new Exception('Veuillez vous connecter afin d\'accéder à vos commentaires.');
                        }
                    }

                    // Ajout d'un article
                    elseif($_GET['action'] == 'addPost'){
                        if(!empty($_POST['title']) && !empty($_POST['article'])){
                            $this->frontController->addPost($_POST['title'], $_POST['article']);
                        } else {
                            throw new Exception('Tous les champs ne sont pas remplis afin de valider l\'article');
                        }
                    }

                    elseif($_GET['action'] == 'addComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            if(!empty($_POST['author']) && !empty($_POST['comment'])){
                                $this->frontController->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                            } else {
                                throw new Exception('Tous les champs ne sont pas remplis !');
                            }
                        } else {
                            throw new Exception('Aucun identifiant de billet envoyé.');
                        }
                    }

                    elseif($_GET['action'] == 'editComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editComment($_GET['id']);
                        } else {
                            throw new Exception('Impossible de récupérer le commentaire.');
                        }
                    }

                    elseif($_GET['action'] == 'editedComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editedComment($_GET['id'], $_POST['newComment']);
                        } else {
                            throw new Exception('Aucune modification effectuée sur le commentaire');
                        }
                    }

                    elseif($_GET['action'] == 'deleteComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->deleteComment($_GET['id']);
                        } else {
                            throw new Exception('Impossible de supprimer ce commentaire.');
                        }
                    }

                    elseif($_GET['action'] == 'reportComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0 && ($_GET['postId'] && $_GET['postId'] > 0)){
                            $this->frontController->reportComment($_GET['id'], $_GET['postId']);
                        } else{
                            throw new Exception('Impossible de signaler ce commentaire.');
                        }
                    }

                    elseif($_GET['action'] == 'editPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editPost($_GET['id']);
                        } else{
                            throw new Exception('Impossible de récupérer le post.');
                        }
                    }

                    elseif($_GET['action'] == 'editedPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->editedPost($_GET['id'], $_POST['newTitle'], $_POST['newPost']);
                        } else {
                            throw new Exception('Aucune modification effectuée sur le post.');
                        }
                    }

                    elseif($_GET['action'] == 'deletePost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            $this->frontController->deletePost($_GET['id']);
                        } else {
                            throw new Exception('Impossible de supprimer ce post.');
                        }
                    }

                    // Registration on the website
                    elseif($_GET['action'] == 'registration'){
                        if(!empty($_POST['login']) && !empty($_POST['passwordVisitor']) && !empty($_POST['passwordVisitorCheck'])){
                            $this->backController->registration($_POST['login'], $_POST['passwordVisitor'], $_POST['passwordVisitorCheck']);
                        } else {
                            throw new Exception('Impossible d\'enregistrer les informations de la personne.');
                        }
                    }

                    // Connection on the website
                    elseif($_GET['action'] == 'connection'){
                        if(!empty($_POST['login']) && !empty($_POST['passwordVisitor'])){
                            $this->backController->connection($_POST['login'], $_POST['passwordVisitor']);
                        } else {
                            throw new Exception('Impossible de vous identifier.');
                        }
                    }

                    /*elseif($_GET['action'] == 'getLogin'){
                        $this->backController->getLogin();
                    }*/

                    elseif($_GET['action'] == 'logOut'){
                        $this->backController->logOut();
                    }

                    elseif($_GET['action'] == 'checkInformations'){
                        if(!empty($_POST['checkLogin']) && !empty($_POST['checkPassword'])){
                            $this->backController->checkInformations($_POST['checkLogin'], $_POST['checkPassword']);
                        } else {
                            throw new Exception('Impossible de vous identifier afin de changer vos informations.');
                        }
                    }

                    elseif($_GET['action'] == 'editPassword'){
                        if(!empty($_POST['idVisitor']) && !empty($_POST['editPassword']) && !empty($_POST['editPasswordCheck'])){
                            $this->backController->editPassword($_POST['idVisitor'], $_POST['editPassword'], $_POST['editPasswordCheck']);
                        } else {
                            throw new Exception('Vous n\'avez pas entré les bonnes informations.');
                        }
                    }

                    elseif($_GET['action'] == 'editLogin'){
                        if(!empty($_POST['idVisitor']) && !empty($_POST['editLogin'])){
                            $this->backController->editLogin($_POST['idVisitor'], $_POST['editLogin']);
                        } else {
                            throw new Exception('Le pseudo que vous souhaitez utiliser est déjà pris.');
                        }
                    }

                } else {
                    $this->frontController->listPosts();
                }
            } catch(Exception $e){
                echo 'Erreur : ' . $e->getMessage();
            }

        }
    }