<?
$user='root';
$pass='123456';
$host='localhost';
$dbname='tur';
//подключение к бд
function connect(){
	global $user,$pass,$host,$dbname;
	$link=mysql_connect($host,$user,$pass) or die('error server connect');
	mysql_select_db($dbname) or die('не удалось подключиться к бд');
	mysql_query("set names 'utf8'");
}
 function register($name, $pass, $email){
 	$name=trim(htmlspecialchars($name));
 	$pass=trim(htmlspecialchars($pass));
 	$email=trim(htmlspecialchars($email));
 	if ($name=="" || $pass=="" || $email=="") {
 		echo "<h3 style='color:red'>Не все поля заполнены</h3>";
 		return false;
 	}
 	if (strlen($name)<3 || strlen($name)>30) {
 		echo "<h3 style='color:red'>Не правильная длинна строки</h3>";
 		return false;
 	}
 	if (strlen($pass)<3 || strlen($pass)>30) {
 		echo "<h3 style='color:red'>Не правильная длинна строки</h3>";
 		return false;
 	}
 	$ins='insert into users (login, pass, email, roleid) value("'.$name.'","'.md5($pass).'","'.$email.'",2)';
 	connect();
 	mysql_query($ins);
 	return true;
 }


 function login($name, $pass){
 	$name=trim(htmlspecialchars($name));
 	$pass=trim(htmlspecialchars($pass));
 	if ($name=="" || $pass=="") {
 		echo "<h3 style='color:red'>Не все поля заполнены</h3>";
 		return false;
 	}
 	if (strlen($name)<3 || strlen($name)>30) {
 		echo "<h3 style='color:red'>Не правильная длинна строки</h3>";
 		return false;
 	}
 	if (strlen($pass)<3 || strlen($pass)>30) {
 		echo "<h3 style='color:red'>Не правильная длинна строки</h3>";
 		return false;
 	}
 	$sel='select * from users where name="'.$name.'" and pass="'.md5($pass).'"';
 	connect();
 	$res=mysql_query($sel);
 	$row=mysql_fetch_array($res,MYSQL_NUM);
 	if ($row[1]==$name) {
 		session_start();
 		$_SESSION['ruser']=$name;
 		return true;
 	}
 	else{
 		return false;
 	}
 }