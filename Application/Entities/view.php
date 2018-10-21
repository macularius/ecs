<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 6:14
 */

class view
{
    public $template_view = VIEW_PATH . DS . 'Templates' . DS . 'layout.php'; // здесь можно указать общий вид по умолчанию.

    function generate($content_view, $template_view, $data = null)
    {
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }

        include VIEW_PATH . DS . $template_view;
    }

    function toString($content_view, $data = null){
        if(is_array($data)) {
            // преобразуем элементы массива в переменные
            extract($data);
        }

        include VIEW_PATH . DS . $content_view;
    }
}