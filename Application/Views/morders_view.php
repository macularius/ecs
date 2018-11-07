<div class="container">
    <div class="row">
        <div id="orders" class="btn-toolbar col-6 d-none">
            <button id="orders1" class="btn btn-secondary active" onclick="btnManagement(this, 'orders')">Активные</button>
            <button id="orders2" class="btn btn-secondary" onclick="btnManagement(this, 'orders')">Неактивные</button>
            <button id="orders3" class="btn btn-secondary" onclick="btnManagement(this, 'orders')">Все</button>
        </div>

    </div>

    <!-- контент -->
    <div class="edited-field">
        <!-- группа 2 контент 1 -->
        <div id="orders_orders1" class="d-none">активные</div>

        <!-- группа 2 контент 2 -->
        <div id="orders_orders2" class="d-none">неактивные</div>

        <!-- группа 2 контент 3 -->
        <div id="orders_orders3" class="d-none">все</div>
    </div>
</div>