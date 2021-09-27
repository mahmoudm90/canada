<?php
include("./include/header.php");

$query_items = "SELECT * FROM items";
$items = $db->query($query_items);

if (isset($_POST['add_stepitem'])) {
  if (trim($_POST['title'])!="" && trim($_POST['class'])!="" &&trim($_POST['author'])!="" && trim($_POST['item_id'])!="" && trim($_POST['body_image'])!="" && trim($_POST['body'])!="") {
    $title = $_POST['title'];
    $class = $_POST['class'];
    $item_id = $_POST['item_id'];
    $body_image = $_POST['body_image'];
    $body = $_POST['body'];
    $author = $_POST['author'];

    $name_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($tmp_name, "../upload/stepsitems/$name_image")) {
      echo "Upload Success";
    }else {
      echo "Upload Error";
    }

    $stepitem_insert = $db->prepare("INSERT INTO steps_items(title, author, item_id, body, class, body_image, image) VALUES (:title, :author, :item_id, :body, :class, :body_image, :image)");
    $stepitem_insert->execute(['title'=>$title, 'class'=>$class, 'item_id'=>$item_id, 'body_image'=>$body_image, 'image'=>$name_image, 'body'=>$body, 'author'=>$author,]);

    header("Location:stepitem.php");
    exit();


  }else {
    header("Location:new_stepitem.php?err_msg= تمام فیلدها الزامی است");
    exit();
  }
}
 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ایجاد مرحله آیتم</h3>
       </div>
       <hr>
       <?php
       if (isset($_GET['err_msg'])) {
         ?>
         <div class="alert alert-danger" role="alert">
           <?php echo $_GET['err_msg'] ?>
         </div>
         <?php
       }
        ?>
       <form class="mb-5" method="post" enctype="multipart/form-data">
         <div class="form-group">
           <label for="category">عنوان :</label>
           <input type="text" class="form-control" name="title" id="title">
           <small class="form-text text-muted">عنوان مرحله را وارد کنید.</small>
         </div>
         <div class="form-group">
           <label for="class">نام کلاس : </label>
           <input type="text" name="class" id="class" class="form-control">
           <small class="form-text text-muted">نام کلاس مربوطه را وارد نمایید.</small>
         </div>
         <div class="form-group">
           <label for="author">نام نویسنده : </label>
           <input type="text" name="author" id="author" class="form-control">
           <small class="form-text text-muted">نام نویسنده را وارد نمایید.</small>
         </div>

         <div class="form-group">
           <label for="item">آیتم:</label>
           <select class="form-control" name="item_id" id="item">
             <?php
             if ($items->rowcount()>0) {
               foreach ($items as $item) {
                 ?>
                 <option value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
                 <?php
               }
             }

              ?>

           </select>

         </div>
         <div class="form-group">
           <label for="body_image">متن کپشن عکس مرحله </label>
           <textarea class="form-control" name="body_image" id="body_image" rows="3">

           </textarea>
           <small class="form-text text-muted">کپشن عکس مرحله را وارد نمایید.</small>

         </div>
         <div class="form-group">
           <label for="body">متن مرحله :</label>
           <textarea class="form-control" name="body" id="body" rows="3">

           </textarea>
           <small class="form-text text-muted">متن مرحله را وارد نمایید.</small>

         </div>

         <div class="form-group">
           <label for="image">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با مرحله را وارد نمایید.</small>

         </div>
         <button type="submit" name="add_stepitem" class="btn btn-outline-primary">ایجاد</button>


       </form>
     </main>

   </div>

 </div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('body');
CKEDITOR.replace('body_image');
</script>
