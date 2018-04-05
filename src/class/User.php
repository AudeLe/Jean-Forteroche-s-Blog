<?php

    namespace Openclassrooms\Blog\Model;

    class User{

        private $id;
        private $login;
        private $password;
        private $salt;
        private $role;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
            return $this;
        }

        public function getUsername(){
            return $this->login;
        }

        public function setUsername($login){
            $this->login = $login;
            return $this;
        }

        public function getPassword(){
            return $this->password;
        }

        public function setPassword($password){
            $this->password = $password;
            return $this;
        }

        public function getSalt(){
            return $this->salt;
        }

        public function setSalt($salt){
            $this->salt = $salt;
            return $this;
        }

        public function getRole(){
            return $this->role;
        }

        public function setRole($role){
            $this->role = $role;
            return $this;
        }
    }