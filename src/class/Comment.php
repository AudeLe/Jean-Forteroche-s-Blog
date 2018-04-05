<?php

    namespace Openclassrooms\Blog\Model;

    class Comment{

        private $id;
        private $author;
        private $content;
        private $post;

        public function getId(){
            return $this-> id;
        }

        public function setIt($id){
            $this->id = $id;
            return $this;
        }

        public function getAuthor(){
            return $this-> author;
        }

        public function setAuthor($author){
            $this->author = $author;
            return $this;
        }

        public function getContent(){
            return $this -> content;
        }

        public function setContent($content){
            $this->content = $content;
            return $this;
        }

        public function getPost(){
            return $this->post;
        }

        public function setPost($post){
            $this->post = $post;
            return $this;
        }
    }