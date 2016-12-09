  <div class="container-fluid hed">
      <br>
      <div class="row">
        <div class="left col-lg-1  col-md-1 ">
        </div>
        <div class="left col-lg-5  col-md-5 col-sm-12 col-xs-12">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
                  <li data-target="#myCarousel" data-slide-to="3"></li>
                  <li data-target="#myCarousel" data-slide-to="4"></li>
                  <li data-target="#myCarousel" data-slide-to="5"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                    <img src="images/1/1.jpg" alt="tur" width="460" height="300">
                  </div>
                  <div class="item">
                    <img src="images/1/2.jpg" alt="tur" width="460" height="300">
                  </div>
                  <div class="item">
                    <img src="images/1/3.jpg" alt="tur" width="460" height="300">
                  </div>
                  <div class="item">
                    <img src="images/1/4.jpg" alt="tur" width="460" height="300">
                  </div>
                  <div class="item">
                    <img src="images/1/5.jpg" alt="tur" width="460" height="300">
                  </div>
                  <div class="item">
                    <img src="images/1/6.jpg" alt="tur" width="460" height="300">
                  </div>
                </div>
          </div>
        </div>
        <div class="left col-lg-5  col-md-5 col-sm-12 col-xs-12">
          <div class="panel-group" id="accordion">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    Новости
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                      Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                    Акции
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                    Скоро в продаже
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
  </div>
  <div class="container marketing">
     <div class="row">
        
        <form action="index.php?page=1" method="post" name='f1'>
            <?php 
            include_once('pages/lists.html');
            $items=Item::GetItems();
            foreach ($items as $i) {
              $i->Draw();
            }
          ?>
       </form>
        <?php 
          foreach ($_REQUEST as $k => $v) {
            if (substr($k,0,4)=='cart') {
              $iid=substr($k, 4);
              echo "<script>document.cookie='cart".$iid."=".$iid."'</script>";
             // setcookie('cart'.$iid,$iid,time()+60*10);
            }
          }
        ?>
      
     </div>
  </div> <!-- /container -->
   