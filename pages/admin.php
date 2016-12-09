<div class="container adm">
	<div class="row">
		<div class="left col-lg-1  col-md-1 "></div>
        <div class="left col-lg-10  col-md-10 col-sm-12 col-xs-12">
	        <script>
	  			$( function() {
	    		$( "#tabs" ).tabs();
	  			} );
	  		</script>
	  		<div id="tabs">
		  		<ul>
		   			<li><a href="#tabs-1">Категории товаров</a></li>
		    		<li><a href="#tabs-2">Добавление товаров</a></li>
		    		<li><a href="#tabs-3">Добавление картинок</a></li>
		  		</ul>
		  		<div id="tabs-1">
		  			<form action='' method='post'>
			  			<label for="category">Введите категорию</label><br>
			    		<input type="text" name="category"><br><br>
			    		<input type='submit' name='addcat' value='Добавить категорию'>
						<input type='submit' name='delcat' value='Удалить'>
						<?php 
						$pdo=Tools::connect();
							if (isset($_POST['addcat'])) {
								$category=$_POST['category'];
								$ps=$pdo->prepare('insert into categories (category) value(:category)');
								$data=array('category'=>$category);
								$ps->execute($data);
							}
						?>
						<br><br>
						<label for="cat">Выберите категорию</label><br>
						<select name="cat">
							<option value="default">Категории</option>
							<?php 
								$res=$pdo->query('select * from categories');
									while ($row=$res->fetch()) {
									echo "<option value='".$row['id']."'>".$row['category']."</option>";
								 }
							?>
						</select>
						<br>
						<label for="subcat">Введите подкатегорию</label><br>
			    		<input type="text" name="subcat"><br><br>
			    		<input type='submit' name='addsubcat' value='Добавить подкатегорию'>
						<input type='submit' name='delsubcat' value='Удалить'>
						<?php 
						$pdo=Tools::connect();
							if (isset($_POST['addsubcat'])) {
								$sucategory=$_POST['subcat'];
								$catid=$_POST['cat'];
								$ps=$pdo->prepare('insert into subcategories (catid,sucategory) value(:catid,:sucategory)');
								$data=array('catid'=>$catid,'sucategory'=>$sucategory);
								$ps->execute($data);
							}
						?>
					</form>
		  		</div>
		  		<div id="tabs-2">
		  			<form action="" method='post' enctype="multipart/form-data">
		  			<?php include_once('pages/lists.html'); ?>
		  				
			    		
						<br><br>
						<label for="itemname">Введите название товара</label><br>
			    		<input type="text" name="itemname"><br><br>
			    		<label for="pricein">Цена закупки</label><br>
			    		<input type="text" name="pricein"><br><br>
			    		<label for="pricesale">Цена продажи</label><br>
			    		<input type="text" name="pricesale"><br><br>
			    		<label for="info">Информация о товаре</label><br>
			    		<textarea name="info" id="" cols="30" rows="10"></textarea>
			    		<br><br>
						<input type="file" name="file" multiple accept="image/*"><br> <!-- картинки любых форматов -->
			    		<input type='submit' name='additem' value='Добавить товар'>
						<input type='submit' name='delitem' value='Удалить'>
					</form>
					<?php 
		  				if (isset($_POST['additem'])) {
		  					if (is_uploaded_file($_FILES['file']['tmp_name'])) {
		  						$path='images/'.$_FILES['file']['name'];
		  						move_uploaded_file($_FILES['file']['tmp_name'], $path);
		  					}
		  					$catid=$_POST['cat'];
		  					$subid=$_POST['subcat'];
		  					$pricein=$_POST['pricein'];
		  					$pricesale=$_POST['pricesale'];
		  					$info=trim($_POST['info']);
		  					$itemname=trim($_POST['itemname']);
		  					$data=array('id'=>0,'itemname'=>$itemname,'catid'=>$catid,'subid'=>$subid,'pricein'=>$pricein,'pricesale'=>$pricesale,'info'=>$info,'rate'=>0,'imagepath'=>$path,'action'=>0);
		  					//var_dump($data);
		  					$item=new Item($data);
		  					$item->intoDb();
		  				}

		  			?>
		  		</div>
		  		<div id="tabs-3">
		    		<form action='' method='post' enctype="multipart/form-data" style="display:table">
			    		<label for="items">Выберите товар</label><br>	
						<select name="items">
							<option value="default">Товары</option>
							<?php 
								$res=$pdo->query('select * from items');
									while ($row=$res->fetch()) {
									echo "<option value='".$row['id']."'>".$row['itemname']."</option>";
								 }
							?>
						</select><br><br>
						<input type="file" name="file[]" multiple accept="image/*"><br> <!-- картинки любых форматов -->
						<input type="submit" name="addImage" value="Добавить картинки">
						<?php 
						if (isset($_POST['addImage'])) {
		  					if (is_uploaded_file($_FILES['file[]']['tmp_name'])) {
		  						$path='images/'.$_FILES['file[]']['name'];
		  						move_uploaded_file($_FILES['file[]']['tmp_name'], $path);
		  					}
		  					$itemid=$_POST['items'];
		  					$ps=$pdo->prepare('insert into images (itemid,imagepath) value(:itemid,:imagepath)');
								$data=array('itemid'=>$itemid,'imagepath'=>$path);

								$ps->execute($data);
							}

	  					?>
					</form>
		  		</div>
			</div>
       	</div>
		
	</div>
	<hr>
		
</div>