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
if (isset($_POST['add_item'])) {
  if (trim($_POST['title'])!="" && trim($_POST['author'])!="" && trim($_POST['body'])!="" && trim($_FILES['image']['name'])!="") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];
    $name_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($tmp_name, "../upload/items/$name_image")) {
      echo "Upload Success";
    }else {
      echo "Upload Error";
    }
    $item_insert = $db->prepare("INSERT INTO items(title, body, author,image) VALUES (:title, :body, :author, :image)");
    $item_insert->execute(['title'=>$title, 'body'=>$body, 'image'=>$name_image, 'author'=>$author]);

    header("Location:item.php");
    exit();
  }else {
    header("Location:new_item.php?err_msg=فیلد عنوان الزامی است");
    exit();
  }
}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ایجاد آیتم</h3>
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
       <form  method="post">
         <div class="form-group">
           <label for="item">عنوان :</label>
           <input type="text" class="form-control" name="title" id="category">
           <small class="form-text text-muted">نام آیتم را وارد کنی.</small>
         </div>
         <div class="form-group">
           <label for="author">نویسنده :</label>
           <input type="text" name="author" id="author" class="form-control">
           <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
         </div>

         <div class="form-group">
           <label for="body">متن آیتم: </label>
           <textarea class="form-control" name="body" id="body" rows="3">

           </textarea>
           <small class="form-text text-muted">متن آیتم را وارد کنید.</small>

         </div>
         <div class="form-group">
           <label for="image">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با آیتم مورد نظر را انتخاب نمایید.</small>

         </div>

         <button type="submit" name="add_item" class="btn btn-outline-primary">ایجاد</button>


       </form>
     </main>


   </div>

 </div>

 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.replace('body');

 </script>
