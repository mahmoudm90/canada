<?php
include("./include/header.php");

$query_steps_items = "SELECT * FROM steps_items ORDER BY id DESC";
$steps = $db->query($query_steps_items);

if (isset($_GET['action']) && isset($_GET['id'])) {


  $id = $_GET['id'];

  $query = $db->prepare('DELETE  FROM steps_items WHERE id = :id');
  $query->execute(['id'=>$id]);

  header("Location:stepitem.php");
  exit();

}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
          <h3>مراحل</h3>
          <a href="new_stepitem.php"> ایجاد استپ جدید</a>
       </div>





<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>آیتم</th>
        <th>متن تصویر</th>
        <th>کلاس</th>
        <th>خلاصه متن</th>
        <th>نویسنده</th>
        <th>تاریخ</th>
        <th>تنظیمات</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($steps->rowcount()>0) {

        foreach ($steps as $step) {
          $item_id = $step['item_id'];
          $query_step_item = "SELECT * FROM items WHERE id = $item_id";
          $step_item = $db->query($query_step_item)->fetch();
          ?>
          <tr>
            <td><?php echo $step['id'] ?></td>
            <td><?php echo $step['title'] ?></td>
            <td><?php echo $step_item['title'] ?></td>
            <td><?php echo $step['body_image'] ?></td>
            <td><?php echo $step['class'] ?></td>
            <td><?php echo substr($step['body'],0 ,200) ?></td>
            <td><?php echo $step['author'] ?></td>
            <td><?php echo $step['date'] ?></td>
            <td>
              <a href="edit_stepitem.php?id=<?php echo $step['id'] ?>" class="btn btn-outline-info">ویرایش</a>
              <a href="stepitem.php?action=delete&id=<?php echo $step['id'] ?>" class="btn btn-outline-info">حذف</a>
            </td>
          </tr>
          <?php

        }
      }else {
        ?>
        <div class="alert alert-danger" role="alert">
          مرحله ای برای نمایش وجود ندارد!!!

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
