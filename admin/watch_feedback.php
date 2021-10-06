<?php
include("./include/header.php");


if (isset($_GET['id'])) {
  $feedback_id = $_GET['id'];

  $feedback = $db->prepare("SELECT * FROM feedbacks WHERE id=:id");
  $feedback->execute(['id'=>$feedback_id]);
  $feedback = $feedback->fetch();

}







 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="content col-md-9 ml-sm-auto col-lg-10 px-4">
       <h1>فیدبک شماره <?php echo $feedback['id']; ?> :</h1>

       <hr>
       <h4 class="envan" style="float:right;"><?php echo $feedback['name']; ?></h4>

       <p class="tarikh" style="float:left;"><?php echo $feedback['mail']; ?></p><br><br>

       <p><?php echo $feedback['feedback']; ?></p>



     </main>

   </div>

 </div>
 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.replace('body');

 </script>
