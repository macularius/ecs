<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.10.2018
 * Time: 3:20
 */

class Router
{
    public static $routes = array();
    private static $params = array();
    public static $requestedUrl = '';


    /**
     * @param $var
     * @param string $label
     *
     * Вывод информации в консоль
     */
    public static function cl_var_dump($var, $label = '') {
        ob_start();
        var_dump($var);
        $result = json_encode(ob_get_clean());
        echo "<script>console.group('".$label."');console.log('".$result."');console.groupEnd();</script>";
    }

    /**
     * Добавить маршрут
     */
    public static function addRoute($route, $destination=null) {
        if ($destination != null && !is_array($route)) {
            $route = array($route => $destination);
        }
        self::$routes = array_merge(self::$routes, $route);
    }

    /**
     * Разделить переданный URL на компоненты
     */
    public static function splitUrl($url) {
        $temp = preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
//        self::cl_var_dump($temp);
        return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Текущий обработанный URL
     */
    public static function getCurrentUrl() {
        return (self::$requestedUrl?:'/');
    }

    /**
     * Обработка переданного URL
     */
    public static function dispatch($requestedUrl = null) {
        // $temp = self::$params;
        // echo "<script>alert('$temp[0]');</script>";

        // Если URL не передан, берем его из REQUEST_URI
        if ($requestedUrl === null) {
            $uri = reset(explode('?', $_SERVER["REQUEST_URI"]));
            $requestedUrl = urldecode(rtrim($uri, '/'));
        }

        self::$requestedUrl = $requestedUrl;

        // если URL и маршрут полностью совпадают
        if (isset(self::$routes[$requestedUrl])) {
//            echo "<script>alert('url и маршрут совпали');</script>";
            self::$params = self::splitUrl(self::$routes[$requestedUrl]);
            return self::executeAction();
        }

        foreach (self::$routes as $route => $uri) {
            // Заменяем wildcards на рег. выражения
            if (strpos($route, ':') !== false) {
                $route = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $route));
            }

            if (preg_match('#^'.$route.'$#', $requestedUrl)) {
                if (strpos($uri, '$') !== false && strpos($route, '(') !== false) {
                    $uri = preg_replace('#^'.$route.'$#', $uri, $requestedUrl);
                }
                self::$params = self::splitUrl($uri);

                break; // URL обработан!
            }
        }
        return self::executeAction();
    }

    /**
     * Запуск соответствующего действия/экшена/метода контроллера
     */
    public static function executeAction() {
        /**
         * #TODO Защита от прямого обращения
         */

        $controller = isset(self::$params[0]) ? self::$params[0] : 'err';
        $action = isset(self::$params[1]) ? self::$params[1] : 'err404';
        $action = 'action_'.$action;
        $params = array_slice(self::$params, 2);

        $controllerTest = $controller;
        $actionTest = $action;


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
            setcookie('cart_goods', -1, 0, '/');
        }

        require CONTROLLER_PATH . DS . $controller . '_controller.php';
        if (file_exists(MODEL_PATH . DS . $controller . '_model.php')) {
            require MODEL_PATH . DS . $controller . '_model.php';
        }

        define('CONTROLLER_ACTION', $controller.DS.$action);
        $controller .= '_controller';
        $controller = new $controller();


        // авторизация
//        var_dump($action);
        if ($_POST['action'] == 'authorisation') {
            if(isset($_POST['email']) && isset($_POST['password'])) {
                self::login($_POST['email'], $_POST['password']);
            }
        }
        // регистрация
        if ($_POST['action'] == 'registration') {
            if(isset($_POST['email']) && isset($_POST['password'])) {
                self::registration($_POST['email'], $_POST['password']);
            }
        }
        // менеджмент
        if ($_POST['action'] == 'management') {
            if (isset($_POST['context'])) {
                self::getManagementContent($_POST['context']);
            }
        }
        if ($_POST['action'] == 'management edit') {
            if (isset($_POST['actionmng']) && isset($_POST['context']) && isset($_POST['object'])) {
                self::executeManagementAction($_POST['actionmng'], $_POST['context'], $_POST['object']);
            }
        }
        if ($_POST['action'] == 'management accept edit') {
            if (isset($_POST['category']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['image'])  && isset($_POST['vin'])  && isset($_POST['number'])  && isset($_POST['availability'])  && isset($_POST['cost'])) {
                self::acceptEdit($_POST['category'], $_POST['name'], $_POST['description'], $_POST['image'], $_POST['vin'], $_POST['number'], $_POST['availability'], $_POST['cost']);
            }
        }
        if (!empty($_POST)) '';
        elseif($params) $controller->$action($params); //return call_user_func_array(array($controller, $action), $params);
        else $controller->$action();        //return call_user_func(array($controller, $action));

        //echo $controllerTest." ".$actionTest;

    }

    private function login($login, $password) {
        $sql_query = 'SELECT `логин`, `пароль`, `роль` FROM `Пользователи` WHERE `логин` LIKE \''.$login.'\' AND `пароль` LIKE \''.$password.'\'';
        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));

        $result = mysqli_fetch_row($query);

        if (!empty($result)) {
            //setcookie('isLogin', true, 0, '/');
            setcookie('role', $result[2], 0, '/');
            setcookie('login', (string)$login, 0, '/');
            setcookie('password', (string)$password, 0, '/');

            echo 'is login - true';
            return true;
        }
        else {
            //setcookie('isLogin', false, 0, '/');
            echo 'is login - false';
            return false;
        }
    }

    private function registration($login, $password) {
        $sql_query = 'SELECT `логин` FROM `Пользователи` WHERE `логин` LIKE \''.$login.'\'';
        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));

        $result = mysqli_fetch_row($query);

        if (empty($result)) {
            $sql_query = 'INSERT INTO `Пользователи` (`код_пользователя`, `логин`, `пароль`, `роль`) VALUES (NULL, \''.$login.'\', \''.$password.'\', \'user\')';
            $query = mysqli_query($GLOBALS['db_ecs'], $sql_query) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
            echo 'login is empty';
        }
        else {
            echo 'login is not empty';
        }
    }

    private function getManagementContent($context) {
        //echo $context;
        $temp;
        switch ($context) {
            //таблица товары в разделе товары
            case 'goods_goods1':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"10%\">
                        </td>
                        <td width=\"30%\">
                            <b>категория</b>
                        </td>
                        <td width=\"100%\">
                            <b>наименование</b>
                        </td>
                        <td width=\"100%\">
                            <b>описание</b>
                        </td>
                        <td width=\"15%\">
                            <b>изображение</b>
                        </td>
                        <td class=\"col-xl\">
                            <b>вин</b>
                        </td>
                        <td class=\"col-xl\">
                            <b>номер</b>
                        </td>
                        <td class=\"col-xl\">
                            <b>наличие</b>
                        </td>
                        <td class=\"col-xl\">
                            <b>цена</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_goods = "SELECT `наименование`, `описание`, `адрес_изображения`, `vin`, `номер`, `наличие`, `цена`, `код_категории`, `код_товара` FROM `Товары`";
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

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($data['goods'] as $goods){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$goods[8]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$goods[8]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$data['categories'][$goods[7]-1][0]."</td>
                                    <td style=\"padding-left: 10px;\">".$goods[0]."</td>
                                    <td style=\"padding-left: 10px;\">".$goods[1]."</td>
                                    <td style=\"text-align: center;\"><img src='http://ecs/Application/Views/Images/autoparts/".$goods[2]."' height='40px' width='60px'></td>
                                    <td style=\"padding-left: 10px;\">".$goods[3]."</td>
                                    <td style=\"padding-left: 10px;\">".$goods[4]."</td>
                                    <td style=\"padding-left: 10px;\">".$goods[5]."</td>
                                    <td style=\"padding-left: 10px;\">".$goods[6]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица категории в разделе товары
            case 'goods_goods2':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"1%\">
                        </td>
                        <td width=\"30%\">
                            <b>название</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_categories = "SELECT `название`, `код_категории` FROM `Категории`";

                        // Массив категорий
                        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_categories) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $categories = mysqli_fetch_all($query);

                        // Ассоциативный массив модели catalog
                        $data = [
                            "categories" => $categories,
                        ];

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($data['categories'] as $categories){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$categories[1]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$categories[1]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$categories[0]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица избранное в разделе товары
            case 'goods_goods3':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"1%\">
                        </td>
                        <td width=\"30%\">
                            <b>название</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_categories = "SELECT `название`, `код_категории` FROM `Категории`";

                        // Массив категорий
                        $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_categories) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $categories = mysqli_fetch_all($query);

                        // Ассоциативный массив модели catalog
                        $data = [
                            "categories" => $categories,
                        ];

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($data['categories'] as $categories){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$categories[1]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$categories[1]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$categories[0]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица активные в разделе заказы
            case 'orders_orders1':
                echo "
                    <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                        <tr>
                            <td colspan=\"2\" width=\"5%\">
                            </td>
                            <td width=\"10%\">
                                <b>дата заказа</b>
                            </td>
                            <td width=\"10%\">
                                <b>дата подтверждения</b>
                            </td>
                            <td width=\"15%\">
                                <b>статус</b>
                            </td>
                            <td width=\"100%\">
                                <b>товары</b>
                            </td>
                        </tr>
                        ";
                            $sql_query_orders_text = "SELECT `код_заказа`, `дата_заказа`, `дата_подтверждения`, `статус` FROM `Заказы` WHERE `статус`='не подтвержден'";

                            // Массив неподтвержденных заказов
                            $sql_query_orders = mysqli_query($GLOBALS['db_ecs'], $sql_query_orders_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                            $orders = mysqli_fetch_all($sql_query_orders);

                            $class = "class=\"mng-content-table-row\"";
                            $count = 0;
                            foreach ($orders as $order){
                                echo "
                                    <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                        <td id='".$context." ".$order[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                        <td id='".$context." ".$order[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                        <td style=\"padding-left: 10px;\">".$order[1]."</td>
                                        <td style=\"padding-left: 10px;\">".$order[2]."</td>
                                        <td style=\"padding-left: 10px;\">".$order[3]."</td>
                                        <td style=\"padding-left: 10px;\">
                                ";

                                // Массив списка товаров в заказах
                                $sql_query_goodsLists_text = "SELECT `код_заказа`, `код_товара`, `количество` FROM `Список товаров в заказе` WHERE `код_заказа`='".$order[0]."'";
                                $sql_query_goodsLists = mysqli_query($GLOBALS['db_ecs'], $sql_query_goodsLists_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                                $goodsLists = mysqli_fetch_all($sql_query_goodsLists);

                                foreach ($goodsLists as $misc) {
                                    // Массив наименований товаров
                                    $sql_query_goods_text = "SELECT `код_товара`, `наименование` FROM `Товары` WHERE `код_товара` = '".$misc[1]."'";
                                    $sql_query_goods = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                                    $goodsNames = mysqli_fetch_row($sql_query_goods);

                                    $temp = $goodsNames;

                                    echo "
                                        ".$goodsNames[1]." x".$misc[2]."<br>
                                    ";

                                }
                                echo "
                                        </td>
                                    </tr>
                                ";
                            }
                    echo "</table>";
                    break;
            //таблица неактивные в разделе заказы
            case 'orders_orders2':
                echo "
                    <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                        <tr>
                            <td colspan=\"2\" width=\"5%\">
                            </td>
                            <td width=\"10%\">
                                <b>дата заказа</b>
                            </td>
                            <td width=\"10%\">
                                <b>дата подтверждения</b>
                            </td>
                            <td width=\"15%\">
                                <b>статус</b>
                            </td>
                            <td width=\"100%\">
                                <b>товары</b>
                            </td>
                        </tr>
                        ";
                            $sql_query_orders_text = "SELECT `код_заказа`, `дата_заказа`, `дата_подтверждения`, `статус` FROM `Заказы` WHERE `статус`='подтвержден'";

                            // Массив неподтвержденных заказов
                            $sql_query_orders = mysqli_query($GLOBALS['db_ecs'], $sql_query_orders_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                            $orders = mysqli_fetch_all($sql_query_orders);

                            $class = "class=\"mng-content-table-row\"";
                            $count = 0;
                            foreach ($orders as $order){
                                echo "
                                    <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                        <td id='".$context." ".$order[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                        <td id='".$context." ".$order[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                        <td style=\"padding-left: 10px;\">".$order[1]."</td>
                                        <td style=\"padding-left: 10px;\">".$order[2]."</td>
                                        <td style=\"padding-left: 10px;\">".$order[3]."</td>
                                        <td style=\"padding-left: 10px;\">
                                ";

                                // Массив списка товаров в заказах
                                $sql_query_goodsLists_text = "SELECT `код_заказа`, `код_товара`, `количество` FROM `Список товаров в заказе` WHERE `код_заказа`='".$order[0]."'";
                                $sql_query_goodsLists = mysqli_query($GLOBALS['db_ecs'], $sql_query_goodsLists_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                                $goodsLists = mysqli_fetch_all($sql_query_goodsLists);

                                foreach ($goodsLists as $misc) {
                                    // Массив наименований товаров
                                    $sql_query_goods_text = "SELECT `код_товара`, `наименование` FROM `Товары` WHERE `код_товара` = '".$misc[1]."'";
                                    $sql_query_goods = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                                    $goodsNames = mysqli_fetch_row($sql_query_goods);

                                    $temp = $goodsNames;

                                    echo "
                                        ".$goodsNames[1]." x".$misc[2]."<br>
                                    ";

                                }
                                echo "
                                        </td>
                                    </tr>
                                ";
                            }
                    echo "</table>";
                    break;
            //таблица все в разделе заказы
            case 'orders_orders3':
                echo "
                    <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                        <tr>
                            <td colspan=\"2\" width=\"5%\">
                            </td>
                            <td width=\"10%\">
                                <b>дата заказа</b>
                            </td>
                            <td width=\"10%\">
                                <b>дата подтверждения</b>
                            </td>
                            <td width=\"15%\">
                                <b>статус</b>
                            </td>
                            <td width=\"100%\">
                                <b>товары</b>
                            </td>
                        </tr>
                        ";
                        $sql_query_orders_text = "SELECT `код_заказа`, `дата_заказа`, `дата_подтверждения`, `статус` FROM `Заказы`";

                        // Массив неподтвержденных заказов
                        $sql_query_orders = mysqli_query($GLOBALS['db_ecs'], $sql_query_orders_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $orders = mysqli_fetch_all($sql_query_orders);

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($orders as $order){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$order[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$order[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$order[1]."</td>
                                    <td style=\"padding-left: 10px;\">".$order[2]."</td>
                                    <td style=\"padding-left: 10px;\">".$order[3]."</td>
                                    <td style=\"padding-left: 10px;\">
                            ";

                            // Массив списка товаров в заказах
                            $sql_query_goodsLists_text = "SELECT `код_заказа`, `код_товара`, `количество` FROM `Список товаров в заказе` WHERE `код_заказа`='".$order[0]."'";
                            $sql_query_goodsLists = mysqli_query($GLOBALS['db_ecs'], $sql_query_goodsLists_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                            $goodsLists = mysqli_fetch_all($sql_query_goodsLists);

                            foreach ($goodsLists as $misc) {
                                // Массив наименований товаров
                                $sql_query_goods_text = "SELECT `код_товара`, `наименование` FROM `Товары` WHERE `код_товара` = '".$misc[1]."'";
                                $sql_query_goods = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                                $goodsNames = mysqli_fetch_row($sql_query_goods);

                                $temp = $goodsNames;

                                echo "
                                    ".$goodsNames[1]." x".$misc[2]."<br>
                                ";

                            }
                            echo "
                                    </td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица товар менеджер в разделе сотрудники
            case 'members_members1':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"5%\">
                        </td>
                        <td width=\"50%\">
                            <b>логин</b>
                        </td>
                        <td width=\"100%\">
                            <b>роль</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_users_text = "SELECT `код_пользователя`, `логин`, `роль` FROM `Пользователи` WHERE `роль`='goods'";

                        // Массив пользователей
                        $sql_query_users = mysqli_query($GLOBALS['db_ecs'], $sql_query_users_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $users = mysqli_fetch_all($sql_query_users);

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($users as $user){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$user[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$user[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$user[1]."</td>
                                    <td style=\"padding-left: 10px;\">".$user[2]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица заказ менеджер в разделе сотрудники
            case 'members_members2':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"5%\">
                        </td>
                        <td width=\"50%\">
                            <b>логин</b>
                        </td>
                        <td width=\"100%\">
                            <b>роль</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_users_text = "SELECT `код_пользователя`, `логин`, `роль` FROM `Пользователи` WHERE `роль`='orders'";

                        // Массив пользователей
                        $sql_query_users = mysqli_query($GLOBALS['db_ecs'], $sql_query_users_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $users = mysqli_fetch_all($sql_query_users);

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($users as $user){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$user[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$user[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$user[1]."</td>
                                    <td style=\"padding-left: 10px;\">".$user[2]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
            //таблица пользователи в разделе сотрудники
            case 'members_members3':
                echo "
                <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                    <tr>
                        <td colspan=\"2\" width=\"5%\">
                        </td>
                        <td width=\"50%\">
                            <b>логин</b>
                        </td>
                        <td width=\"100%\">
                            <b>роль</b>
                        </td>
                    </tr>
                    ";
                        $sql_query_users_text = "SELECT `код_пользователя`, `логин`, `роль` FROM `Пользователи` WHERE `роль`='user'";

                        // Массив пользователей
                        $sql_query_users = mysqli_query($GLOBALS['db_ecs'], $sql_query_users_text) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));
                        $users = mysqli_fetch_all($sql_query_users);

                        $class = "class=\"mng-content-table-row\"";
                        $count = 0;
                        foreach ($users as $user){
                            echo "
                                <tr "; if($count == 0){ echo $class; $count=1;} else $count--; echo">
                                    <td id='".$context." ".$user[0]."' data-mng-action='edit' style=\"text-align: center; cursor: pointer;\" >&#9998;</td>
                                    <td id='".$context." ".$user[0]."' data-mng-action='delete' style=\"text-align: center; cursor: pointer;\" >&#10006;</td>
                                    <td style=\"padding-left: 10px;\">".$user[1]."</td>
                                    <td style=\"padding-left: 10px;\">".$user[2]."</td>
                                </tr>
                            ";
                        }
                echo "</table>";
                break;
        }
    }

    private function executeManagementAction($action, $context, $object){
        echo "<div id=\"edited field content\" style=\"overflow: auto;\">
            <!-- таблица товаров -->
            <table border=\"2px\" id=\"mng content table\" class=\"container mng-content-table\">
                <!-- товар -->
                <tr>
                    <!-- панель инструментов -->
                    <td colspan=\"2\" width=\"10%\">
                    </td>
                    <!-- категория товара -->
                    <td width=\"30%\">
                        <b>категория</b>
                    </td>
                    <!-- наименование товара -->
                    <td width=\"100%\">
                        <b>наименование</b>
                    </td>
                    <!-- описание -->
                    <td width=\"100%\">
                        <b>описание</b>
                    </td>
                    <!-- изображение -->
                    <td width=\"15%\">
                        <b>изображение</b>
                    </td>
                    <!-- vin -->
                    <td class=\"col-xl\">
                        <b>вин</b>
                    </td>
                    <!-- номер -->
                    <td class=\"col-xl\">
                        <b>номер</b>
                    </td>
                    <!-- наличие -->
                    <td class=\"col-xl\">
                        <b>наличие</b>
                    </td>
                    <!-- цена -->
                    <td class=\"col-xl\">
                        <b>цена</b>
                    </td>
                </tr>
                <?
                    $sql_query_goods = \"SELECT `наименование`, `описание`, `адрес_изображения`, `vin`, `номер`, `наличие`, `цена`, `код_категории`, `код_товара` FROM `Товары`\";
                    $sql_query_categories = \"SELECT `название` FROM `Категории`\";

                    // Массив товаров
                    $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_goods) or die(\"Ошибка \" . mysqli_error($GLOBALS['db_ecs']));
                    $goods = mysqli_fetch_all($query);

                    // Массив категорий
                    $query = mysqli_query($GLOBALS['db_ecs'], $sql_query_categories) or die(\"Ошибка \" . mysqli_error($GLOBALS['db_ecs']));
                    $categories = mysqli_fetch_all($query);

                    // Ассоциативный массив модели catalog
                    $data = [
                        \"goods\" => $goods,
                        \"categories\" => $categories,
                    ];

                    $class = \"class=\\"mng - content - table - row\\"\";
                    $count = 0;
                    foreach ($data['goods'] as $goods){
                        echo \"
                            <tr \"; if($count == 0){ echo $class; $count=1;} else $count--; echo\">
                                <td id='goods_goods1 \".$goods[8].\"' data-mng-action='edit' style=\\"text - align: center; cursor: pointer;\\" >&#9998;</td>
                                <td id='goods_goods1 \".$goods[8].\"' data-mng-action='delete' style=\\"text - align: center; cursor: pointer;\\" >&#10006;</td>
                                <td style=\\"padding - left: 10px;\\">\".$data['categories'][$goods[7]-1][0].\"</td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[0].\"</td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[1].\"</td>
                                <td style=\\"text - align: center;\\"><img src='http://ecs/Application/Views/Images/autoparts/\".$goods[2].\"' height='40px' width='60px'></td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[3].\"</td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[4].\"</td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[5].\"</td>
                                <td style=\\"padding - left: 10px;\\">\".$goods[6].\"</td>
                            </tr>
                        \";
                    }
                ?>
            </table>
        </div>
        <br><span>Редактирование:</span> 
        <form action=\"index.php\" method=\"POST\" name=\"accept edit\" onacce>
            <input type=\"hidden\" name=\"action\" value=\"accept edit\">
            <div id=\"edited field edit\" style=\"overflow: auto;\">
                <table border=\"2px\" id=\"mng edit table\" class=\"container mng-content-table\">
                    <tr>
                        <!-- категория товара -->
                        <td width=\"30%\">
                            <b>категория</b>
                        </td>
                        <!-- наименование товара -->
                        <td width=\"100%\">
                            <b>наименование</b>
                        </td>
                        <!-- описание -->
                        <td width=\"100%\">
                            <b>описание</b>
                        </td>
                        <!-- изображение -->
                        <td width=\"15%\">
                            <b>изображение</b>
                        </td>
                        <!-- vin -->
                        <td width=\"100%\">
                            <b>вин</b>
                        </td>
                        <!-- номер -->
                        <td width=\"100%\">
                            <b>номер</b>
                        </td>
                        <!-- наличие -->
                        <td width=\"100%\">
                            <b>наличие</b>
                        </td>
                        <!-- цена -->
                        <td width=\"100%\">
                            <b>цена</b>
                        </td>
                        <!-- подтвердить -->
                        <td width=\"100%\">
                            <b></b>
                        </td>
                    </tr>
                    <tr>
                        <tr>
                            <td width=\"30%\">
                                <select form=\"accept edit\" name=\"category\" style=\"width: 100%\">
                                    <option>Пункт 1</option>
                                </select>
                            </td>
                            <td width=\"100%\"><input type=\"text\" name=\"name\"></td>
                            <td width=\"100%\"><input type=\"text\" name=\"description\"></td>
                            <td width=\"15%\"><input type=\"file\" accept=\"image/jpeg\" name=\"image\"></td>
                            <td width=\"100%\"><input type=\"text\" name=\"vin\"></td>
                            <td width=\"100%\"><input type=\"text\" name=\"number\"></td>
                            <td width=\"100%\">
                                <select form=\"accept edit\" name=\"availability\">
                                    <option>в наличии</option>
                                    <option>отсутствует</option>
                                </select></td>
                            <td width=\"100%\"><input type=\"text\" name=\"cost\"></td>
                            <td width=\"100%\"><input type=\"submit\" value=\"принять\"></td>
                        </tr>
                    </tr>
                </table>
            </div>
        </form>";
    }

    private function acceptEdit($category, $name, $description, $image, $vin, $number, $availability, $cost){
        echo "
            <script>
                alert(".$category." ".$name." ".$description." ".$image." ".$vin." ".$number." ".$availability." ".$cost.");
            </script>
        ";
    }
}