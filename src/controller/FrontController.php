<?php

    namespace Blog\src\controller;

    use Blog\src\DAO\PostDAO;
    use Blog\src\DAO\CommentDAO;


    //require_once('../src/DAO/PostDAO.php');
	//require_once('../src/DAO/CommentDAO.php');
	//require_once('../src/DAO/ConnectionDAO.php');

	class FrontController{

	    public function __construct(){
	        $this->postManager = new PostDAO();
	        $this->commentManager = new CommentDAO();
        }

        public function listPosts(){
            //$postManager = new PostDAO();
            $posts = $this->postManager-> getPosts();
            //require_once('../template/adminView.php');
            require('../template/listPostsView.php');

        }

        public function post(){
            //$postManager = new PostDAO();
            //$commentManager = new CommentDAO();

            $post = $this->postManager->getPost($_GET['id']);
            $comments = $this->commentManager->getComments($_GET['id']);

            require('../template/postView.php');
        }

        // Ajout d'article
        public function addPost($title, $article){
            //$postManager = new PostDAO();

            $affectedPost = $this->postManager->addPost($title, $article);

            header('Location: ../public/adminView.php');
        }

        public function addComment($postId, $author, $comment){
            //$commentManager = new CommentDAO();

            $affectedLines = $this -> commentManager->postComment($postId, $author, $comment);

            if($affectedLines === false){
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: ../public/index.php?action=post&id=' . $postId);
            }
        }

        public function editComment($id){
            //$commentManager = new CommentDAO();

            $editedComment = $this->commentManager->editComment($id);

            require('../template/editCommentView.php');
        }

        // Rediriger vers la page du post
        public function editedComment($id, $newComment){
            //$commentManager = new CommentDAO();

            $newlyEditedComment = $this->commentManager->editedComment($id, $newComment);

            header('Location: ../public/index.php');
        }

        public function deleteComment($id){
            //$commentManager = new CommentDAO();

            $deletedComment = $this->commentManager->deleteComment($id);

            header('Location: ../public/index.php');
        }

        public function editPost($id){
            //$postManager = new PostDAO();

            $editedPost = $this->postManager->editPost($id);

            require('../template/editPostView.php');
        }

        public function editedPost($id, $newTitle, $newPost){
            //$postManager = new PostDAO();

            $newlyEditedPost = $this->postManager->editedPost($id, $newTitle, $newPost);

            header('Location: ../public/index.php');
        }

        public function deletePost($id){
            //$postManager = new PostDAO();

            $deletedPost = $this->postManager->deletePost($id);

            header('Location: ../public/index.php');
        }

    }