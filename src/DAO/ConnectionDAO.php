<?php

    namespace BlogJeanForteroche\src\DAO;

    use BlogJeanForteroche\src\classes\Post;
    use BlogJeanForteroche\src\classes\Comment;

    class ConnectionDAO extends DAO{

        /**
         * @param $login
         * @param $passwordVisitor
         * @param $passwordVisitorCheck
         */
        // Register a new member on the website
        public function registration($login, $passwordVisitor, $passwordVisitorCheck){

            $sql = 'SELECT login FROM members WHERE login = ?';
            $result = $this->sql($sql, [$login]);
            $row = $result->fetch();

            // If the login is already used, display a message
            // Otherwise allows th visitor to register
            if ($row) {
                echo 'Ce pseudo est déjà utilisé.';
            } else {
                // Check if the visitor has typed the same passwords
                if ($passwordVisitor === $passwordVisitorCheck) {

                    $passwordVisitorHashed = password_hash($passwordVisitor, PASSWORD_DEFAULT);

                    $sql = 'INSERT INTO members(login, password, registration_date) VALUES (:login, :password, NOW())';
                    $result = $this->sql($sql, [
                        'login' => $login,
                        'password' => $passwordVisitorHashed
                    ]);

                    //echo 'Votre inscription a bien été prise en compte. Veuillez vous connecter afin d\'accéder à votre espace personnel.';
                } else {
                    echo 'Vous n\'avez pas saisi les mêmes mots de passe.';
                }
            }

        }

        /**
         * @param $login
         * @param $passwordVisitor
         */
        // Allows a member to connect to his personal space
        public function connection($login, $passwordVisitor){

            $sql = 'SELECT id, password, status FROM members WHERE login = ?';
            $result = $this->sql($sql, [$login]);
            $row = $result->fetch();

            // Verifies if the login is in the database
            if($row){
                $checkPassword = password_verify($passwordVisitor, $row['password']);
                // And if the password typed is the right one
                if($checkPassword == true){

                    //Charging the credentials of the session
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['login'] = $login;
                    $_SESSION['status'] = $row['status'];

                    // Regarding the status of the member, the redirection is different
                    if ($row['status'] == 'admin'){
                        header('Location: ../public/index.php?action=getChaptersAndReportedComments');
                    } else {
                        header('Location: ../public/index.php?action=getMemberComments&login='.$login.'');
                    }
                } else {
                    echo 'Mauvais identifiant ou mot de passe';
                }
            } else {
                echo 'Mauvais identifiant ou mot de passe';
            }

        }

        /**
         *
         */
        // Allows the member/admin connected to log out
        public function logOut(){
            $_SESSION = array();
            session_destroy();

        }

        /**
         * @param $checkLogin
         * @param $checkPassword
         */
        // Verify the credentials before allowing the member/admin to change them
        public function checkInformations($checkLogin, $checkPassword){

            $sql = 'SELECT id, password FROM members WHERE login = :login';
            $result = $this->sql($sql, [
                'login' => $checkLogin
            ]);
            $row = $result->fetch();
            if($row){
                $confirmPassword = password_verify($checkPassword, $row['password']);

                if($confirmPassword == false){
                    echo 'Mauvais identifiant ou mot de passe';
                    if($_SESSION['status'] == 'admin'){
                        header('Location: ../public/index.php?action=getChaptersAndReportedComments');
                    } else {
                        header('Location: ../public/index.php?action=getMemberComments&login='.$checkLogin.'');
                    }

                }
            }

        }

        /**
         * @param $idVisitor
         * @param $editPassword
         * @param $editPasswordCheck
         */
        // Allows the member/admin to change his/her password
        public function editPassword($editPassword, $editPasswordCheck){

            if($editPassword == $editPasswordCheck){
                $editPasswordHashed = password_hash($editPassword, PASSWORD_DEFAULT);

                $sql = 'UPDATE members SET password = :password WHERE id = :id';
                $this->sql($sql, [
                    'id' => $_SESSION['id'],
                    'password' => $editPasswordHashed
                ]);

                header('Location: ../public/index.php');

            } else {
                echo 'Votre mot de passe n\'a pas pu être modifié.';
            }
        }

        /**
         * @param $idVisitor
         * @param $editLogin
         */
        // Allows the member/admin to change his/her login
        public function editLogin($editLogin){

            $sql = 'SELECT login FROM members WHERE login = :login';
            $result = $this->sql($sql, [
                'login' => $editLogin
            ]);
            $row = $result->fetch();
            if($row){
                echo 'Ce pseudo est déjà utilisé.';
            } else {
                $sql = 'UPDATE members SET login = :login WHERE id = :id';
                $result = $this->sql($sql, [
                    'login' => $editLogin,
                    'id' => $_SESSION['id']
                ]);

            }

            header('Location: ../public/index.php');
        }

        public function editLoginComments($editLogin){
            $sql = 'UPDATE comments SET author = :editlogin WHERE member_id = :memberId ';
            $result = $this->sql($sql, [
                'memberId' => $_SESSION['id'],
                'editlogin' => $editLogin
            ]);
        }

        /**
         * @param $id
         */
        // Allows the member to delete his/her account. This action isn't available for the admin
        public function deletionAccount($id, $checkLogin, $checkPassword){

            $sql = 'SELECT id, password FROM members WHERE login = :login';
            $result = $this->sql($sql, [
                'login' => $checkLogin
            ]);
            $row = $result->fetch();
            if($row){
                $confirmPassword = password_verify($checkPassword, $row['password']);

                if($confirmPassword == false){
                    echo 'Mauvais identifiant ou mot de passe';
                        header('Location: ../public/index.php?action=getMemberComments&login='.$checkLogin.'');
                } else {
                    $this->logOut();
                    $sql = 'DELETE FROM members WHERE id = ?';
                    $this->sql($sql, [$id]);

                    header('Location: ../public/index.php');
                }
            }
        }

                    /* ----- ADMIN PAGE ----- */

        /**
         * @return array
         */
        // Recover all the chapters displayed on the admin page
        public function getChapters(){

            $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC';
            $result = $this->sql($sql);
            $posts = [];
            foreach($result as $row){
                $postId = $row['id'];
                $posts[$postId] = $this->buildObject($row);
            }
            return $posts;

        }

        /**
         * @return array
         */
        // Recover all the reported comments displayed on the admin page
        public function getReportedComments(){

            $sql = 'SELECT posts.id, posts.title, comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr 
                    FROM comments
                    INNER JOIN posts
                    ON comments.post_id  = posts.id
                    WHERE reported = 1 
                    ORDER BY comment_date DESC';
            $result = $this->sql($sql);

            $reportedComments = [];
            foreach($result as $row){
                $commentId = $row['id'];
                $reportedComments[$commentId] = $this->buildObjectJoin($row);
            }
            return $reportedComments;

        }

        /**
         * @param $login
         * @return array
         */
        // When a member is connected, return all the member's comment
        public function getMemberComments(){

            $sql = 'SELECT posts.id, posts.title, comments.id, comments.post_id, comments.author, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr 
                    FROM comments 
                    INNER JOIN posts
                    ON comments.post_id = posts.id
                    WHERE author = :author ORDER BY comment_date DESC';
            $result = $this->sql($sql, [
                'author' => $_SESSION['login']
            ]);
            $comments = [];

            foreach($result as $row){
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObjectJoin($row);
            }

            return $comments;
        }

        /**
         * @param array $row
         * @return Post
         */
        private function buildObject(array $row){
            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setCreationDate($row['creation_date_fr']);
            return $post;
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