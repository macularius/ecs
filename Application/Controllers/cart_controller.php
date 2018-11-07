<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 5:39
 */

class cart_controller extends controller
{
    public function action_index(){
        var_dump($_COOKIE);
        $this->view->generate('cart_view.php', 'layout.php');
    }

    public function action_order(){
        echo "cart, order"; //#TODO
    }
}