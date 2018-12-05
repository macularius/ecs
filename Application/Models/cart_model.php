<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 30.11.2018
 * Time: 16:17
 */

class cart_model extends model
{
    private $cart;

    function __construct()
    {
        $this->cart = new Cart;
    }

    public function get_data()
    {
        return $this->cart->getCart();
    }
}