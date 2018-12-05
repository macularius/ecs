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
    elseif($controller_name == 'mng' && $action_name == 'index') $selected_btn = 'менеджмент';
    elseif($controller_name == 'authorization' && $action_name == 'index') $selected_btn = 'авторизация';
    else $selected_btn = 'каталог';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <title id="title"><?echo $selected_btn;?></title>

        <script src="/Application/Views/scripts/jquery.js"></script>
        <script src="/Application/Views/scripts/main.js"></script>

        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/Application/Views/css/main.css">
<!--        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap-grid.css">-->
<!--        <link rel="stylesheet" type="text/css" href="/Application/Views/css/bootstrap-grid.css">-->

    </head>

    <body>
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

                            <?php
                            if ($selected_btn == 'менеджмент') $active = 'selected';
                            else $active = '';
                            if($_COOKIE['role']=='orders' || $_COOKIE['role']=='goods' || $_COOKIE['role']=='superadmin') echo
                            "<a href=\"/mng/index\" class=\"col-xl-3 col-md-3 sidebar-buttons-btn $active\"
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

                            <a href="/cart/index" id="cart_button" data-tooltip="информация корзины" class="col-xl-3 col-md-3 sidebar-buttons-btn <?php if ($selected_btn == 'корзина') echo 'selected';?>"
                                onmouseover="point(this)"
                                onmouseout="unpoint(this)"
                            >Корзина</a>

                        </div>
                    </div>

                    <!-- иконка -->
                    <div class="col-2 col-md-1 col-xl-1 sidebar-icon">
                        <div class="sidebar-icon-btn"
                             onmouseover="point(this)"
                             onmouseout="unpoint(this)"
                             onclick="showOrHiddenAuth()">
                            <span class="sidebar-icon-btn-text"><?php if ($_COOKIE['login'] != "") echo 'Аккаунт';
                                                                      else echo 'войти'?></span>
                        </div>
                    </div>

                    <!-- форма регистрации и авторизации -->
                    <div id="authorisation field" class="authorisation-field container d-none">
                        <!-- авторизация -->
                        <div>
                            <form action="javascript:void(null);" onsubmit="auth()" id="authorisation" class="d-block">
                                <input type="hidden" name="action" value="authorisation">
                                <div class="form-group">
                                    <label for="inputEmail1">Электронный адрес</label>
                                    <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                    <label id="warning1" class="d-none" style="color: #bab7b1; font-style: italic;">неправильный логин или пароль</label>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1">Пароль</label>
                                    <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password">
                                </div>
                                <input type="submit" class="btn btn-dark float-right" id="authorisation_submit" value="Войти">
                                <div class="btn btn-dark float-right" style="margin-right: 10px" onclick="enterOrReg(this);">Регистрация</div>
                            </form>
                        </div>

                        <!-- регистрация -->
                        <div>
                            <form action="javascript:void(null);" onsubmit="registration()"  id="registration" class="d-none" action="registration" method="post">
                                <input type="hidden" name="action" value="registration">
                                <div class="form-group">
                                    <label for="inputEmail2">Электронный адрес</label>
                                    <input type="email" class="form-control" id="inputEmail2" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                    <label id="warning2" class="d-none" style="color: #bab7b1; font-style: italic;">аккаунт с данной почтой уже создан</label>

                                </div>
                                <div class="form-group">
                                    <label for="inputPassword2">Пароль</label>
                                    <input type="password" class="form-control" id="inputPassword2" placeholder="Password" name="password" oninput="identicalPasswords()">
                                </div>
                                <div class="form-group">
                                    <label for="inputRepeatPassword2">Повторите пароль</label>
                                    <input type="password" class="form-control" id="inputRepeatPassword2" placeholder="Repeat password" oninput="identicalPasswords()">
                                    <label id="warning on inputRepeatPassword2" class="d-none" style="color: #bab7b1; font-style: italic;">пароль не совпадает</label>
                                </div>
                                <input id="registration_submit" type="submit" class="btn btn-dark float-right" value="Зарегистрироваться" disabled>
                                <div class="btn btn-dark float-right" style="margin-right: 10px" onclick="enterOrReg(this);">Вход</div>
                            </form>
                        </div>

                        <!-- выход -->
                        <div>
                            <form id="exit" class="d-none" action="exit" method="post">
                                <div class="form-group">
                                    <label for="userEmail">Ваш электронный адрес</label>
                                    <input type="text" class="form-control" id="userEmail" aria-describedby="emailHelp" value="<?php echo $_COOKIE['login']?>" disabled>
                                </div>
                                <div class="btn btn-dark float-right" style="margin-right: 10px" onclick="exit(this);">Выйти</div>
                            </form>
                        </div>
                    </div>

                    <!-- кнопка dropdown на телефоне -->
                    <div class="col-1 d-block d-md-none d-xl-none">
                        <div class="dropdown">
                            <span class="disable-selection dropdown-text" onclick="dropdownBtn(this)">&#9776;</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- кнопки меню dropdown'а на телефоне -->
            <div id="dropdown content" class="dropdown-content d-xl-none d-md-none" style="display: none;">
                <div class="row">
                    <a href="/catalog/index" class="sidebar-buttons-btn dropdown-content-row <?php if ($selected_btn == 'каталог') echo 'selected';?>">Каталог</a>
                </div>

                <div class="row">
                    <a href="/catalog/about" class="sidebar-buttons-btn dropdown-content-row <?php if ($selected_btn == 'о нас') echo 'selected';?>">О нас</a>
                </div>

                <!-- категории -->
    <!--            <div class="row">-->
    <!--                <a class="sidebar-buttons-btn dropdown-content-row --><?php //if ($selected_btn == '') echo 'selected';?><!--"-->
    <!--                    onclick="dropdownBtnCatigories(this)">Категории</a>-->
    <!--            </div>-->

                <!-- менеджмент -->
                <div class="row">
                    <a href="/management/index" class="sidebar-buttons-btn dropdown-content-row <?php if ($selected_btn == 'менеджмент') echo 'selected';?>">Менеджмент</a>
                </div>

            </div>

        </header>

        <!-- контент -->
        <div id="content" class="content">
            <!-- динамический контент -->
            <?php include VIEW_PATH. DS . $content_view; ?>


            <!-- Кнопки для телефона внизу экрана -->
            <div class="d-xl-none d-md-none" style="display: block;">
                <div class="prefotter-btns">
                    <!-- кнопка корзины -->
                    <a href="/cart/index">
                        <div id="prefotterBtns cart btn" class="prefotter-btns-btn prefotter-btns-btn-cart">
                            <img src="/Application/Views/Images/cart.png">
                        </div>
                    </a>

                    <!-- кнопка прокрутки страницы -->
                    <div id="prefotterBtns up btn" class="prefotter-btns-btn prefotter-btns-btn-up disable-selection">
                        <span>&#9650;</span>
                    </div>
                </div>
            </div>
        </div><a id="content_end"></a>

        <footer class="template-footer"></footer>

        <!-- отладочный вывод -->
        <pre>куки<br><?php print_r($_COOKIE);?></pre>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>