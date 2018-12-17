<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 01.12.2018
 * Time: 13:36
 */

class cart
{
    private $quantity;
    private $sum;
    private $goods;

    // $goods приходит в формате -1,..,..,..,..
    public function __construct()
    {
        $this->quantity = $_COOKIE['cart_quantity'];
        $this->sum = $_COOKIE['cart_sum'];
        $this->goods = $_COOKIE['cart_goods'];
    }

    public function getGoods(){
        $mod_goods = explode(',', $this->goods);

        $cart_goods_quantities = array_count_values($mod_goods);
        unset($cart_goods_quantities[-1]);
        asort($cart_goods_quantities);

        foreach ($cart_goods_quantities as $key => $value) {
            $sql_query_goods = "SELECT `код_товара`, `наименование`, `описание`, `адрес_изображения`, `vin`, `номер`, `наличие`, `цена` FROM `Товары` WHERE `код_товара` = $key";
            $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
            $goods = mysqli_fetch_assoc($query);
            $goods['количество'] = $value;  
            $goods['сумма на товар'] = $goods['цена'] * $goods['количество'];

            $cart_goods[] = $goods;
        }

        // Возвращает массив товаров в формате
        // [код_товара] => количество
        return $cart_goods;
    }

    public function getCart(){
        return [
            'количество товаров' => $this->quantity,
            'сумма товаров' => $this->sum,
            'товары' => $this->getGoods(),
        ];
    }

}