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
        /*
         *  #TODO проверка логина и пароля. установка cookies
         */
        if(isset($_POST['email']) && isset($_POST['password'])) {
            if(self::login($_POST['email'], $_POST['password'])){
                setcookie('login', (string)$_POST['email'], 0, '/');
                setcookie('password', (string)$_POST['password'], 0, '/');

//              echo "<script>alert('post имеется');</script>";
//              unset($_POST['email']);
//              unset($_POST['password']);
                header("Refresh:0");
            }
        }

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
        $controller = isset(self::$params[0]) ? self::$params[0] : 'err';
        $controller .= '_controller';
        $action = isset(self::$params[1]) ? self::$params[1] : 'err404';
        $action = 'action_'.$action;
        $params = array_slice(self::$params, 2);

//        echo '<br> <b>executeAction:</b> ' . CONTROLLER_PATH . DS . $controller . '.php';
//        echo '<br>' . $controller. '/' . $action . '/' . $params;

        require CONTROLLER_PATH . DS . $controller . '.php';

        define('CONTROLLER_ACTION', $controller.DS.$action);
        $controller = new $controller();

//        echo "<script>alert('$params[0]');</script>";

        if($params) $controller->$action($params); //return call_user_func_array(array($controller, $action), $params);
        else $controller->$action();        //return call_user_func(array($controller, $action));
    }

    private function login($login, $password) {
//        var_dump($GLOBALS['db_ecs']);
//        var_dump($login, $password);
        $sql_query = 'SELECT `логин`, `пароль`, `роль` FROM `Пользователи` WHERE `логин` LIKE \''.$login.'\' AND `пароль` LIKE \''.$password.'\'';
        $login = mysqli_query($GLOBALS['db_ecs'], $sql_query) or die("Ошибка " . mysqli_error($GLOBALS['db_ecs']));

        $result = mysqli_fetch_row($login);
//        var_dump($result);

        setcookie('role', $result[2], 0, '/');


        if (!empty($result)) {
            return true;
        }
        else  return false;
    }
}