<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 6:22
 */

/** Core **/
include_once 'router.php';
include_once 'routes.php';

/** Entities **/
include_once ENTITIES_PATH . DS . 'model.php';
include_once ENTITIES_PATH . DS . 'view.php';
include_once ENTITIES_PATH . DS . 'controller.php';

/** DB **/
global $db_host, $db_username, $db_password, $db_name, $db_charset;

$db_host = 'localhost';
$db_username = 'mysql';
$db_password = 'mysql';
$db_name = 'ecs';
$db_charset = 'utf8';

global $db_ecs;
$db_ecs = @mysqli_connect($db_host, $db_username, $db_password, $db_name) or die("Ошибка " . mysqli_error($db_ecs));
//var_dump($db_ecs);