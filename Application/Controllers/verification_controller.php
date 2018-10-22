<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 22.10.2018
 * Time: 16:52
 */

class verification_controller extends controller
{
    public function action_index(){


        $this->view->generate('login_view.php', 'layout.php');

    }
}