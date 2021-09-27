<?php
include("./include/header.php");


if (isset($_GET['id'])) {
  $suboneitem_id = $_GET['id'];

  $suboneitem = $db->prepare("SELECT * FROM suboneitems WHERE id=:id");
  $suboneitem->execute(['id'=>$suboneitem_id]);
  $suboneitem = $suboneitem->fetch();

  $query_items = "SELECT * FROM items";
  $items = $db->query($query_items);
}

if (isset($_POST['edit_suboneitem'])) {
  if (trim($_POST['title'])!="" && trim($_POST['author'])!="" && trim($_POST['item_id'])!="" && trim($_POST['body'])!="") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $item_id = $_POST['item_id'];
    $body = $_POST['body'];

    if (trim($_FILES['image']['name'])!="") {
      $name_image = $_FILES['image']['name'];
      $tmp_name = $_FILES['image']['tmp_name'];
      if (move_uploaded_file($tmp_name, "../upload/suboneitems/$name_image")) {
        echo "Upload Success";
      }else {
        echo "Upload Error";
      }

      $suboneitem_insert = $db->prepare("UPDATE suboneitems SET title=:title, author=:author, itemid=:item_id, body=:body, image=:image WHERE id=:id");
      $suboneitem_insert->execute(['title'=>$title, 'author'=>$author, 'item_id'=>$item_id, 'body'=>$body, 'image'=>$name_image, 'id'=>$suboneitem_id]);

    }else {
      $suboneitem_insert = $db->prepare("UPDATE suboneitems SET title=:title, author=:author, itemid=:item_id, body=:body WHERE id=:id");
      $suboneitem_insert->execute(['title'=>$title, 'author'=>$author, 'item_id'=>$item_id, 'body'=>$body, 'id'=>$suboneitem_id]);

    }
  }else {
    header("Location:edit_suboneitem.php?id=$suboneitem_id&err_msg=تمام فیلدها الزامی است");
    exit();
  }
}

 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ویرایش زیرآیتم سطح یک</h3>
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
           <input type="text" class="form-control" value="<?php echo $suboneitem['title'] ?>" name="title" id="title">
           <small class="form-text text-muted">نام زیرآیتم سطح یک را وارد نمایید.</small>
         </div>
         <div class="form-group">
           <label for="author">نویسنده :</label>
           <input type="text" name="author" value="<?php echo $suboneitem['author'] ?>"id="author" class="form-control">
           <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
         </div>
         <div class="form-group">
           <label for="item">آیتم:</label>
           <select class="form-control" name="item_id" id="item">
             <?php
             if ($items->rowcount()>0) {
               foreach ($items as $item) {
                 ?>
                 <option value="<?php echo $item['id'] ?>"<?php echo ($item['id']==$suboneitem['itemid']) ? "selected" : "" ?>><?php echo $item['title'] ?></option>
                 <?php
               }
             }

              ?>

           </select>

         </div>
         <div class="form-group">
           <label for="category">متن زیرآیتم سطح یک : </label>
           <textarea class="form-control" name="body" id="body" rows="3">
             <?php echo $suboneitem['body'] ?>
           </textarea>
           <small class="form-text text-muted">متن زیر آیتم سطح یک را وارد نمایید.</small>

         </div>
         <img src="../upload/suboneitems/<?php echo $suboneitem['image'] ?>" alt="">
         <div class="form-group">
           <label for="author">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با زیرآیتم سطح یک خودرا وارد نماییدو.</small>

         </div>
         <button type="submit" name="edit_suboneitem" class="btn btn-outline-primary">ویرایش</button>


       </form>
     </main>

   </div>

 </div>
 <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
 <script>
 CKEDITOR.replace('body');

 </script>
