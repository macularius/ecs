<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 3:50
 */

class err_controller
{
    function action_err404(){
        include VIEW_PATH . DS . 'Templates' .DS . 'err404.html';
        exit;
    }
}