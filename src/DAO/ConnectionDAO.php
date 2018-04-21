<?php

namespace Blog\src\DAO;

    require_once('DAO.php');

    class ConnectionDAO extends DAO{

        public function registration($login, $passwordVisitor, $passwordVisitorCheck){
            $db = $this -> dbConnect();

            $loginExists = $db -> prepare('SELECT login FROM members WHERE login = :login');
            $loginExists -> execute(array(
                'login' => $login
            ));

            if($donnees = $loginExists -> fetch()){
                echo 'Ce pseudo est déjà utilisé.';
            } else {
                if ($passwordVisitor == $passwordVisitorCheck){

                    $passwordVisitorHashed = password_hash($passwordVisitor, PASSWORD_DEFAULT);

                    $registrationRequest = $db -> prepare('INSERT INTO members(login, password, registration_date) VALUES (:login, :password, NOW())');
                    $executeRegistration = $registrationRequest -> execute(array(
                        'login' => $login,
                        'password' => $passwordVisitorHashed
                    ));

                    return $executeRegistration;

                } else {
                    echo 'Vous n\'avez pas saisi les mêmes mots de passe.';
                }
            }
        }

        public function connection($login, $passwordVisitor){
            $db = $this -> dbConnect();

            $pass_exist = $db -> prepare('SELECT id, password, status FROM members WHERE login = :login');
            $pass_exist -> execute(array(
                'login' => $login
            ));

            $connectionDetails = $pass_exist -> fetch();

            $result2 = password_verify($passwordVisitor, $connectionDetails['password']);

            if ($result2 == false){
                echo 'Mauvais identifiant ou mot de passe.';
            } else {
                if ($result2 == true){
                    session_start();
                    $_SESSION['id'] = $connectionDetails['id'];
                    $_SESSION['login'] = $login;
                    echo 'Vous êtes connecté !';
                    var_dump($connectionDetails['status']);
                    //die();
                    if($connectionDetails['status'] == 'admin'){
                        var_dump($connectionDetails['id']);
                        //die();

                        header('Location: ../template/adminView.php');

                        return $connectionDetails;
                    }else{
                        var_dump($connectionDetails['id']);
                        //die();
                        header('Location: ../template/memberView.php');

                        return $connectionDetails;
                    }

                } else {
                    echo 'Mauvais identifiant ou mot de passe.';
                }
            }


        }

        public function checkInformations($checkLogin, $checkPassword){
            $db = $this->dbConnect();

            $req = $db -> prepare('SELECT id, password FROM members WHERE login = :login');
            $req -> execute(array(
                'login' => $checkLogin
            ));

            $visitorInformations = $req -> fetch();

            $visitorPassword = password_verify($checkPassword, $visitorInformations['password']);

            // Add a condition => if $checkLogin and $checkPassword = Session's Login and Password = true
            if($visitorPassword == true){
                echo 'Vous avez entré les bons identifiants.';
                //die();
            } else {
                echo 'Mauvais identifiant ou mot de passe.';
            }

            return $visitorInformations;
        }

        public function editPassword($idVisitor, $editPassword, $editPasswordCheck){
            $db = $this -> dbConnect();

            if($editPassword == $editPasswordCheck){
                $editPasswordHashed = password_hash($editPassword, PASSWORD_DEFAULT);

                $req = $db -> prepare('UPDATE members SET password = :password WHERE id = :id');
                $req -> execute(array(
                    'id' => $idVisitor,
                    'password' => $editPasswordHashed
                ));

                header('Location: ../public/index.php');

                echo 'Mot de passe modifié.';

                //self::checkStatus($req);

            } else {
                echo 'Votre mot de passe n\'a pas pu être modifié.';
            }

        }

        public function editLogin($idVisitor, $editLogin){
            $db = $this->dbConnect();

            $loginExists = $db -> prepare('SELECT login FROM members WHERE login = :login');
            $loginExists -> execute(array(
                'login' => $editLogin
            ));

            if($donnees = $loginExists -> fetch()){
                echo 'Ce pseudo est déjà utilisé.';
            } else {
                $updateLogin = $db -> prepare('UPDATE members SET login = :login WHERE id = :id');
                $updateLogin -> execute(array(
                    'login' => $editLogin,
                    'id' => $idVisitor
                ));

                echo 'Pseudo modifié.';
            }
        }

        public function getPosts(){
            $db = $this -> dbConnect();
            $req = $db -> query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

            /*$posts = array();
            foreach($req as $row){
                $postId = $row['id'];
                $posts[$postId] = $this-> buildClassObject($row);
            }*/

            return $req;
        }

        public function getMemberComments($login){
            $db = $this ->dbConnect();
            $memberComments = $db -> prepare('SELECT id, post_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE author = ? ORDER BY comment_date DESC LIMIT 0, 5');
            $memberComments -> execute(array($login));

            //$memberComments = $req -> fetch();

            //var_dump($memberComments);
            //die();
            return $memberComments;
        }

        public function reportComment($idComment){
            $db = $this -> dbConnect();
            $reportedComment = $db -> prepare('UPDATE comments SET reported = 1 WHERE id = ?');
            $reportedComment -> execute(array($idComment));

            var_dump($idComment);
            //die();
            return $reportedComment;
        }

        public function getReportedComments(){
            $db = $this -> dbConnect();
            $reportedVisitorComments = $db -> query('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reported = 1 ORDER BY comment_date DESC LIMIT 0,5');

            //var_dump($reportedVisitorComments);
            return $reportedVisitorComments;
        }
    }