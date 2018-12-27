<div class="container mng-container">
    <div class="row">
        <div id="goods" class="btn-toolbar col-6 d-block">
            <button id="goods1" class="btn btn-secondary active" onclick="btnManagement(this, 'goods')">Товары</button>
            <button id="goods2" class="btn btn-secondary" onclick="btnManagement(this, 'goods')">Категории</button>
            <button id="goods3" class="btn btn-secondary" onclick="btnManagement(this, 'goods')">Избранное</button>
        </div>
        <div id="orders" class="btn-toolbar col-6 d-none">
            <button id="orders1" class="btn btn-secondary active" onclick="btnManagement(this, 'orders')">Активные</button>
            <button id="orders2" class="btn btn-secondary" onclick="btnManagement(this, 'orders')">Неактивные</button>
            <button id="orders3" class="btn btn-secondary" onclick="btnManagement(this, 'orders')">Все</button>
        </div>
        <div id="members" class="btn-toolbar col-6 d-none">
            <button id="members1" class="btn btn-secondary active" onclick="btnManagement(this, 'members')">Товар менедж.</button>
            <button id="members2" class="btn btn-secondary" onclick="btnManagement(this, 'members')">Заказ менедж.</button>
            <button id="members3" class="btn btn-secondary" onclick="btnManagement(this, 'members')">Пользователи</button>
        </div>

        <div class="btn-toolbar col-6 d-block">
            <button id="goodsBtn" class="btn btn-secondary active" onclick="managementSwitcher(this)">Товары</button>
            <button id="ordersBtn" class="btn btn-secondary" onclick="managementSwitcher(this)">Заказы</button>
            <button id="membersBtn" class="btn btn-secondary" onclick="managementSwitcher(this)">Сотрудники</button>
        </div>
    </div>

    <!-- контент -->
    <div class="edited-field">
        
    </div>
</div>

<pre>
    <?
        //print_r($data);
    ?>
</pre>