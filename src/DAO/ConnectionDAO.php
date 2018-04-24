<?php

    namespace Blog\src\DAO;

    use Blog\src\classes\Post;
    use Blog\src\classes\Comment;

    class ConnectionDAO extends DAO{

        public function registration($login, $passwordVisitor, $passwordVisitorCheck)
        {

            $sql = 'SELECT login FROM members WHERE login = ?';
            $result = $this->sql($sql, [$login]);
            $row = $result->fetch();

            if ($row) {
                echo 'Ce pseudo est déjà utilisé.';
            } else {
                if ($passwordVisitor === $passwordVisitorCheck) {

                    $passwordVisitorHashed = password_hash($passwordVisitor, PASSWORD_DEFAULT);

                    $sql = 'INSERT INTO members(login, password, registration_date) VALUES (:login, :password, NOW())';
                    $result = $this->sql($sql, [
                        'login' => $login,
                        'password' => $passwordVisitorHashed
                    ]);

                    echo 'Votre inscription a bien été prise en compte. Veuillez vous connecter afin d\'accéder à votre espace personnel.';
                } else {
                    echo 'Vous n\'avez pas saisi les mêmes mots de passe.';
                }
            }

        }

        public function connection($login, $passwordVisitor){

            $sql = 'SELECT id, password, status FROM members WHERE login = ?';
            $result = $this->sql($sql, [$login]);
            $row = $result->fetch();
            if($row){
                $checkPassword = password_verify($passwordVisitor, $row['password']);
                if($checkPassword == true){
                    //Charging the informations of the session

                    $_SESSION['id'] = $row['id'];
                    $_SESSION['login'] = $login;
                    $_SESSION['status'] = $row['status'];

                    echo 'Vous êtes connecté !';

                    if ($row['status'] == 'admin'){
                        $this->getChapters();
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

        public function logOut(){
            $_SESSION = array();
            session_destroy();

        }

        public function checkInformations($checkLogin, $checkPassword){


            $sql = 'SELECT id, password FROM members WHERE login = :login';
            $result = $this->sql($sql, [
                'login' => $checkLogin
            ]);
            $row = $result->fetch();
            if($row){
                $confirmPassword = password_verify($checkPassword, $row['password']);

                if($confirmPassword == true){
                    echo 'Vous avez entré les bons identifiants.';
                } else {
                    echo 'Mauvais identifiant ou mot de passe';
                }
            }

        }

        public function editPassword($idVisitor, $editPassword, $editPasswordCheck){

            if($editPassword == $editPasswordCheck){
                $editPasswordHashed = password_hash($editPassword, PASSWORD_DEFAULT);

                $sql = 'UPDATE members SET password = :password WHERE id = :id';
                $this->sql($sql, [
                    'id' => $idVisitor,
                    'password' => $editPasswordHashed
                ]);

                echo 'Mot de passe modifié.';

                header('Location: ../public/index.php');
            } else {
                echo 'Votre mot de passe n\'a pas pu être modifié.';
            }

        }

        public function editLogin($idVisitor, $editLogin){

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
                    'id' => $idVisitor
                ]);

                echo 'Login modifié';
            }
        }

        public function getChapters(){

            $sql = 'SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5';
            $result = $this->sql($sql);
            $posts = [];
            foreach($result as $row){
                $postId = $row['id'];
                $posts[$postId] = $this->buildObject($row);
            }
            return $posts;

        }

        public function getReportedComments(){

            $sql = 'SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reported = 1 ORDER BY comment_date DESC LIMIT 0,5';
            $result = $this->sql($sql);

            $comments = [];
            foreach($result as $row){
                $commentId = $row['id'];
                $comments[$commentId] = $this->buildObjectComment($row);
            }
            return $comments;

        }


        private function buildObject(array $row){
            $post = new Post();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setCreationDate($row['creation_date_fr']);
            return $post;
        }

        private function buildObjectComment(array $row){
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setPostId($row['post_id']);
            $comment->setAuthor(($row['author']));
            $comment->setComment($row['comment']);
            $comment->setCommentDate($row['comment_date_fr']);
            return $comment;
        }
    }