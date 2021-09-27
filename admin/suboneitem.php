<?php
include("./include/header.php");

$query_suboneitems = "SELECT * FROM suboneitems ORDER BY id DESC";
$suboneitems = $db->query($query_suboneitems);

if (isset($_GET['action']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = $db->prepare('DELETE  FROM suboneitems WHERE id = :id');
  $query->execute(['id'=>$id]);
  header("Location:suboneitem.php");
  exit();
}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>زیر آیتم های سطح یک</h3>
         <a href="new_suboneitem.php" class="btn btn-outline-primary">ایجاد زیر آیتم سطح یک </a>
       </div>
       <div class="table-responsive">
         <table class="table table-striped table-sm">
           <thead>
             <tr>
               <th>#</th>
               <th>عنوان</th>
               <th>آیتم</th>
               <th>کوتاه شده متن</th>
               <th>متن تصویر</th>
               <th>نویسنده</th>
               <th>تاریخ</th>
               <th>تنظیمات</th>
             </tr>
           </thead>
           <tbody>
             <?php
             if ($suboneitems->rowcount()>0) {
               foreach ($suboneitems as $suboneitem) {
                 $item_id = $suboneitem['itemid'];
                 $query_subone_item = "SELECT * FROM items WHERE id = $item_id";
                 $subone_item = $db->query($query_subone_item)->fetch();
                 ?>
                 <tr>
                   <td><?php echo $suboneitem['id'] ?></td>
                   <td><?php echo $suboneitem['title'] ?></td>
                   <td><?php echo $subone_item['title'] ?></td>
                   <td><?php echo substr($suboneitem['body'],0 ,200) ?></td>
                   <td><?php echo $suboneitem['image_body'] ?></td>
                   <td><?php echo $suboneitem['author'] ?></td>
                   <td><?php echo $suboneitem['date'] ?></td>
                   <td>
                     <a href="edit_suboneitem.php?id=<?php echo $suboneitem['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                     <a href="suboneitem.php?action=delete&id=<?php echo $suboneitem['id'] ?>" class="btn btn-outline-info">حذف</a>
                   </td>
                 </tr>
                 <?php
               }
             }else {
               ?>
               <div class="alert alert-danger" role="alert">
                 زیرآیتمی برای نمایش وجود ندارد!!!

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
