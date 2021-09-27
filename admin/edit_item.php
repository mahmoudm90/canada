<?php
include("./include/header.php");


if (isset($_GET['id'])) {
  $item_id = $_GET['id'];

  $item = $db->prepare("SELECT * FROM items WHERE id=:id");
  $item->execute(['id'=>$item_id]);
  $item = $item->fetch();

}




if (isset($_POST['edit_item'])) {
  if (trim($_POST['title'])!="" && trim($_POST['author'])!="" && trim($_POST['body'])!="") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $body = $_POST['body'];

    if (trim($_FILES['image']['name'])!="") {
      $name_image = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      if (move_uploaded_file($tmp_name, "../upload/items/$name_image")) {
        echo "Upload Success";
      }else {
        echo "Upload Error";
      }


      $item_insert = $db->prepare("UPDATE items SET title=:title, author=:author, body=:body, image=:image WHERE id=:id");
      $item_insert->execute(['title'=>$title, 'author'=>$author, 'body'=>$body, 'image'=>$name_image, 'id'=>$item_id]);

    }else {

      $item_insert = $db->prepare("UPDATE items SET title=:title, author=:author, body=:body WHERE id=:id");
      $item_insert->execute(['title'=>$title, 'author'=>$author, 'body'=>$body, 'id'=>$item_id]);




    }







    }else {
      header("Location:edit_item.php?id=$item_id&err_msg=تمام فیلدها الزامی است");
      exit();
    }

  }



 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ویرایش آیتم</h3>
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
           <label for="item">عنوان :</label>
           <input type="text" class="form-control" value="<?php echo $item['title'] ?>" name="title" id="item">
           <small class="form-text text-muted">نام آیتم را وارد کنید</small>
         </div>
         <div class="form-group">
           <label for="author">نویسنده :</label>
           <input type="text" name="author" value="<?php echo $item['author'] ?>"id="author" class="form-control">
           <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
         </div>

         <div class="form-group">
           <label for="body">متن آیتم: </label>
           <textarea class="form-control" name="body" id="body" rows="3">
             <?php echo $item['body'] ?>
           </textarea>
           <small class="form-text text-muted">متن آیتم را وارد کنید.</small>

         </div>
         <img src="../upload/items/<?php echo $item['image'] ?>" alt="">
         <div class="form-group">
           <label for="image">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط آیتم را ویرایش نمایید.</small>

         </div>

         <button type="submit" name="edit_item" class="btn btn-outline-primary">ویرایش</button>


       </form>
     </main>

   </div>

 </div>
 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.replace('body');

 </script>
