<?php
$query_imps = "SELECT * FROM news ORDER BY id DESC ";
$news = $db->query($query_imps);


 ?>

<div class="col-lg-3 col-md-3">
          <h1>تایتل بزرگ</h1>
          <div class="sidebar">
            <?php
            if ($news->rowcount() > 0) {
              foreach ($news as $new) {
               ?>
              <div class="imp"><a href="news.php?news_id=<?php echo $new['id']; ?>">
                <div class="image">
                  <img class="imagee" src="./upload/news/<?php echo $new['image']; ?>" alt="">
                </div>
                <div class="con">
                  <h6 class="titr"> <?php echo $new['title']; ?> </h6>
                  <p class="matn"> <?php echo substr($new['body'], 0, 200). "..." ?> </p>
                  <span class="date"> <?php echo $new['datee'] ?> </span>
                </div>
                </a>
              </div>
              <?php
              }
            }


             ?>
            <!-- <div class="imp"><a href="">
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
            </div> -->
            <p class="rooz"><a href="news.php" class="">آخرین اخبار <span>>></span></a></p>
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


          </div>
