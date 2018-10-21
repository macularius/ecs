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
        $this->view->generate('catalog_view.php', 'layout.php');
    }

    function action_about()
    {
        $this->view->generate('about_view.php', 'layout.php');
    }

    function action_cart()
    {
        $this->view->generate('action_cart()', 'layout.php');
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