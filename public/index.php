<?php
    require('../config/dev.php');
	require('../config/Autoloader.php');

	session_start();
	session_regenerate_id(true);

    Blog\config\Autoloader::register();

    $router = new Blog\config\Router();
	$router->requestRouter();