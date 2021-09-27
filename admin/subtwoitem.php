<?php
include("./include/header.php");

$query_subtwoitems = "SELECT * FROM subtwoitems ORDER BY id DESC";
$subtwoitems = $db->query($query_subtwoitems);

if (isset($_GET['action']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  $query = $db->prepare('DELETE  FROM subtwoitems WHERE id = :id');
  $query->execute(['id'=>$id]);
  header("Location:subtwoitem.php");
  exit();
}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>زیرآیتم ‌های سطح دو</h3>
         <a href="new_subtwoitem.php" class="btn btn-outline-primary">ایجاد زیرآیتم سطح دو </a>
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
             if ($subtwoitems->rowcount()>0) {
               foreach ($subtwoitems as $subtwoitem) {
                 $itemone_id = $subtwoitem['itemoneid'];
                 $query_subtwo_subone = "SELECT * FROM suboneitems WHERE id = $itemone_id";
                 $subtwo_subone = $db->query($query_subtwo_subone)->fetch();
                 ?>
                 <tr>
                   <td><?php echo $subtwoitem['id'] ?></td>
                   <td><?php echo $subtwoitem['title'] ?></td>
                   <td><?php echo $subtwo_subone['title']?></td>
                   <td><?php echo substr($subtwoitem['body'],0 ,200) ?></td>
                   <td><?php echo $subtwoitem['image_body'] ?></td>
                   <td><?php echo $subtwoitem['author'] ?></td>
                   <td><?php echo $subtwoitem['date'] ?></td>
                   <td>
                     <a href="edit_subtwoitem.php?id=<?php echo $subtwoitem['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                     <a href="subtwoitem.php?action=delete&id=<?php echo $subtwoitem['id'] ?>" class="btn btn-outline-info">حذف</a>
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
