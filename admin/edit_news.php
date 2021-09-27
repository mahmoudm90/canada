<?php
include("./include/header.php");


if (isset($_GET['id'])) {
  $new_id = $_GET['id'];

  $new = $db->prepare("SELECT * FROM news WHERE id=:id");
  $new->execute(['id'=>$new_id]);
  $new = $new->fetch();

}




if (isset($_POST['edit_new'])) {
  if (trim($_POST['title'])!="" && trim($_POST['date'])!="" && trim($_POST['body'])!="") {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $body = $_POST['body'];

    if (trim($_FILES['image']['name'])!="") {
      $name_image = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      if (move_uploaded_file($tmp_name, "../upload/news/$name_image")) {
        echo "Upload Success";
      }else {
        echo "Upload Error";
      }

      $new_insert = $db->prepare("UPDATE news SET title=:title, body=:body, image=:image, datee=:datee WHERE id=:id");
      $new_insert->execute(['title'=>$title, 'datee'=>$date, 'body'=>$body, 'image'=>$name_image, 'id'=>$new_id]);

    }else {
      $new_insert = $db->prepare("UPDATE news SET title=:title, datee=:datee, body=:body WHERE id=:id");
      $new_insert->execute(['title'=>$title, 'datee'=>$date, 'body'=>$body, 'id'=>$new_id]);




    }


    }else {
      header("Location:edit_new.php?id=$new_id&err_msg=تمام فیلدها الزامی است");
      exit();
    }

  }



 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ویرایش خبر</h3>
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
           <input type="text" class="form-control" value="<?php echo $new['title'] ?>" name="title" id="new">
           <small class="form-text text-muted">نام آیتم را وارد کنید</small>
         </div>


         <div class="form-group">
           <label for="body">متن خبر :</label>
           <textarea class="form-control" name="body" id="body" rows="3">
             <?php echo $new['body'] ?>
           </textarea>
           <small class="form-text text-muted">متن خبر را وارد کنید.</small>

         </div>
         <img src="../upload/news/<?php echo $new['image'] ?>" alt="">
         <div class="form-group">
           <label for="image">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با زیرآیتم سطح یک خودرا وارد نماییدو.</small>

         </div>
         <div class="form-group">
           <label for="date">تاریخ : </label>
           <input type="text" class="form-control" value="<?php echo $new['datee'] ?>" name="date" id="date">
           <small class="form-text text-muted">تاریخ خبر را اصلاح نمایید.</small>
         </div>


         <button type="submit" name="edit_new" class="btn btn-outline-primary">ویرایش</button>


       </form>
     </main>

   </div>

 </div>
 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 // CKEDITOR.replace('body');

 </script>
