<?php
    require('../config/dev.php');
	//require('../src/controller/FrontController.php');
	//require('../src/controller/BackController.php');
	require('../config/Autoloader.php');
	//require('../config/Autoloader.php');
	Blog\config\Autoloader::register();

    //use Openclassrooms\Blog\Model;

    //require('../vendor/autoload.php');

    $router = new Blog\config\Router();
	$router->requestRouter();
