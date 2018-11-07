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
        '/catalog' => 'catalog/index', // главная страница
        '/catalog/index' => 'catalog/index', // главная страница

        '/login' => 'catalog/index', // главная страница со входом
        '/catalog/login' => 'catalog/index', // главная страница со входом
        '/catalog/index/login' => 'catalog/index', // главная страница со входом

//        '/catalog/indexContent' => 'catalog/indexContent', // контент главной страницы
        '/catalog/about' => 'catalog/about', // О нас
//        '/catalog/aboutContent' => 'catalog/aboutContent', // контент О нас
        '/cart/index' => 'cart/index', // корзина
        '/cart/login' => 'catalog/index', // корзина
//        '/catalog/cartContent' => 'cart/index', // корзина
        '/catalog/good/:num' => 'catalog/good/$1', // страница товара

        '/mng/index' => 'management/index', // страница менеджмент
    );

    function getRoutes(){
        return $this->routes;
    }
}