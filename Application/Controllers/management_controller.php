<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 07.11.2018
 * Time: 15:44
 */

class management_controller extends controller
{
    public function action_index()
    {
//        var_dump($_COOKIE);
//        var_dump($_COOKIE['role']==="orders");
//        var_dump($_COOKIE['role']==="goods");
//        var_dump($_COOKIE['role']==="superadmin");
        switch ((string)$_COOKIE['role']){
            case "orders":
                $this->view->generate('morders_view.php', 'layout.php');
                break;
            case "goods":
                $this->view->generate('mgoods_view.php', 'layout.php');
                break;
            case "superadmin":
                $this->view->generate('madmin_view.php', 'layout.php');
                break;
            case "":
                header('Location: http://ecs/catalog/index ');
        }
    }

}