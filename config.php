<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 4:54
 */

define("DS", DIRECTORY_SEPARATOR);
define("SERVER_PATH", realpath(dirname(__FILE__) . DS . 'Application'));
define("CONTROLLER_PATH", realpath(dirname(__FILE__) . DS . 'Application' . DS . 'Controllers'));
define("VIEW_PATH", realpath(dirname(__FILE__) . DS . 'Application' . DS . 'Views'));
define("MODEL_PATH", realpath(dirname(__FILE__) . DS . 'Application' . DS . 'Models'));
define("ENTITIES_PATH", realpath(dirname(__FILE__) . DS . 'Application' . DS . 'Entities'));
define("GOODSIMG_PATH", realpath(dirname(__FILE__) . DS . 'Application' . DS . 'Views' . DS . 'Images' . DS . 'autoparts'));