<?php

    namespace BlogJeanForteroche\src\DAO;

    use BlogJeanForteroche\src\classes\Comment;
    use BlogJeanForteroche\src\classes\Post;

    class CommentDAO extends DAO{

        /**
         * @param $postId
         * @return array
         */
        public function getComments($postId){

            // Count how many comments exist on a specific post/chapter
            $sql = 'SELECT COUNT(id) as nbComments FROM comments WHERE post_id = ?';
            $result = $this->sql($sql, [$postId]);
            $countCommentsData = $result->fetch();

            // Define the elements needed to have the pagination
            $nbComments = $countCommentsData['nbComments'];
            $perPage = 5;
            $nbPage = ceil($nbComments/$perPage);

            // Define on which page we are when nbComments > to the number of comments per page
            if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
                $cPage = $_GET['p'];
            } else {
                $cPage = 1;
            }

            // Request the comments on a specific post/chapter
            $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'';
            $result = $this->sql($sql, [$postId]);
            $comments = [];

            // Return each comment tied to the post/chapter
            foreach ($result as $row) {
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObject($row);
            }

            // Return the number of pages needed
            $page = [];
            for($i = 1; $i <= $nbPage; $i++){
                $page[$i] = '<a href="../public/index.php?action=post&id='.$postId.'&p='.$i.'">'.$i.'</a>';
            }

            return [$comments, $page];
        }

        /**
         * @param $postId
         * @param $author
         * @param $comment
         */
        // Allow to add a comment
        public function postComment($postId, $memberId, $author, $comment){

            $sql = 'INSERT INTO comments(post_id, member_id, author, comment, comment_date) VALUES (?, ?, ?, ?, NOW())';
            $this->sql($sql, [$postId, $memberId, $author, $comment]);

        }

        /**
         * @param $id
         * @return Comment
         */
        // Recover the comment we want to edit
        public function editComment($id){

            $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result->fetch();

            if($row){
                $comment = $this->buildObject($row);
                return $comment;
            } else {
                echo 'Aucun commentaire n\'existe avec cet identifiant.';
            }

        }

        /**
         * @param $id
         * @param $newComment
         */
        // Recording the changes made on the comment
        public function editedComment($id, $newComment){

            $sql = 'UPDATE comments SET comment = :newComment WHERE id = :id';
            $comment = $this->sql($sql, [
                'id' => $id,
                'newComment' => $newComment
            ]);

            if($_SESSION['status'] == 'admin'){
                header('Location: ../public/index.php?action=getChaptersAndReportedComments');
            } else {
                header('Location: ../public/index.php?action=getMemberComments&login='.$_SESSION['login'].'');
            }

        }

        /**
         * @param $id
         */
        // Delete the comment
        public function deleteComment($id){

            $sql = 'DELETE FROM comments WHERE id = ?';
            $this->sql($sql, [$id]);

        }

        /**
         * @param $id
         * @param $postId
         * @return bool|\PDOStatement
         */
        // Report a comment
        public function reportComment($id, $postId){
            $sql = 'UPDATE comments SET reported = 1 WHERE id = ?';
            $result =$this->sql($sql, [$id]);

            header('Location: ../public/index.php?action=post&id='.$postId.'');

            return $result;

        }

        /**
         * @param $id
         * @return bool|\PDOStatement
         */
        // Ignore a reported comment. Delete it from the moderation part of the admin page
        public function ignoreReportedComment($id){
            $sql = 'UPDATE comments SET reported = 0 WHERE id = ?';
            $result= $this->sql($sql, [$id]);

            header('Location: ../public/index.php?action=getChaptersAndReportedComments');

            return $result;
        }

        /**
         * @param $login
         * @return array
         */
        // When a member is connected, return all the member's comment
        public function getMemberComments($login){

            $sql = 'SELECT posts.id, posts.title, comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr 
                    FROM comments 
                    INNER JOIN posts
                    ON comments.post_id = posts.id
                    WHERE author = ? ORDER BY comment_date DESC';
            $result = $this->sql($sql, [$login]);
            $comments = [];

            foreach($result as $row){
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObjectJoin($row);
            }

            return $comments;
        }

        /**
         * @param array $row
         * @return Comment
         */
        private function buildObject(array $row){
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($row['post_id']);
            $comment->setAuthor(($row['author']));
            $comment->setComment($row['comment']);
            $comment->setCommentDate($row['comment_date_fr']);
            return $comment;
        }

        /**
         * @param array $row
         * @return Comment
         */
        private function buildObjectJoin(array $row){
            $post = new Post();
            $post->setTitle($row['title']);
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($post);
            $comment->setAuthor(($row['author']));
            $comment->setComment($row['comment']);
            $comment->setCommentDate($row['comment_date_fr']);
            return $comment;
        }
    }