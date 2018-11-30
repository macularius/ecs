<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 5:01
 */

class catalog_controller extends controller
{
    public function action_good($id){
        $this->view->generate('good_view.php', 'layout.php', $id);
    }

    function action_index()
    {
//        setcookie('cart_quantity', 0, 0, '/');
//        setcookie('cart_sum', 0, 0, '/');
//        setcookie('cart_goods', -1, 0, '/');
        if (!$_COOKIE['cart_quantity']) {
            setcookie('cart_quantity', 0, 0, '/');
        }
        if (!$_COOKIE['cart_sum']) {
            setcookie('cart_sum', 0, 0, '/');
        }
        if (!$_COOKIE['cart_goods']) {
            setcookie('cart_goods', '', 0, '/');
        }

        $this->model = new catalog_model();
        $this->view->generate('catalog_view.php', 'layout.php', $this->model->get_data());

    }

    function action_about()
    {
        $this->view->generate('about_view.php', 'layout.php');
    }

    function action_management()
    {
        $this->view->generate('action_management()', 'layout.php');
    }

    /*
    function action_indexContent(){
        $this->view->toString('catalog_view.php');
    }

    function action_aboutContent(){
        $this->view->toString('about_view.php');
    }

    function action_cartContent(){
        $this->action_cart();
    }*/

}