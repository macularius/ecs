<?php
    $url = Router::$requestedUrl;
    $url = explode('/', $_SERVER["REQUEST_URI"]);
    //        echo "<script>alert('$url[1]'+' '+'$url[2]');</script>";
    $controller_name = $url[1];
    $action_name = $url[2];

    if($controller_name == 'catalog' && $action_name == 'about') $selected_btn = 'о нас';
    elseif($controller_name == 'cart' && $action_name == 'index') $selected_btn = 'корзина';
    elseif($controller_name == 'cart' && $action_name == 'index') $selected_btn = 'корзина';
    elseif($controller_name == 'catalog' && $action_name == 'good') $selected_btn = 'товар';
    elseif($controller_name == 'authorization' && $action_name == 'index') $selected_btn = 'авторизация';
    else $selected_btn = 'каталог';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title id="title"><?echo $selected_btn;?></title>

        <link rel="stylesheet" type="text/css" href="/Application/Views/css/main.css">

<!--        <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>-->
    </head>

    <!--  PHP code: если текущая страница - не каталог, то нужно убрать пространство, занимаемое посковым элементом  -->
    <header class="template-header" 
                                     <?php if ($selected_btn != 'каталог') echo "style=\"height: 70px;\""?>

    >
        <!-- логотип -->
        <div class="logo-container"  id="logo">
            <span class="logo-text disable-selection">Автозапчасти.ru</span>
        </div>

        <div class="sidebar-container">

            <div class="sidebar" id="sidebar">
                <!-- Корзина -->
                <a href="/cart/index">
                    <div id="sidebar_btn_cart" class="sidebar-element disable-selection <?php if ($selected_btn == 'корзина') echo 'selected';?>"
                                                                                                                                                onmouseover="point(this)"
                                                                                                                                                onmouseout="unpoint(this)">Корзина</div>
                </a>

                <!-- О нас -->
                <a href="/catalog/about">
                    <div id="sidebar_btn_about" class="sidebar-element disable-selection <?php if ($selected_btn == 'о нас') echo 'selected';?>"
                                                                                                                                                    onmouseover="point(this)"
                                                                                                                                                    onmouseout="unpoint(this)">О нас</div>
                </a>

                <!-- Каталог -->
                <a href="/catalog/index">
                    <div id="sidebar_btn_index" class="sidebar-element disable-selection <?php if ($selected_btn == 'каталог') echo 'selected';?>"
                                                                                                                                                    onmouseover="point(this)"
                                                                                                                                                    onmouseout="unpoint(this)">Каталог</div>
                </a>

                <?php
                    echo "<!-- Менеджмент -->";
                    if(true){
                        echo "<a href='/'><div id=\"management_btn_main\" class=\"sidebar-element disable-selection\"
                                                                                                                        onmouseover=\"point(this)\"
                                                                                                                        onmouseout=\"unpoint(this)\">Менеджмент</div></a>";
                    }
                ?>

            </div>

            <a href="/verification/index">
                <div id="user_icon" class="user-icon"
                                                       onmouseover="point(this)"
                                                       onmouseout="unpoint(this)">
                    <div class="user-icon-text disable-selection"><?php echo 'войти'?></div>
                </div>
            </a>
        </div>

        <?php
            //echo "<script>alert();</script>";
            if ($selected_btn == 'каталог' || $url == "http://ecs") {
                echo "  <div class=\"search-container\">
                            <div class=\"search-field\">
                                <input class=\"search\" type=\"text\" placeholder=\"🔎 поиск\">
                                <a class=\"search-btn disable-selection\" onmouseover=\"point(this)\"
                                                                        onmouseout=\"unpoint(this)\">Найти</a>
                            </div>
                        </div>";
            }


        ?>
    </header>

    <div id="content">
        <?php include VIEW_PATH. DS . $content_view; ?>
    </div><a id="content_end"></a>


    <footer class="template-footer"></footer>

    <script src="/Application/Views/scripts/main.js"></script>
</html>