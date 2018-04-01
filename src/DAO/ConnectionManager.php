<?php

namespace Openclassrooms\Blog\Model;

    require_once('Manager.php');

    class ConnectionManager extends Manager{

        public function connection($login, $passwordVisitor){
            $db = $this -> dbConnect();

            $connectionRequest = $db -> prepare('INSERT INTO members(login, password, registration_date) VALUES (:login, :password, NOW())');
            $executeConnection = $connectionRequest -> execute(array(
                'login' => $login,
                'password' => $passwordVisitor
            ));

            return $executeConnection;
        }
    }