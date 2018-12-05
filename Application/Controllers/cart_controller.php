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
//        var_dump($_COOKIE);
        $this->model = new cart_model();
        $this->view->generate('cart_view.php', 'layout.php', $this->model->get_data());
    }

    public function action_order(){

        echo "cart, order"; //#TODO
    }
}