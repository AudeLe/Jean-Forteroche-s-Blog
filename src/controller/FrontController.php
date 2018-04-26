<?php

    namespace Blog\src\controller;

    use Blog\src\classes\View;
    use Blog\src\DAO\PostDAO;
    use Blog\src\DAO\CommentDAO;

	class FrontController{

	    public function __construct(){
	        $this->postManager = new PostDAO();
	        $this->commentManager = new CommentDAO();
        }

        public function listPosts(){
            //$pages = $this->postManager->paginationChapters();
            $posts = $this->postManager-> getPosts();

            $view = new View('listPostsView');
            $view->render([
                'posts' => $posts
                //'pages' => $pages
            ]);

        }

        /*public function pagination($nbPage){
            $pages = $this->postManager->pagination($nbPage);

	        $view = new View('listPostsView');
	        $view ->render([
	            'pages' => $pages
            ]);
        }*/

        public function post($postId){

	        $posts = $this->postManager->getPostsInsert();
            $post = $this->postManager->getPost($postId);
            $comments = $this->commentManager->getComments($postId);

            $view = new View('postView');
            $view->render([
                'posts' => $posts,
                'post' => $post,
                'comments' => $comments
            ]);
        }

        // Ajout d'article
        public function addPost($title, $article){

            $this->postManager->addPost($title, $article);

            $view = new View('adminView');
            $view->render([
               'title' => $title,
               'content' => $article
            ]);

            header('Location: ../public/index.php');
        }

        public function addComment($postId, $author, $comment){

            $affectedLines = $this -> commentManager->postComment($postId, $author, $comment);

            if($affectedLines === false){
                throw new Exception('Impossible d\'ajouter le commentaire !');
            } else {
                header('Location: ../public/index.php?action=post&id=' . $postId);
            }
        }

        public function editComment($id){

            $this->commentManager->editComment($id);

            $view = new View('editCommentView');
            $view->render($id);

        }

        // Rediriger vers la page du post
        public function editedComment($id, $newComment){

            $this->commentManager->editedComment($id, $newComment);

            header('Location: ../public/index.php');
        }

        public function deleteComment($id){

           $this->commentManager->deleteComment($id);

            header('Location: ../public/index.php');
        }

        public function editPost($id){

            $editPost = $this->postManager->editPost($id);

            $view = new View('editPostView');
            $view->render([
                'post' => $editPost
            ]);
        }

        public function editedPost($id, $newTitle, $newPost){

            $this->postManager->editedPost($id, $newTitle, $newPost);

            header('Location: ../public/index.php');
        }

        public function deletePost($id){

            $deletedPost = $this->postManager->deletePost($id);

        }

        public function getMemberComments($login){
            $comments = $this->commentManager->getMemberComments($login);

            $view = new View('memberView');
            $view->render([
                'comments' => $comments
            ]);
        }

        public function reportComment($id, $postId){

            $this->commentManager->reportComment($id, $postId);

        }


    }