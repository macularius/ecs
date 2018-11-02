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

    </head>

    <!--  PHP code: если текущая страница - не каталог, то нужно убрать пространство, занимаемое посковым элементом  -->
    <header class="template-header">

        <!-- панель шапки -->
        <div class="container-fluid sidebar">
            <div class="row">

                <!-- логотип -->
                <div class="col-4 col-xl-3 col-md-3 sidebar-logo"><span class="sidebar-logo-text disable-selection">Автозапчасти.ru</span></div>

                <!-- поиск -->
                <?php if($selected_btn == "каталог") echo
                "<div class=\"col-5 col-md col-xl-3 sidebar-search\">
                    <input class=\"col-xl-12 sidebar-search-input\" type=\"text\" placeholder=\"🔎 поиск\">
                </div>";
                else echo "<div class=\"col-5 col-md-0 col-xl-3\" style='width:0;min-height:0;padding-right:0;padding-left:0;'></div>";
                ?>

                <!-- кнопки -->
                <div class="col-md-7 col-xl-5 sidebar-buttons">
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
                <div class="col-2 col-md-1 col-xl-1 sidebar-icon">
                    <div class="sidebar-icon-btn"
                         onmouseover="point(this)"
                         onmouseout="unpoint(this)">
                        <span class="sidebar-icon-btn-text"><?php echo 'войти'?></span>
                    </div>
                </div>

                <!-- кнопки на телефоне -->
                <div class="col-1 d-block d-md-none d-xl-none">
                    <div class="dropdown">
                        <span class="disable-selection dropdown-text" onclick="dropdownBtn(this)">&#9776;</span>
                    </div>
                </div>

            </div>
        </div>

        <div id="dropdown content" class="dropdown-content d-xl-none d-md-none" style="display: none;">
            <div class="row">
                <a href="/catalog/index" class="sidebar-buttons-btn dropdown-content-row <?php if ($selected_btn == 'каталог') echo 'selected';?>">Каталог</a>
            </div>

            <div class="row">
                <a href="/catalog/about" class="sidebar-buttons-btn dropdown-content-row <?php if ($selected_btn == 'о нас') echo 'selected';?>">О нас</a>
            </div>

        </div>

    </header>

    <div id="content" class="content">
        <?php include VIEW_PATH. DS . $content_view; ?>


        <!-- Кнопки для телефона внизу экрана -->
        <div class="d-xl-none d-md-none" style="display: block;">
            <div class="prefotter-btns fixed">
                <a href="/cart/index">
                    <div id="prefotterBtns cart btn" class="prefotter-btns-btn prefotter-btns-btn-cart">
                        <img src="/Application/Views/Images/cart.png">
                    </div>
                </a>

                <div id="prefotterBtns up btn" class="prefotter-btns-btn prefotter-btns-btn-up disable-selection">
                    <span>&#9650;</span>
                </div>
            </div>
        </div>
    </div><a id="content_end"></a>


    <footer class="template-footer"></footer>

    <script src="/Application/Views/scripts/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>