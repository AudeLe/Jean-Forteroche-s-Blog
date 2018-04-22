<?php

    namespace Blog\src\classes;

    class View{

        private $file;
        private $title;

        public function __construct($action){
            $this->file = '../template/'.$action.'.php';
        }

        public function render($data){
            $content = $this->renderFile($this->file, $data);
            $view = $this->renderFile('../template/template.php', [
                'title' => $this->title,
                'content' => $content
            ]);
            echo $view;
        }

        private function renderFile($file, $data){
            if(file_exists($file)){
                extract($data);
                ob_start();
                require $file;
                return ob_get_clean();
            } else {
                echo 'Fichier inexistant';
            }
        }

    }