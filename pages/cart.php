<div class="container">
	<div class="row">
		<div class="left col-lg-12  col-md-12 col-sm-12 col-xs-12">
			<?php 
			echo "<form action='index.php?page=3' method='post'>";?>
			<table class='table'>
			<tr><th>Название товара</th><th>Фото</th><th>Информация о товаре</th><th>Цена</th><th></th></tr>
			<?php 
			//echo "<form action='index.php?page=3' metod='post'>";
			$reguser='';
            if (!isset($_SESSION['reg']) || $_SESSION['reg']=='') {
                $reguser='cart';
            }
            else{
                $reguser=$_SESSION['reg'];
            }
            $total=0;
            foreach ($_COOKIE as $k => $v) {

              if (strpos($k,$reguser)===0) 
              {
                    $pos=strpos($k,'_');
                    $iid=substr($k,$pos+1);
                    $item=Item::fromDb($iid);
                    $item->DrawCart();
                    $total+=$item->getPrice();
               }
            }
			echo "<td>Общая цена:".$total."</td><td><input value='Оформить заказ' name='subbuy' type='submit' ></td>";
			echo "</table>";
			echo "</form>";
			//переносим в таблицу sale
			if (isset($_POST['subbuy'])) {
				foreach ($_COOKIE as $key => $value) {
					$pos=strpos($key,"_");
					if (substr($key,0,$pos)==$reguser) {
						$id=substr($key, $pos+1);
						$item=Item::fromDb($id);
						$item->Sale();
					}
				}
			}
			?>
	  	 	
		</div>
	</div>
	<!-- <div class="row">
		<div class="left col-lg-12  col-md-12 col-sm-12 col-xs-12">
			<button name='carts' type='submit' >Оформить заказ</button>
		</div>
	</div> -->
</div>
