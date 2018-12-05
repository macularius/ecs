<div class="container-fluid goods">
    <div class="row">
        <div class="col-xl-4">
            <!-- список категорий #TODO перемещение элемента при минимальной ширине -->
            <div id="categories" class="row dropdown-content-categories">
                <!-- Категории -->
                <ul>
                    <?php
                        foreach ($data["categories"] as $category){
                            echo "<li>$category[0]</li>";
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="row">
                <?php
                    foreach ($data["goods"] as $goods){
                        echo "<div class='good-container col-12 col-md-6 col-xl-4'>
                            <div class='good' style='background: #b2b2b2'>
                                <!-- название -->
                                <div style='overflow: hidden; height: 21px; font-weight: bold;'>
                                    <span>$goods[1]</span>
                                </div><br>
                                <!-- изображение -->
                                <p style='padding-left: 10%;'>
                                    <img src='http://ecs/Application/Views/Images/autoparts/$goods[3]' height='100px' width='120px'>
                                </p><br>
                                <!-- вин -->
                                <span>VIN: $goods[4]</span><br>
                                <!-- номер -->
                                <span>Номер: $goods[5]</span><br>
                                <!-- описание -->
                                <span>Описание: $goods[2]</span><br>
                                <!-- наличие -->
                                <div>
                                    <div class='availability ";
                                                                $goods[6]=='в наличии' ? print "availability-good" : print "availability-bad";
                                                                echo "'></div><span>$goods[6]</span>
                                    <!-- кнопка купить и цена -->
                                    <button style='float: right;' data-cost='$goods[7]' data-id='$goods[0]' onclick='addToCart(this)' class='";
                                                                $goods[6]=='в наличии' ? print "'" : print " d-none'";
                                                                echo ">
                                        <span style='float: right; font-weight: bold;'>$goods[7] ₽</span>
                                    </button>
                                </div>
                            </div>
                        </div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

<pre>
<?
//    print_r($data);
?>
</pre>

