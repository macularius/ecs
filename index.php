<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 15:40
 */

session_start();

include_once 'config.php';
$url = $_GET['url'];



//echo "index.php";
//echo "<br >"."URL: ".$url."<br >";

include 'Application/Core/bootstrap.php';

// Автозагрузка классов
spl_autoload_register(function ($class) {
    include $class.'.php';
});


$routes = new routes();
$router = new router();
$router::addRoute($routes->getRoutes());
$router::dispatch();



// отображение всех ошибок
error_reporting (E_ALL);