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
        '/catalog/good/:num' => 'catalog/good/$1', // страница товара

        '/login' => 'catalog/index', // главная страница со входом
        '/catalog/login' => 'catalog/index', // главная страница со входом
        '/catalog/index/login' => 'catalog/index', // главная страница со входом

        '/registration' => 'catalog/index', // главная страница со входом
        '/catalog/registration' => 'catalog/index', // главная страница со входом
        '/catalog/index/registration' => 'catalog/index', // главная страница со входом

//        '/catalog/indexContent' => 'catalog/indexContent', // контент главной страницы
        '/catalog/about' => 'catalog/about', // О нас
        '/cart/index' => 'cart/index', // корзина
        '/cart/login' => 'catalog/index', // корзина
        '/cart/registration' => 'catalog/index', // корзина

        '/mng/index' => 'management/index', // страница менеджмент
        '/mng/index/login' => 'catalog/index', // корзина
        '/mng/index/registration' => 'catalog/index', // корзина
    );

    function getRoutes(){
        return $this->routes;
    }
}