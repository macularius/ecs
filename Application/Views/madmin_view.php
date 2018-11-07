<div class="container mng-container">
    <div class="row">
        <div id="goods" class="btn-toolbar col-6 d-block">
            <button id="goods1" class="btn btn-secondary active" onclick="btnManagement(this, 'goods')">Товары</button>
            <button id="goods2" class="btn btn-secondary" onclick="btnManagement(this, 'goods')">Категории</button>
            <button id="goods3" class="btn btn-secondary" onclick="btnManagement(this, 'goods')">Автомобили</button>
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


        <div class="btn-toolbar col-6">
            <button id="goodsBtn" class="btn btn-secondary active" onclick="managementSwitcher(this)">Товары</button>
            <button id="ordersBtn" class="btn btn-secondary" onclick="managementSwitcher(this)">Заказы</button>
            <button id="membersBtn" class="btn btn-secondary" onclick="managementSwitcher(this)">Сотрудники</button>
        </div>
    </div>

    <!-- контент -->
    <div class="edited-field">
        <!-- группа goods контент 1 -->
        <div id="goods_goods1" class="d-block">товары</div>

        <!-- группа goods контент 2 -->
        <div id="goods_goods2" class="d-none">категории</div>

        <!-- группа goods контент 3 -->
        <div id="goods_goods3" class="d-none">автомобили</div>

        <!-- группа 2 контент 1 -->
        <div id="orders_orders1" class="d-none">активные</div>

        <!-- группа 2 контент 2 -->
        <div id="orders_orders2" class="d-none">неактивные</div>

        <!-- группа 2 контент 3 -->
        <div id="orders_orders3" class="d-none">все</div>

        <!-- группа 3 контент 1 -->
        <div id="members_members1" class="d-none">товар менедж.</div>

        <!-- группа 3 контент 2 -->
        <div id="members_members2" class="d-none">Заказ менедж.</div>

        <!-- группа 3 контент 3 -->
        <div id="members_members3" class="d-none">Пользователи</div>
    </div>
</div>