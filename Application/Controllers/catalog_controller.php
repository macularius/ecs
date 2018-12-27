<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 5:01
 */

class catalog_controller extends controller
{
//    public function action_good($id){
//        $this->view->generate('good_view.php', 'layout.php', $id);
//    }

    function action_index()
    {
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
}