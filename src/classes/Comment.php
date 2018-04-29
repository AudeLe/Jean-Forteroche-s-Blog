<?php

    namespace BlogJeanForteroche\src\classes;

    class Comment{

        private $id;
        private $post_id;
        private $author;
        private $comment;
        private $comment_date;
        private $reported;
        private $article;

        /**
         * @return mixed
         */
        public function getArticle(){
            return $this-> article;
        }

        /**
         * @param $article
         */
        public function setArticle($article){
            $this->article = $article;
        }

        /**
         * @return mixed
         */
        public function getId(){
            return $this-> id;
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
        public function getPostId(){
            return $this-> post_id;
        }

        /**
         * @param $post_id
         */
        public function setPostId($post_id){
            $this->post_id = $post_id;
        }

        /**
         * @return mixed
         */
        public function getAuthor(){
            return $this-> author;
        }

        /**
         * @param $author
         */
        public function setAuthor($author){
            $this->author = $author;

        }

        /**
         * @return mixed
         */
        public function getComment(){
            return $this -> comment;
        }

        /**
         * @param $comment
         */
        public function setComment($comment){
            $this->comment = $comment;

        }

        /**
         * @return mixed
         */
        public function getCommentDate(){
            return $this-> comment_date;
        }

        /**
         * @param $comment_date
         */
        public function setCommentDate($comment_date){
            $this->comment_date = $comment_date;
        }

        /**
         * @return mixed
         */
        public function getReported(){
            return $this-> reported;
        }

        /**
         * @param $reported
         */
        public function setReported($reported){
            $this->reported = $reported;
        }
    }