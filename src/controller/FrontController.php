<?php

    namespace Blog\src\controller;

    use Blog\src\classes\View;
    use Blog\src\DAO\PostDAO;
    use Blog\src\DAO\CommentDAO;

	class FrontController{

        /**
         * FrontController constructor.
         */
	    public function __construct(){
	        $this->postManager = new PostDAO();
	        $this->commentManager = new CommentDAO();
        }

                    /* ----- POST ----- */

        /**
         *
         */
        // Display all the posts/chapters - Home page
        public function listPosts(){
            $posts = $this->postManager-> getPosts();

            $view = new View('listPostsView');
            $view->render([
                'posts' => $posts
            ]);

        }

        /**
         * @param $postId
         */
        // Display a specific post/chapter
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

        /**
         * @param $title
         * @param $article
         */
        // Add a post/chapter
        public function addPost($title, $article){

            $this->postManager->addPost($title, $article);

            $view = new View('adminView');
            $view->render([
               'title' => $title,
               'content' => $article
            ]);

            header('Location: ../public/index.php?action=getChaptersAndReportedComments');
        }

        /**
         * @param $id
         */
        // Recover the post the admin wants to change
        public function editPost($id){

            $editPost = $this->postManager->editPost($id);

            $view = new View('editPostView');
            $view->render([
                'post' => $editPost
            ]);
        }

        /**
         * @param $id
         * @param $newTitle
         * @param $newPost
         */
        // Recording of the changes made on the post/chapter
        public function editedPost($id, $newTitle, $newPost){

            $this->postManager->editedPost($id, $newTitle, $newPost);

            header('Location: ../public/index.php');
        }

        /**
         * @param $id
         */
        // Delete the post/chapter
        public function deletePost($id){

            $this->postManager->deletePost($id);

        }

                    /* ----- COMMENT ----- */

        /**
         * @param $postId
         * @param $author
         * @param $comment
         */
        // Add a comment
        public function addComment($postId, $memberId, $author, $comment){

            $this -> commentManager->postComment($postId, $memberId, $author, $comment);

            header('Location: ../public/index.php?action=post&id=' . $postId);
        }

        /**
         * @param $id
         */
        // Recover the comment the member wants to edit
        public function editComment($id){

            $comment=$this->commentManager->editComment($id);

            $view = new View('editCommentView');
            $view->render([
                'comment' => $comment
            ]);

        }

        /**
         * @param $id
         * @param $newComment
         */
        // Recording of the changes on the database
        public function editedComment($id, $memberLogin, $newComment){

            $this->commentManager->editedComment($id, $newComment);

        }

        /**
         * @param $id
         */
        // Deletion of a comment
        public function deleteComment($id){

           $this->commentManager->deleteComment($id);

            header('Location: ../public/index.php');
        }

        /**
         * @param $id
         * @param $postId
         */
        // Report the comment
        public function reportComment($id, $postId){

            $this->commentManager->reportComment($id, $postId);

        }

        /**
         * @param $id
         */
        // Ignore a reported comment. Delete it from the moderation part of the admin page
        public function ignoreReportedComment($id){

            $this->commentManager->ignoreReportedComment($id);
        }

                    /* ----- MEMBER PAGE ----- */

        /**
         * @param $login
         */
        // When a member is connected, allowed to recover his/her comments
        public function getMemberComments($login){
            $comments = $this->commentManager->getMemberComments($login);

            $view = new View('memberView');
            $view->render([
                'comments' => $comments
            ]);
        }

    }