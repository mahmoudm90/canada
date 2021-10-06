<?php
if (isset($_POST['idea'])) {
  if (trim($_POST['nam'])!="" && trim($_POST['mail'])!="" && trim($_POST['mozoo'])!="" && trim($_POST['payam'])!="") {
    $name = $_POST['nam'];
    $mail = $_POST['mail'];
    $topic = $_POST['mozoo'];
    $feedback = $_POST['payam'];

    $item_insert = $db->prepare("INSERT INTO feedbacks(name, mail, topic, feedback) VALUES (:name, :mail, :topic, :feedback)");
    $item_insert->execute(['name'=>$name, 'mail'=>$mail, 'topic'=>$topic, 'feedback'=>$feedback]);

    header("Location:index.php");
    exit();
  }else {
    header("Location:index.php?err_msg=تمامی فیلدها الزامی است");
    exit();
  }
}

$query="SELECT * FROM footerlinks";
$footerlinks=$db->query($query);

 ?>
<!-- start footer -->
<div class="panel-footer footer pt-10 mt-30">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <div class="links">
            <h5>لینک های مفید و سریع</h5><br><br>
            <ul>
                <?php
                  if ($footerlinks->rowcount() > 0) {
                     foreach ($footerlinks as $link) {
                       ?>
                       <li class="">
                        <a href="menu-item.php?item=<?php echo $link['id']?>"><?php
                         echo $link['title'] ?></a>
                       </li>
                     <?php
                     }
                   }

                   ?>

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


        </div>
        <div class="col-lg-8 col-md-8">
          <h5>نظرات  خود را برای ما ارسال  کنید</h5>
          <form action="" method="post">
            <input class="nam" name="nam" type="text" placeholder="نام و نام خانوادگی">
            <input class="mail" name="mail" type="text" placeholder="ایمیل">
            <input class="mozoo" name="mozoo" type="text" placeholder="موضوع">
            <textarea class="payam" name="payam" id="" cols="30" rows="10" placeholder="متن پیام"></textarea>
             <button type="submit" name="idea" class="btn btn-outline-primary btn-block mb-2">ارسال</button>

          </form>

        </div>

      </div>

    </div>

</div>
<!-- end footer -->
<!-- jQuery (Bootstrap JS plugins depend on it)  -->
<script src="./js/jquery-2.1.4.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/ajax-utils.js"></script>
<script src="./js/script.js"></script>
</body>
</html>
