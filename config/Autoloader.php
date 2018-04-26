<?php

	namespace Blog\config;

	class Autoloader {

        /**
         *
         */
		public static function register(){
			spl_autoload_register([__CLASS__, 'autoload']);
		}

        /**
         * @param $class
         */
		public static function autoload($class){
			$class = str_replace('Blog', '', $class);
			$class = str_replace('\\', '/', $class);
			require '../'.$class.'.php';
		}
	}