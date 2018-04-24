<?php

    namespace Blog\src\DAO;

    use Blog\src\classes\Comment;

    class CommentDAO extends DAO{

        public function getComments($postId){

            $sql = 'SELECT COUNT(id) as nbComments FROM comments WHERE post_id = ?';
            $result = $this->sql($sql, [$postId]);
            $countCommentsData = $result -> fetch();


            $nbComments = $countCommentsData['nbComments'];
            $perPage = 5;
            $nbPage = ceil($nbComments/$perPage);

            if(isset($_GET['p']) && $_GET['p'] > 0 && $_GET['p'] <= $nbPage){
                $cPage = $_GET['p'];
            } else {
                $cPage= 1;
            }

            $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC LIMIT '.(($cPage-1)*$perPage).','.$perPage.'';
            $result = $this->sql($sql, [$postId]);
            $comments = [];

            foreach ($result as $row){
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObject($row);
            }


            for($i = 1; $i <= $nbPage; $i++){
                if($i == $cPage){
                    echo "$i /";
                } else {
                    echo "<a href =\"../public/index.php?action=post&id=$postId&p=$i\">$i</a>";
                }
            }

            return $comments;
        }

        public function postComment($postId, $author, $comment){

            $sql = 'INSERT INTO comments(post_id, author, comment, comment_date) VALUES (?, ?, ?, NOW())';
            $this->sql($sql, [$postId, $author, $comment]);

        }

        public function editComment($id){

            $sql = 'SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE id = ?';
            $result = $this->sql($sql, [$id]);
            $row = $result->fetch();

            if($row){
                return $this->buildObject($row);
            } else {
                echo 'Aucun commentaire n\'existe avec cet identifiant.';
            }

        }

        public function editedComment($id, $newComment){

            $sql = 'UPDATE comments SET comment = ? WHERE id = ?';
            $this->sql($sql, [$id, $newComment]);

        }

        public function deleteComment($id){

            $sql = 'DELETE FROM comments WHERE id = ?';
            $this->sql($sql, [$id]);

        }

        public function reportComment($id, $postId){
            $sql = 'UPDATE comments SET reported = 1 WHERE id = ?';
            $result =$this->sql($sql, [$id]);

            header('Location: ../public/index.php?action=post&id='.$postId.'');

            return $result;

        }



        public function getMemberComments($login){

            $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE author = ? ORDER BY comment_date DESC LIMIT 0, 5';
            $result = $this->sql($sql, [$login]);
            $comments = [];

            foreach($result as $row){
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObject($row);
            }

            return $comments;

        }

        private function buildObject(array $row){
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($row['post_id']);
            $comment->setAuthor(($row['author']));
            $comment->setComment($row['comment']);
            $comment->setCommentDate($row['comment_date_fr']);
            return $comment;
        }
    }