<div class="container">
	<div class="row">
		<!-- список товаров -->
		<div class="col-xl-6">
			<span>Корзина</span>
			<div class="cart">
				<!-- Товары -->
				<div class="container">
					<span>Товары:</span>
                    <?
                        if($_COOKIE['cart_goods'] != '-1') {
                            echo "<a data-cart='clear' class=\"cart-goods-btn\">Очистить корзину</a>
                                  <a data-cart='print' class=\"cart-goods-btn\">Распечатать</a>";
                        }
                    ?>
					
					<hr>
					<div id="goods container">
					    <? 
					    if (!empty($data['товары'])) { 
						    foreach ($data['товары'] as $goods) {
				  echo "<!-- Товар -->
						<div class='row cart-goods'>
							<!-- Изображение -->
							<div class='col-xl-2'>
								<img src='http://ecs/Application/Views/Images/autoparts/".$goods['адрес_изображения']."' height='40px' width='60px'>
							</div>
							<!-- Наименование -->
							<div class='col-xl-5 cart-goods-name'>".$goods['наименование']."</div>
							<!-- Количество -->
							<div class='col-xl-2'>
								<div data-cost='".$goods['цена']."' data-goods='".$goods['код_товара']."' data-sign='-' class='cart-goods-quantity-minus'>-</div>
								<input id='".$goods['код_товара']."' type='text' maxlength='2' min='1' pattern='[0-9]' size='1%' class='cart-goods-quantity-value' value='".$goods['количество']."'></input>
								<div data-cost='".$goods['цена']."' data-goods='".$goods['код_товара']."' data-sign='+' class='cart-goods-quantity-plus'>+</div>
							</div>
							<!-- Стоимость -->
							<div class='col-xl-3'>
								<div id='cost ".$goods['код_товара']."' class='cart-goods-sum'>".$goods['сумма на товар']." ₽</div>
								<div class='cart-goods-cost'>1шт=".$goods['цена']."₽</div>
							</div>
						</div>";
								}
							}
						?>
					</div>
				
				<hr>
				</div>

				<!-- Итоговая иформация -->
				<div class="total">
					<!-- Количество товаров -->
					<div id="total quantity" class="total-goods"><b><?echo $data['количество товаров'];?> ед. товара</b></div>
					<!-- Итоговая стоимость -->
					<div id="total cost" class="total-cost"><b>Итого: <?echo $data['сумма товаров'];?> ₽</b></div>
				</div>
			</div>
		</div>

		<!-- заказ -->
		<div class="col-xl-6">
				<?
                /** Оформление заказа
                 * Реализована проверка авторизации пользователя, если пользователь не авторизован, то ему недоступно оформление заказа
                 */
					if ($_COOKIE['login']) {
						echo "
                        <span>Оформление заказа</span>
						<div class=\"container order\">
                            <div>
                                <!-- Получатель -->
                                <div class=\"form-group\">
                                    <!-- e-mail -->
                                    <label><b>Ваш электронный адрес</b></label>
                                    <input type=\"email\" class=\"form-control\" value=\"".$_COOKIE['login']."\" disabled>
                                </div>
                                <!-- Адрес -->
                                <span><b>Адрес доставки:</b></span><br>
                                <div class=\"form-group\">
                                    <input id=\"order address\" type=\"text\" class=\"form-control\">
                                    <label id=\"order warning address\" class=\"d-none\" style=\"color: #212529; font-style: italic;\">введите адрес доставки</label>
                                </div>
                                <!-- Контактный номер -->
                                <span><b>Контактный номер:</b></span><br>
                                <div class=\"form-group\">
                                    <input id=\"order number\" type=\"text\" class=\"form-control\">
                                    <label id=\"order warning number\" class=\"d-none\" style=\"color: #212529; font-style: italic;\">введите контактный номер</label>
                                </div>
                                <!-- Заказать -->
                                <input type=\"submit\" data-cart=\"order\" class=\"btn btn-dark float-right\" id=\"order_submit\" value=\"Заказать\">
                            </div>
                        </div>
						";
					}
					else {
						echo "
                            <div class=\"container order-login\">
                                <span>Авторизируйтесь для оформления заказа.</span><br>
                                <input class=\"btn btn-dark\" type=\"submit\" value=\"Авторизироваться\" onclick=\"showOrHiddenAuth()\">
                            </div>
                        ";
					}
				?>
		</div>
	</div>
</div>
<!-- <pre>модель
<?
    print_r($data);
?>
</pre> -->
