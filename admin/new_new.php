<?php
include("./include/header.php");

// if (isset($_GET['id'])) {
//   $category_id = $_GET['id'];
//
//   $category = $db->prepare("SELECT * FROM categories WHERE id=:id");
//   $post->execute(['id'=>$category_id]);
//   $category = $category->fetch();
//
//   $query_categories = "SELECT * FROM categories";
//   $categories = $db->query($query_categories);
// }
if (isset($_POST['add_new'])) {
  if (trim($_POST['title'])!="" && trim($_POST['body'])!="" && trim($_FILES['image']['name'])!="" && trim($_POST['date'])!="") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $body = $_POST['body'];
    $name_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($tmp_name, "../upload/news/$name_image")) {
      echo "Upload Success";
    }else {
      echo "Upload Error";
    }
    $new_insert = $db->prepare("INSERT INTO news(title, body, image, datee) VALUES (:title, :body, :image, :datee)");
    $new_insert->execute(['title'=>$title, 'body'=>$body, 'image'=>$name_image, 'datee'=>$date]);

    header("Location:news.php");
    exit();
  }else {
    header("Location:new_new.php?err_msg=فیلد عنوان الزامی است");
    exit();
  }
}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ایجاد خبر جدید</h3>
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
           <label for="new">عنوان :</label>
           <input type="text" class="form-control" name="title" id="new">
           <small class="form-text text-muted">عنوان خبر را وارد نمایید:</small>
         </div>


         <div class="form-group">
           <label for="body">متن خبر :</label>
           <textarea class="form-control" name="body" id="body" rows="3">
             
           </textarea>
           <small class="form-text text-muted">متن خبر را وارد کنید.</small>

         </div>

         <div class="form-group">
           <label for="image">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با خبر را وارد نمایید:</small>

         </div>
         <div class="form-group">
           <label for="date">تاریخ : </label>
           <input type="text" class="form-control" name="date" id="date">
           <small class="form-text text-muted">تاریخ خبر را وارد نمایید.</small>
         </div>


         <button type="submit" name="add_new" class="btn btn-outline-primary">ایجاد</button>


       </form>
     </main>

   </div>

 </div>

 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.replace('body');

 </script>
