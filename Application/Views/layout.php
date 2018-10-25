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

        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/Application/Views/css/main.css">
<!--        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap-grid.css">-->
<!--        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap-grid.css">-->

        <script type="javascript" src="/Application/Views/scripts/bootstrap.js"></script>
        <script type="javascript" src="/Application/Views/scripts/bootstrap.bundle.js"></script>
    </head>

    <!--  PHP code: если текущая страница - не каталог, то нужно убрать пространство, занимаемое посковым элементом  -->
    <header class="template-header">

        <!-- панель шапки -->
        <div class="container-fluid sidebar">
            <div class="row">

                <!-- логотип -->
                <div class="col-xl-3 col-md-3 sidebar-logo"><span class="sidebar-logo-text disable-selection">Автозапчасти.ru</span></div>

                <!-- поиск -->
                <?php if($selected_btn == "каталог") echo
                "<div class=\"col-xl-3 col-md sidebar-search\">
                    <input class=\"col-xl-12 col-md-8 sidebar-search-input\" type=\"text\" placeholder=\"🔎 поиск\">
                </div>";
                else echo "<div class=\"col-xl-3\" style='width:0;min-height:0;padding-right:0;padding-left:0;'></div>";
                ?>

                <!-- кнопки -->
                <div class="col-xl-5 col-md-7 sidebar-buttons">
                    <div class="row">

                        <?php if(true) echo
                        "<a href=\"/management/index\" class=\"col-xl-3 col-md-3 sidebar-buttons-btn <?php if ($selected_btn == 'менеджмент') echo 'selected';?>\"
                             onmouseover=\"point(this)\"
                             onmouseout=\"unpoint(this)\"
                        >Менеджмент</a>";
                        else echo "<div class=\"col-xl-3 col-md-3\"></div>"
                        ?>

                        <a href="/catalog/index" class="col-xl-3 col-md-3 sidebar-buttons-btn <?php if ($selected_btn == 'каталог') echo 'selected';?>"
                           onmouseover="point(this)"
                           onmouseout="unpoint(this)"
                        >Каталог</a>

                        <a href="/catalog/about" class="col-xl-3 col-md-3 sidebar-buttons-btn <?php if ($selected_btn == 'о нас') echo 'selected';?>"
                             onmouseover="point(this)"
                             onmouseout="unpoint(this)"
                        >О нас</a>

                        <a href="/cart/index" class="col-xl-3 col-md-3 sidebar-buttons-btn <?php if ($selected_btn == 'корзина') echo 'selected';?>"
                             onmouseover="point(this)"
                             onmouseout="unpoint(this)"
                        >Корзина</a>

                    </div>
                </div>

                <!-- иконка -->
                <div class="col-xl-1 col-md-1 sidebar-icon">
                    <div class="sidebar-icon-btn"
                         onmouseover="point(this)"
                         onmouseout="unpoint(this)">
                        <span class="sidebar-icon-btn-text"><?php echo 'войти'?></span>
                    </div>
                </div>

            </div>
        </div>

    </header>

    <div id="content">
        <?php include VIEW_PATH. DS . $content_view; ?>
    </div><a id="content_end"></a>


    <footer class="template-footer"></footer>

    <script src="/Application/Views/scripts/main.js"></script>
</html>