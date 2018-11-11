<div class="container mng-container">
    <div class="row">
        <div id="goods" class="btn-toolbar col-6 d-block">
            <button id="goods1" class="btn btn-secondary active" onclick="btnManagementGoods(this, 'goods')">Товары</button>
            <button id="goods2" class="btn btn-secondary" onclick="btnManagementGoods(this, 'goods')">Категории</button>
            <button id="goods3" class="btn btn-secondary" onclick="btnManagementGoods(this, 'goods')">Автомобили</button>
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
    </div>
</div>