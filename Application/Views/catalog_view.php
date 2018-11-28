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
                    foreach ($data["goods"] as $good){
                        echo "<div class='good-container col-12 col-md-6 col-xl-4'>
                            <div class='good'>
                                <!-- название -->
                                <div style='overflow: hidden; height: 21px; font-weight: bold;'>
                                    <span>$good[0]</span>
                                </div><br>
                                <!-- изображение -->
                                <p style='padding-left: 10%;'>
                                    <img src='Application/Views/Images/autoparts/$good[2]' height='100px' width='120px'>
                                </p><br>
                                <!-- вин -->
                                <span>VIN: $good[3]</span><br>
                                <!-- номер -->
                                <span>Номер: $good[4]</span><br>
                                <!-- описание -->
                                <span>Описание: $good[1]</span><br>
                                <!-- наличие -->
                                <div>
                                    <div class='availability ";
                                                                $good[5]=='в наличии' ? print "availability-good" : print "availability-bad";
                                                                echo "'></div><span>$good[5]</span>
                                    <!-- кнопка купить и цена -->
                                    <button style='float: right;' ";
                                                                $good[5]=='в наличии' ? print "" : print "disabled";
                                                                echo ">
                                        <span style='float: right; font-weight: bold;'>$good[6] ₽</span>
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

