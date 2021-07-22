<?php
// include("./include/config.php");
// include("./include/db.php");

$query="SELECT * FROM footerlinks";
$footerlinks=$db->query($query);

 ?>
<!-- start footer -->
<div class="panel-footer footer">
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
                        <a href="index.php?link=<?php echo $link['id']?>"><?php
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
          <form action="">
            <input class="nam" type="text" placeholder="نام و نام خانوادگی">
            <input class="mail" type="text" placeholder="ایمیل">
            <input class="mozoo" type="text" placeholder="موضوع">
            <textarea class="payam" name="" id="" cols="30" rows="10" placeholder="متن پیام"></textarea>
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
