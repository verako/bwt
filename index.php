<?php session_start();?>
<!DOCTYPE html>
<!-- saved from url=(0041)http://bootstrap-3.ru/examples/jumbotron/ -->
<html lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/web-1.ico">
    <title>Shop</title>

    <!-- Bootstrap core CSS -->
    <link href="./Bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./Bootstrap/jumbotron.css" rel="stylesheet">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/style.css" rel="stylesheet">
    <script src="js/jquery-3.1.0.min.js"></script>
    
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <?php 
    $page=(isset($_GET['page']))?$_GET['page']:"1";
    include_once('pages/classes.php');
    Tools::SetParam('localhost','root','123456','shop');
    $pdo=Tools::connect();
    ?>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php?page=1"><img src="images/logo.png" alt="logo" width="80" ></a>
        </div>
        
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php echo ($page==1)?'class="active"':'';?>><a href="index.php?page=1">Главная</a></li>
            <li <?php echo ($page==2)?'class="active"':'';?>><a href="index.php?page=2">Админ</a></li>
            <li <?php echo ($page==3)?'class="active"':'';?>><a href="index.php?page=3">Корзина</a></li> 
            <li <?php echo ($page==4)?'class="active"':'';?>><a href="index.php?page=4">Регистрация</a></li> 
            <li <?php echo ($page==5)?'class="active"':'';?>><a href="index.php?page=5">Мой кабинет</a></li> 
          </ul>
          
          <form class="navbar-form navbar-right" role="form" method="post">
            <div class="form-group">
              <input type="text"  name="login" placeholder="Login" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="pass" placeholder="Password"  class="form-control">
            </div>
            <button type="submit" class="btn btn-success" name="vhod">Войти</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </div>
    <div style="height: 50px"></div>
    
    <?php 
    switch ($page) {
        case 1:
          include "pages/catalog.php";
          break;
        case 2:
          include "pages/admin.php";
          break;
        case 3:
          include "pages/cart.php";
          break;
        case 4:
          include "pages/register.php";
          break;
        case 5:
          include "pages/cabinet.php";
          break;
        case 6:
          include "pages/iteminfo.php";
          break;
        default:
          echo "Страница не найдена";
          break;
      } 
     ?>
    <footer>
      <p>© Company 2014</p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>

    <!-- <script src="js/jquery-1.12.4.js"></script> -->
    <script src="js/jquery-ui.js"></script>
    <script src="js/script.js"></script>
  
  </body>
</html>