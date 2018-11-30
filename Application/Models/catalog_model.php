<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15.10.2018
 * Time: 19:59
 */

class catalog_model extends model
{
    public function get_data()
    {
        $sql_query_goods = "SELECT `код_товара`, `наименование`, `описание`, `адрес_изображения`, `vin`, `номер`, `наличие`, `цена` FROM `Товары`";
        $sql_query_categories = "SELECT `название` FROM `Категории`";

        // Массив товаров
        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
        $goods = mysqli_fetch_all($query);

        // Массив категорий
        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_categories) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
        $categories = mysqli_fetch_all($query);

        // Ассоциативный массив модели catalog
        $data = [
          "goods" => $goods,
          "categories" => $categories,
        ];

        return $data;
    }
}