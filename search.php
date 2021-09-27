<?php
include("./include/header.php");
if (isset($_POST['search']) and trim($_POST['searchword']) != "") {
  $keyword = $_POST['searchword'];
  $searchitems = $db->prepare('SELECT * FROM items WHERE title like :keyword OR body like :keyword OR author like :keyword');
  $searchitems->execute(['keyword'=> "%$keyword%"]);

  $searchsuboneitems = $db->prepare('SELECT * FROM suboneitems WHERE title like :keyword OR body like :keyword OR image_body like :keyword OR author like :keyword');
  $searchsuboneitems->execute(['keyword'=> "%$keyword%"]);

  $searchsubtwoitems = $db->prepare('SELECT * FROM subtwoitems WHERE title like :keyword OR body like :keyword OR image_body like :keyword OR author like :keyword');
  $searchsubtwoitems->execute(['keyword'=> "%$keyword%"]);

  $searchnews = $db->prepare('SELECT * FROM news WHERE title like :keyword OR body like :keyword ORDER BY id DESC');
  $searchnews->execute(['keyword'=> "%$keyword%"]);

  $searchsteps = $db->prepare('SELECT * FROM steps_items WHERE title like :keyword OR body like :keyword OR body_image like :keyword ORDER BY id DESC');
  $searchsteps->execute(['keyword'=> "%$keyword%"]);




}else{
  echo "آیتمی برای نمایش وجود ندارد.";
}


 ?>





<!--start header-->

<!-- <div class="wrapper">
    <nav class="navbar navbar-expand-md  px-3">
      <div class="container">
        <div class="logo">
          <a href="index.php" class="navbar-brand ">
            <img src="./img/download.jpg"  alt="logo image">
          </a>
        </div>
        <div class="">
          <h1 class="title">کانادا ددلاین</h1>
          <div class="">
            <nav>
                <ul>
                  <li><a href="#">پذیرش  تحصیلی</a></li>
                  <li><a href="#">ویزا</a>
                    <ul>
                      <li><a href="#">استادی پرمیت</a></li>
                      <li><a href="#">پاس ریکوئست  و ریجکت</a>
                        <ul>
                          <li>چیست</li>
                          <li>چطور</li>
                        </ul>
                      </li>
                      <li><a href="#">تای</a></li>
                    </ul>
                  </li>
                  <li><a href="#">هزینه ها</a></li>
                  <li><a href="#">رنکینگ دانشگاه ها</a></li>
                  <li><a href="#">درباره ما</a></li>
                  <li><a href="#">تماس با ما</a></li>
                </ul>
              </nav>

          </div>

        </div>
        <div class="left-header">
          <div class="nav-icons d-none d-md-block" id="social">
                <a href="#">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
          </div> -->
            <!-- End social icon -->
        <!--   <div class="search">
            <form class="" action="index.html" method="post">
              <input type="text" name="" value="">
            </form>
          </div>

        </div>





      </div>

    </nav> -->
<!--end header-->
<!-- start main-content -->



  <div class="main-content">
    <div class="container">
      <div class="row">

        <div class="content col-lg-9 col-md-9">
          <?php
          if (isset($_POST['search']) and trim($_POST['searchword']) != "") {


            if ($searchitems->rowcount() > 0) {
            foreach ($searchitems as $searchitem) {
              ?>
              <div class="news">
                <?php
                  if ($searchitem['id'] < 4) {
                  ?>
                    <a href="menu-item.php?item=<?php echo $searchitem['id']?>"><h4 class="envan"><?php echo $searchitem['title']; ?></h4></a><br>
                    <?php
                  }elseif ($searchitem['id'] == 4) {
                    ?>
                    <a href="news.php"><h4 class="envan"><?php echo $searchitem['title']; ?></h4></a><br>
                    <?php
                  }else{
                    ?>
                    <a href="subitem.php?item=<?php echo $searchitem['id']?>"><h4 class="envan"><?php echo $searchitem['title']; ?></h4></a><br>
                    <?php

                  }


                ?>

                <span class="tarikh"><?php echo $searchitem['date']; ?></span>

                <div class=""><p class="matnkhabar"><?php echo substr($searchitem['body'], 0, 200); ?></p>
                </div>





              </div><hr>
              <?php
            }
          }
          if ($searchsuboneitems->rowcount() > 0) {
            foreach ($searchsuboneitems as $searchsuboneitem) {
              ?>
              <div class="news">
                <a href="subitem.php?suboneitem=<?php echo $searchsuboneitem['id']?>"><h4 class="envan"><?php echo $searchsuboneitem['title']; ?></h4></a><br>
                <span class="tarikh"><?php echo $searchsuboneitem['date']; ?></span>

                <div class=""><p class="matnkhabar"><?php echo substr($searchsuboneitem['body'], 0, 200); ?></p>
                </div>
              </div><hr>
              <?php
            }
          }

          if ($searchsubtwoitems->rowcount() > 0) {
            foreach ($searchsubtwoitems as $searchsubtwoitem) {
              ?>
              <div class="news">
                <a href="subitem.php?subtwoitem=<?php echo $searchsubtwoitem['id']?>"><h4 class="envan"><?php echo $searchsubtwoitem['title']; ?></h4></a><br>
                <span class="tarikh"><?php echo $searchsubtwoitem['date']; ?></span>

                <div class=""><p class="matnkhabar"><?php echo substr($searchsubtwoitem['body'], 0, 200); ?></p>
                </div>
              </div><hr>
              <?php
            }
          }

          if ($searchnews->rowcount() > 0) {
            foreach ($searchnews as $searchnew) {
              ?>
              <div class="news">
                <a href="news.php?news_id=<?php echo $searchnew['id']; ?>"><h4 class="envan"><?php echo $searchnew['title']; ?></h4></a><br>
                <span class="tarikh"><?php echo $searchnew['datee']; ?></span>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 col-md-6"><p class="matnkhabar"><?php echo substr($searchnew['body'], 0, 200); ?></p></div>
                   <div class="col-lg-6 col-md-6"><a href="news.php?news_id=<?php echo $searchnew['id']; ?>"><img src="img/paziresh tahsili Canada/<?php echo $searchnew['image']; ?>" alt=""></div></a>

                  </div>
                </div>


              </div><hr>
              <?php
            }
          }
          if ($searchsteps->rowcount() > 0) {
            foreach ($searchsteps as $searchstep) {
              ?>
              <div class="news">
                <a href="step.php?steps-item=<?php echo $searchstep['id']; ?>"><h4 class="envan"><?php echo $searchstep['title']; ?></h4></a><br>
                <span class="tarikh"><?php echo $searchstep['date']; ?></span>
                <div class="container">
                  <div class="row">
                    <div class="col-lg-6 col-md-6"><p class="matnkhabar"><?php echo substr($searchstep['body'], 0, 200); ?></p></div>
                   <div class="col-lg-6 col-md-6"><a href="step.php?steps-item=<?php echo $searchstep['id']; ?>"><img src="upload/stepsitems/<?php echo $searchstep['image']; ?>" alt=""></div></a>

                  </div>
                </div>


              </div><hr>
              <?php
            }
          }



          if ($searchitems->rowcount() == 0 and $searchsuboneitems->rowcount() == 0 and $searchsubtwoitems->rowcount() == 0 and $searchnews->rowcount() == 0 and $searchsteps->rowcount() == 0) {
            ?>
             <div class="col">
                 <div class="alert alert-danger">
                   آیتم  مورد نظر پیدا نشد!!!!

                 </div>

               </div>
               <?php
          }
        }else{
          ?>
          <div class="col">
                 <div class="alert alert-danger">
                   شما موردی را وارد نکرده اید!!!

                 </div>

               </div>
               <?php
        }
?>












        </div>


        <!-- start sidebar -->
        <?php
        include("./include/sidebar.php")


         ?>
       <!--  <div class="col-lg-3 col-md-3">
          <h1>تایتل بزرگ</h1>
          <div class="sidebar">
            <div class="imp"><a href="">
              <div class="image">
                <img class="imagee" src="img/paziresh tahsili Canada/3.jpg" alt="">
              </div>
              <div class="con">
                <h6 class="titr">تیتر</h6>
                <p class="matn">متن</p>
                <span class="date">تاریخ</span>
              </div>
              </a>
            </div>
             <div class="imp"><a href="">
              <div class="image">
                <img class="imagee" src="img/paziresh tahsili Canada/3.jpg" alt="">
              </div>
              <div class="con">
                <h6 class="titr">تیتر</h6>
                <p class="matn">متن</p>
                <span class="date">تاریخ</span>
              </div>
              </a>
            </div>
             <form method="post">
         <div class="from-group">
           <label for="name">نام</label>
           <input type="text" name="name" id="name" class="form-control" placeholder="نام خود را وارد کنید">

         </div>
         <div class="form-group">
           <label for="email">ایمیل</label>
           <input type="email" name="email" class="form-control" id="email" placeholder="ایمیل خود را وارد کنید">

         </div>
         <button type="submit" name="subscribe" class="btn btn-outline-primary btn-block">ارسال</button>

       </form>
          </div>


        </div> -->
        <!-- end sidebar -->
      </div>
    </div>
  </div>

</div>




<!-- end main-content -->
  <?php
 include("./include/footer.php");


  ?>
<!-- start footer -->
<!-- <div class="panel-footer footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="links">
            <h5>لینک های مفید و سریع</h5><br><br>
            <ul>
              <li><a href="">پذیرش تحصیلی</a></li>
              <li><a href="">ویزای تحصیلی</a></li>
              <li><a href="">رنکینگ دانشگاه ها</a></li>
            </ul>

          </div><br><br><br>
          <hr>


          <div class="tamas">
            <h5>تماس با ما</h5><br>
            <p class="address">آدرس</p><br>
            <p class="email">ایمیل : smmpr_09@yahoo.com <span>تلفن :</span>
            </p>

          </div><br>
          <hr>
          <h5>مارا در شبکه های اجتماعی دنبال کنید</h5>
          <div class="nav-icons d-none d-md-block" id="social">
                <a href="#">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
          </div>


        </div> --> <!-- <hr class="rotate">
        <div class="col-lg-8">
          <h5>نظرات  خود را برای ما ارسال  کنید</h5>
          <form action="">
            <input class="nam" type="text" placeholder="نام و نام خانوادگی">
            <input class="mail" type="text" placeholder="ایمیل">
            <input class="mozoo" type="text" placeholder="موضوع">
            <textarea class="payam" name="" id="" cols="30" rows="10" placeholder="متن پیام"></textarea>
          </form>

        </div>

      </div>

    </div>

</div> -->
<!-- end footer
 jQuery (Bootstrap JS plugins depend on it) -->
 <script src="./js/jquery-2.1.4.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/ajax-utils.js"></script>
<script src="./js/script.js"></script>
