<header class="template-header">
    <!-- логотип -->
    <div class="logo" id="logo"></div>

    <div class="sidebar-container">

        <div class="sidebar" id="sidebar">
            <!-- Корзина -->
            <div class="sidebar-element disable-selection">Корзина</div>

            <!-- Каталог -->
            <div class="sidebar-element disable-selection">Каталог</div>

            <!-- О нас -->
            <div class="sidebar-element disable-selection">О нас</div>

            <!-- Главная -->
            <div class="sidebar-element disable-selection">Главная</div>

            <?php
                echo "<!-- Менеджмент -->";
                echo "<div v-if=\"seen\" class=\"sidebar-element disable-selection\" id=\"management\">Менеджмент</div>";
            ?>

        </div>

        <div class="user-icon"></div>
    </div>
</header>