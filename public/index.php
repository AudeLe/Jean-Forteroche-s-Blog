<?php
    require('../config/prod.php');
	require('../config/Autoloader.php');

	session_start();
	session_regenerate_id(true);

    BlogJeanForteroche\config\Autoloader::register();

    $router = new BlogJeanForteroche\config\Router();
	$router->requestRouter();