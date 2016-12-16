<?php 
$pdo=Tools::connect();
echo var_dump($_GET);
$id=4;//$_GET['item'];
$ps=$pdo->prepare('select * from items where id=?');
 $ps->execute(array($id));
 $row=$ps->fetch();
 $info=$row['info'];
?>
<div class='row'>
	<div class='col-md-3'>
			<img src="<?php echo $row['imagepath']; ?>" height="500" alt="">
	</div>
	<div class='col-md-7'>
			<h2 class="h2"><?php echo $row['itemname']; ?></h2>
			<p class="jumbotron"><?php echo $info; ?></p>
			<h2 class="h2 text-info">Цена: <span class="text-danger"><?php echo $row['pricesale']; ?></span> грн.</h2>
			<input type="submit" name="cart<?php echo $id ?>>" value="купить" class="btn btn-success">
			<input type="submit" name="feedback" value="отзывы"  class="btn btn-warning" id="show_feed">
	</div>
	
</div>
<div class="row" id="item_info">
		<div class='col-md-5'>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1500">
				<div class="carousel-inner" role="listbox">
					<?php
					$ps=$pdo->prepare('select imagepath from images where itemid=?');
					$ps->execute(array($id));
					$i=1;
					while ($row=$ps->fetch()) {
					if ($i==1) echo '<div class="item active">';
					else echo '<div class="item">';
					echo '<img src='.$row['imagepath'].' alt="">';
					echo '</div>';
					$i++;
					}
					 ?>
				</div>
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			    <span class="sr-only">Previous</span>
				</a>
			  	<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			    <span class="sr-only">Next</span>
			  	</a>
			</div>

		</div>
		
	</div>
















