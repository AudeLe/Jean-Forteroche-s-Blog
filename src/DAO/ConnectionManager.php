<?php

namespace Openclassrooms\Blog\Model;

    require_once('Manager.php');

    class ConnectionManager extends Manager{

        public function registration($login, $passwordVisitor){
            $db = $this -> dbConnect();

            $passwordVisitorHashed = password_hash($passwordVisitor, PASSWORD_DEFAULT);

            $registrationRequest = $db -> prepare('INSERT INTO members(login, password, registration_date) VALUES (:login, :password, NOW())');
            $executeRegistration = $registrationRequest -> execute(array(
                'login' => $login,
                'password' => $passwordVisitorHashed
            ));

            return $executeRegistration;
        }

        public function connection($login, $passwordVisitor){
            $db = $this -> dbConnect();

            $pass_exist = $db -> prepare('SELECT id, password FROM members WHERE login = :login');
            $pass_exist -> execute(array(
                'login' => $login
            ));

            $resultat = $pass_exist -> fetch();

            $resultat2 = password_verify($passwordVisitor, $resultat['password']);

            //return $resultat2;

            if ($resultat2 == false){
                echo 'Mauvais identifiant ou mot de passe.';
            } else {
                if ($resultat2 == true){
                    session_start();
                    $_SESSION['id'] = $resultat['id'];
                    $_SESSION['login'] = $login;
                    echo 'Vous êtes connecté !';
                } else {
                    echo 'Mauvais identifiant ou mot de passe.';
                }
            }
        }
    }