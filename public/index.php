<?php
    require('../config/prod.php');
	require('../config/Autoloader.php');

	// Start a session
	session_start();
	session_regenerate_id(true);

    // Call the autoloader necessary to load each and every part of the code
	BlogJeanForteroche\config\Autoloader::register();

	// Call and execute the Router
    $router = new BlogJeanForteroche\config\Router();
	$router->requestRouter();