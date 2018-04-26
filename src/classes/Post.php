<?php

    namespace Blog\src\classes;

    class Post{

        private $id;
        private $title;
        private $content;
        private $creation_date;

        /**
         * @return mixed
         */
        public function getId(){
            return $this->id;
        }

        /**
         * @param $id
         */
        public function setId($id){
            $this->id = $id;
        }

        /**
         * @return mixed
         */
        public function getTitle(){
            return $this -> title;
        }

        /**
         * @param $title
         */
        public function setTitle($title){
            $this->title = $title;
        }

        /**
         * @return mixed
         */
        public function getContent(){
            return $this->content;
        }

        /**
         * @param $content
         */
        public function setContent($content){
            $this -> content = $content;
        }

        /**
         * @return mixed
         */
        public function getCreationDate(){
            return $this->creation_date;
        }

        /**
         * @param $creation_date
         */
        public function setCreationDate($creation_date){
            $this->creation_date = $creation_date;
        }
    }