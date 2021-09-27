<?php
include("./include/header.php");

$query_news = "SELECT * FROM news ORDER BY id DESC";
$news = $db->query($query_news);

if (isset($_GET['action']) && isset($_GET['id'])) {


  $id = $_GET['id'];

  $query = $db->prepare('DELETE  FROM news WHERE id = :id');
  $query->execute(['id'=>$id]);

  header("Location:news.php");
  exit();

}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
          <h3>خبرها</h3>
          <a href="new_new.php"> ایجاد خبر جدید</a>
       </div>

       <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
             <tr>
               <th>#</th>
               <th>عنوان</th>
               <th>خلاصه متن</th>
               <th>تاریخ</th>
               <th>تنظیمات</th>
             </tr>
           </thead>
           <tbody>
             <?php
             if ($news->rowcount()>0) {
               foreach ($news as $new) {
                 ?>
                 <tr>
                   <td><?php echo $new['id'] ?></td>
                   <td><?php echo $new['title'] ?></td>
                   <td><?php echo substr($new['body'],0 ,200) ?></td>
                   <td><?php echo $new['datee'] ?></td>
                   <td>
                     <a href="edit_news.php?id=<?php echo $new['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                     <a href="news.php?action=delete&id=<?php echo $new['id'] ?>" class="btn btn-outline-info">حذف</a>
                   </td>
                 </tr>
                 <?php

               }
             }else {
               ?>
               <div class="alert alert-danger" role="alert">
                خبری برای نمایش وجود ندارد!!!

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
