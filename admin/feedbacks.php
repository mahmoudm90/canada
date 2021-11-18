<?php
include("./include/header.php");

$query_feedbacks = "SELECT * FROM feedbacks ORDER BY id DESC";
$feedbacks = $db->query($query_feedbacks);
if (isset($_GET['action']) && isset($_GET['id'])) {


  $id = $_GET['id'];

  $query = $db->prepare('DELETE  FROM feedbacks WHERE id = :id');
  $query->execute(['id'=>$id]);

  header("Location:feedbacks.php");
  exit();

}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
          <h3>فیدبک‌ها</h3>

       </div>

       <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
             <tr>
               <th>#</th>
               <th>نام</th>
               <th>ایمیل</th>
               <th>موضوع</th>
               <th>متن</th>
               <th>تنظیمات</th>
             </tr>
           </thead>
           <tbody>
             <?php
             if ($feedbacks->rowcount()>0) {
               foreach ($feedbacks as $feedback) {
                 ?>
                 <tr>
                   <td><?php echo $feedback['id'] ?></td>
                   <td><?php echo $feedback['name'] ?></td>
                   <td><?php echo $feedback['mail'] ?></td>
                   <td><?php echo $feedback['topic'] ?></td>
                   <td><?php echo $feedback['feedback'] ?></td>
                   <td>
                     <a href="watch_feedback.php?id=<?php echo $feedback['id'] ?>" class="btn btn-outline-info">مشاهده</a>
                     <a href="feedbacks.php?action=delete&id=<?php echo $feedback['id'] ?>" class="btn btn-outline-info">حذف</a>
                   </td>
                 </tr>
                 <?php

               }
             }else {
               ?>
               <div class="alert alert-danger" role="alert">
                 آیتمی برای نمایش وجود ندارد!!!

               </div>
               <?php
             }
             ?>


           </tbody>

         </table>

       </div>


     </main>

   </div>

 </div>
