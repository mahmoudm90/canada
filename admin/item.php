<?php
include("./include/header.php");

$query_items = "SELECT * FROM items ORDER BY id DESC";
$items = $db->query($query_items);

if (isset($_GET['action']) && isset($_GET['id'])) {


  $id = $_GET['id'];

  $query = $db->prepare('DELETE  FROM items WHERE id = :id');
  $query->execute(['id'=>$id]);

  header("Location:item.php");
  exit();

}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
          <h3>آیتم ها</h3>
          <a href="new_item.php"> ایجاد آیتم جدید</a>
       </div>

       <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
             <tr>
               <th>#</th>
               <th>عنوان</th>
               <th>کوتاه شده متن</th>
               <th>نویسنده</th>
               <th>تاریخ</th>
               <th>تنظیمات</th>
             </tr>
           </thead>
           <tbody>
             <?php
             if ($items->rowcount()>0) {
               foreach ($items as $item) {
                 ?>
                 <tr>
                   <td><?php echo $item['id'] ?></td>
                   <td><?php echo $item['title'] ?></td>
                   <td><?php echo substr($item['body'], 0, 200) ?></td>
                   <td><?php echo $item['author'] ?></td>
                   <td><?php echo $item['date'] ?></td>
                   <td>
                     <a href="edit_item.php?id=<?php echo $item['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                     <a href="item.php?action=delete&id=<?php echo $item['id'] ?>" class="btn btn-outline-info">حذف</a>
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
