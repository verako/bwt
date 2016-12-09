<?php 
//
class Tools{
	static private $param;
	static function SetParam($host,$user,$pass,$dbname){
		Tools::$param=array($host,$user,$pass,$dbname);
		// Tools::$param[]=$host;
		// Tools::$param[]=$user;
		// Tools::$param[]=$pass;
		// Tools::$param[]=$dbname;
	}

//подключение к бд MySQL строка подключения
static function connect(){
	$dsn='mysql:host='.Tools::$param[0].';dbname='.Tools::$param[3].';charset=utf8;';
	//массив параметров для PDO используем ассоциативный массив
	$options=array(
		PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,//сигнализировать о возникновении ошибки сразу
		PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
		PDO::MYSQL_ATTR_INIT_COMMAND=>'set names utf8'
		);
	//непосредственно подключение
	$pdo=new PDO($dsn, Tools::$param[1],Tools::$param[2],$options);
	return $pdo;
}
}
//пользователи
class Customer{
	protected $id;
	protected $login;
	protected $pass;
	protected $roleid;
	protected $discount;
	protected $total;
	protected $imagepath;

	function __construct($login,$pass,$imagepath,$id=0){
		if ($imagepath=="") {
			$imagepath='images/foto.png';
		}
		$this->login=$login;
		$this->pass=$pass;
		$this->imagepath=$imagepath;
		$this->id=$id;
		$this->discount=0;
		$this->total=0;
		$this->roleid=2;
	}
	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into customers (login,pass,roleid,discount,total,imagepath) value(:login,:pass,:roleid,:discount,:total,:imagepath)');
		$data=array('login'=>$this->login,'pass'=>$this->pass,'roleid'=>$this->roleid,'discount'=>$this->discount,'total'=>$this->total,'imagepath'=>$this->imagepath);

		$ps->execute($data);

	}
	static function FromDb($id){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from customers where id=?');
		$ps->execute(array($id));
		$row=$ps->fetch(PDO::FETCH_LAZY);//массив создается после обращения к данным
		$customer=new Customer($row['login'],$row['pass'],$row['imagepath'],$id);
		return $customer;
	}
}
//товары
class Item{
	protected $id,$itemname,$catid,$subid,$pricein,$pricesale,$info,$rate,$imagepath,$action;
	function __construct(array $data){
		$this->id=$data['id'];
		$this->itemname=$data['itemname'];
		$this->catid=$data['catid'];
		$this->subid=$data['subid'];
		$this->pricein=$data['pricein'];
		$this->pricesale=$data['pricesale'];
		$this->info=$data['info'];
		$this->rate=0;
		$this->imagepath=$data['imagepath'];
		$this->action=0;

	}
	function IntoDb(){
		Tools::SetParam('localhost','root','123456','shop');
		$pdo=Tools::connect();
		$ps=$pdo->prepare('insert into items (itemname,catid,subid,pricein,pricesale,info,rate,imagepath,action) value(:itemname,:catid,:subid,:pricein,:pricesale,:info,:rate,:imagepath,:action)');
		$data=array('itemname'=>$this->itemname,
			'catid'=>$this->catid,
			'subid'=>$this->subid,
			'pricein'=>$this->pricein,
			'pricesale'=>$this->pricesale,
			'info'=>$this->info,
			'rate'=>$this->rate,
			'imagepath'=>$this->imagepath,
			'action'=>$this->action);

		$ps->execute($data);

	}
	function Draw(){
		echo "<div class='col-sm-3' style='height:300px'>";
		echo "<h4 style=font-size:16pt>".$this->itemname."</h4>";
		echo "<div><img src='".$this->imagepath."' height='100px' style='max-width:150px'><span class='pull-right' style='font-size:18pt'>".$this->pricesale."</span></div>";
		echo "<div style='overflow:hidden;height:45px'>".$this->info."</div>";
		echo "<div><button name='cart".$this->id."' type='submit' >В корзину</button> <a class='btn btn-success' href='pages/iteminfo.php?item=".$this->id."'>Подробней</a></div>";
		echo "</div>";
	}
	function DrawCart(){
		// echo "<div class='col-sm-3' style='height:300px'>";
		// echo "<table border='1'>";
		// echo "<tr><th>Ячейка 1</th><th>Ячейка 2</th></tr>";
  		echo "<tr><td>".$this->itemname."</td><td><img src='".$this->imagepath."' height='100px' style='max-width:150px'></td><td>".$this->info."</td><td><button name='cartdel".$this->id."' type='submit' >Убрать с корзины</button> <a class='btn btn-success' href='pages/iteminfo.php?item=".$this->id."'>Подробней</a></td></tr>"; 
 	// 	echo "</table>";
		//echo "<h4 style=font-size:16pt>".$this->itemname."</h4>";
		//echo "<div><img src='".$this->imagepath."' height='100px' style='max-width:150px'><span class='pull-right' style='font-size:18pt'>".$this->pricesale."</span></div>";
		//echo "<div style='overflow:hidden;height:45px'>".$this->info."</div>";
		//echo "<div><button name='cartdel".$this->id."' type='submit' >Убрать с корзины</button> <a class='btn btn-success' href='pages/iteminfo.php?item=".$this->id."'>Подробней</a></div>";
		//echo "</div>";
	}
	static function fromDb($id){
		$item=null;
		try{
			$pdo=Tools::connect();
			$ps=$pdo->prepare('select * from Items where id=?');
			$ps->execute(array($id));
			$row=$ps->fetch();
			$data=array('id'=>$row['id'],'itemname'=>$row['itemname'],'catid'=>$row['catid'],'subid'=>$row['subid'],'pricein'=>$row['pricein'],'pricesale'=>$row['pricesale'],'info'=>$row['info'],'rate'=>$row['rate'],'imagepath'=>$row['imagepath'],'action'=>$row['action']);
			$item=new Item($data);
			return $item;
		}
		catch(PDOException $e){
			echo $e->getMessage();
			return false;
		}
	}
	static function GetItems(){
		$pdo=Tools::connect();
		$ps=$pdo->prepare('select * from items');
		$items=array();
		$ps->execute();
		while ($row=$ps->fetch()) {
			$data=array('id'=>$row['id'],'itemname'=>$row['itemname'],'catid'=>$row['catid'],'subid'=>$row['subid'],'pricein'=>$row['pricein'],'pricesale'=>$row['pricesale'],'info'=>$row['info'],'rate'=>$row['rate'],'imagepath'=>$row['imagepath'],'action'=>$row['action']);
			$i=new Item($data);
			$items[]=$i;
		}
		return $items;
	}
}