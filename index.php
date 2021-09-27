<?php

include("./include/header.php");

$query="SELECT * FROM items LIMIT 3";
$items=$db->query($query);


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


  <div class="main-content mb-10">
    <div class="container">
      <div class="row">

        <div class="content col-lg-9 col-md-9">



          <section>

            <div class="container">
              <div class="row">
                <div class="col-lg-12 col-md-12 mb-5">
                  <img src="./img/A2194131036.jpg"  alt="">


                </div>
                <?php
                if ($items->rowcount() > 0) {

                  foreach ($items as $item) {
                    ?>
                    <div class="col-lg-4"><a href="menu-item.php?item=<?php echo $item['id'] ?>">
                      <img src="./upload/items/<?php echo $item['image']; ?>" alt="">
                      <div class="mt-3">
                        <h6><?php echo $item['title'] ?></h6>
                        <p class="small"><?php echo substr($item['body'], 0, 100); ?><span></span>
                        </p>
                      </div>

                      </a>

                    </div>
                    <?php

                  }
                }


                 ?>






              </div>
            </div>





          </section>
        </div>


        <!-- start sidebar -->
        <?php
        include("./include/sidebar.php");


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


        </div> --><!-- <hr class="rotate">
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
