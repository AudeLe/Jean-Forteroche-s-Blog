<?php

    namespace Blog\src\classes;

    class Post{

        private $id;
        private $title;
        private $content;
        private $creation_date;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getTitle(){
            return $this -> title;
        }

        public function setTitle($title){
            $this->title = $title;
        }

        public function getContent(){
            return $this->content;
        }

        public function setContent($content){
            $this -> content = $content;
            return $this;
        }

        public function getCreationDate(){
            return $this->creation_date;
        }

        public function setCreationDate($creation_date){
            $this->creation_date = $creation_date;
        }
    }