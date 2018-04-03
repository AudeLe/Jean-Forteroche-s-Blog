<?php
    require('../config/dev.php');
	require('../src/controller/frontend.php');
	require('../src/controller/backend.php');
	//require('../config/Autoloader.php');
	// \Openclassrooms\Blog\config\Autoloader::register();

	//class Router {

	   // public function start(){

            try{
                if(isset($_GET['action'])){
                    if($_GET['action'] == 'listPosts'){
                        listPosts();
                    }

                    elseif($_GET['action'] == 'post'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            post();
                        } else {
                            throw new Exception('Aucun identifiant de billet envoyé');
                        }
                    }

                    // Ajout d'un article
                    elseif($_GET['action'] == 'addPost'){
                        if(!empty($_POST['title']) && !empty($_POST['article'])){
                            addPost($_POST['title'], $_POST['article']);
                        } else {
                            throw new Exception('Tous les champs ne sont pas remplis afin de valider l\'article');
                        }
                    }

                    elseif($_GET['action'] == 'addComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            if(!empty($_POST['author']) && !empty($_POST['comment'])){
                                addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                            } else {
                                throw new Exception('Tous les champs ne sont pas remplis !');
                            }
                        } else {
                            throw new Exception('Aucun identifiant de billet envoyé.');
                        }
                    }

                    elseif($_GET['action'] == 'editComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            editComment($_GET['id']);
                        } else {
                            throw new Exception('Impossible de récupérer le commentaire.');
                        }
                    }

                    elseif($_GET['action'] == 'editedComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            editedComment($_GET['id'], $_POST['newComment']);
                        } else {
                            throw new Exception('Aucune modification effectuée sur le commentaire');
                        }
                    }

                    elseif($_GET['action'] == 'deleteComment'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            deleteComment($_GET['id']);
                        } else {
                            throw new Exception('Impossible de supprimer ce commentaire.');
                        }
                    }

                    elseif($_GET['action'] == 'editPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            editPost($_GET['id']);
                        } else{
                            throw new Exception('Impossible de récupérer le post.');
                        }
                    }

                    elseif($_GET['action'] == 'editedPost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            editedPost($_GET['id'], $_POST['newTitle'], $_POST['newPost']);
                        } else {
                            throw new Exception('Aucune modification effectuée sur le post.');
                        }
                    }

                    elseif($_GET['action'] == 'deletePost'){
                        if(isset($_GET['id']) && $_GET['id'] > 0){
                            deletePost($_GET['id']);
                        } else {
                            throw new Exception('Impossible de supprimer ce post.');
                        }
                    }

                    // Registration on the website
                    elseif($_GET['action'] == 'registration'){
                        if(!empty($_POST['login']) && !empty($_POST['passwordVisitor'])){
                            registration($_POST['login'], $_POST['passwordVisitor']);
                        } else {
                            throw new Exception('Impossible d\'enregistrer les informations de la personne.');
                        }
                    }

                    // Connection on the website
                    elseif($_GET['action'] == 'connection'){
                        if(!empty($_POST['login']) && !empty($_POST['passwordVisitor'])){
                            connection($_POST['login'], $_POST['passwordVisitor']);
                        } else {
                            throw new Exception('Impossible de vous identifier.');
                        }
                    }

                } else {
                    listPosts();
                }
            } catch(Exception $e){
                echo 'Erreur : ' . $e->getMessage();
            }

        //}
    //}
