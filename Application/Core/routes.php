<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 4:04
 */

class routes
{
    private $routes = array(
        '' => 'catalog/index', // главная страница
        '/' => 'catalog/index', // главная страница
        '/catalog' => 'catalog/index', // главная страница
        '/catalog/index' => 'catalog/index', // главная страница
        '/catalog/indexContent' => 'catalog/indexContent', // контент главной страницы
        '/catalog/about' => 'catalog/about', // О нас
        '/catalog/aboutContent' => 'catalog/aboutContent', // контент О нас
        '/cart/index' => 'cart/index', // корзина
        '/catalog/cartContent' => 'cart/index', // корзина
        '/catalog/good/:num' => 'catalog/good/$1', // страница товара
        //'/index.php?controller=:any&action=:any' => '$1/$2', // страница товара

        '/verification/index' => 'verification/index', // корзина

    );

    function getRoutes(){
        return $this->routes;
    }
}