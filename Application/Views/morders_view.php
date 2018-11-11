<div class="container mng-container">
    <div class="row">
        <div id="orders" class="btn-toolbar col-6 d-block">
            <button id="orders1" class="btn btn-secondary active" onclick="btnManagementOrders(this, 'orders')">Активные</button>
            <button id="orders2" class="btn btn-secondary" onclick="btnManagementOrders(this, 'orders')">Неактивные</button>
            <button id="orders3" class="btn btn-secondary" onclick="btnManagementOrders(this, 'orders')">Все</button>
        </div>

    </div>

    <!-- контент -->
    <div class="edited-field">
        <!-- группа 2 контент 1 -->
        <div id="orders_orders1" class="d-block">активные</div>

        <!-- группа 2 контент 2 -->
        <div id="orders_orders2" class="d-none">неактивные</div>

        <!-- группа 2 контент 3 -->
        <div id="orders_orders3" class="d-none">все</div>
    </div>
</div>