<div class="container">
	<div class="row">
		<div class="left col-lg-12  col-md-12 col-sm-12 col-xs-12">
			<table border='1'>
			<tr><th style="width: 160px">Название товара</th><th>Фото</th><th>Информация о товаре</th><th></th></tr>
			<?php 
		    foreach ($_COOKIE as $key => $value) {
				if (substr($key,0,4)=='cart') {
				$iid=substr($key, 4);
				$item=Item::fromDb($iid);
				$item->DrawCart();

				}
			}
			?>
	  	 	</table>;
		</div>
	</div>
	<div class="row">
		<div class="left col-lg-12  col-md-12 col-sm-12 col-xs-12">
			<button name='carts' type='submit' >Оформить заказ</button>
		</div>
	</div>
</div>
