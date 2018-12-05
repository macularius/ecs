<div class="container">
	<div class="row">
		<!-- список товаров -->
		<div class="col-xl-6">
			<span>Корзина</span>
			<div class="cart">
				<!-- Товары -->
				<div class="container">
					<span>Товары:</span>
					<a data-cart='clear' class="cart-goods-remove">Очистить корзину</a>
					
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
			<span>Оформление заказа</span>
			<div class="order">
				
			</div>
		</div>
	</div>
</div>
<!-- <pre>модель
<?
    print_r($data);
?>
</pre> -->
