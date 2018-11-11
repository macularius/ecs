<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10.10.2018
 * Time: 15:40
 */

session_start();

include_once 'config.php';
include 'Application/Core/bootstrap.php';
$url = $_GET['url'];


//echo "<br >"."URL: ".$url."<br >";


// Автозагрузка классов
spl_autoload_register(function ($class) {
    include $class.'.php';
});


// get запросы
if ($_GET['email'] && $_GET['password']) {
	$email = $_GET['email'];
	$password = $_GET['password'];
	// echo "<script>alert('$url');</script>";
}

$routes = new routes();
$router = new router();
$router::addRoute($routes->getRoutes());
$router::dispatch();



// отображение всех ошибок
error_reporting (E_ALL);
