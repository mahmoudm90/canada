<?php
include("./include/header.php");

$query_suboneitems = "SELECT * FROM suboneitems";
$suboneitems = $db->query($query_suboneitems);

if (isset($_POST['add_subtwoitem'])) {
  if (trim($_POST['title'])!="" && trim($_POST['author'])!="" && trim($_POST['suboneitem_id'])!="" && trim($_POST['body'])!="" && trim($_FILES['image']['name'])!="") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $suboneitem_id = $_POST['suboneitem_id'];
    $body = $_POST['body'];

    $name_image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    if (move_uploaded_file($tmp_name, "../upload/subtwoitems/$name_image")) {
      echo "Upload Success";
    }else {
      echo "Upload Error";
    }

    $subtwoitem_insert = $db->prepare("INSERT INTO subtwoitems(title, author, itemoneid, body, image) VALUES (:title, :author, :suboneitem_id, :body, :image)");
    $subtwoitem_insert->execute(['title'=>$title, 'author'=>$author, 'suboneitem_id'=>$suboneitem_id, 'body'=>$body, 'image'=>$name_image]);

    header("Location:subtwoitem.php");
    exit();


  }else {
    header("Location:new_subtwoitem.php?err_msg= تمام فیلدها الزامی است");
    exit();
  }
}
 ?>
 <div class="container-fluid">
   <div class="row">
     <?php include("./include/sidebar.php") ?>
     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       <div class="d-flex justify-content-between mt-5">
         <h3>ایجاد زیرآیتم سطح دو</h3>
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
           <label for="title">عنوان :</label>
           <input type="text" class="form-control" name="title" id="title">
           <small class="form-text text-muted">نام زیرآیتم سطح دو را وارد نمایید.</small>
         </div>
         <div class="form-group">
           <label for="author">نویسنده :</label>
           <input type="text" name="author" id="author" class="form-control">
           <small class="form-text text-muted">نام نویسنده را وارد کنید.</small>
         </div>
         <div class="form-group">
           <label for="itemone">آیتم:</label>
           <select class="form-control" name="suboneitem_id" id="itemone">
             <?php
             if ($suboneitems->rowcount()>0) {
               foreach ($suboneitems as $suboneitem) {
                 ?>
                 <option value="<?php echo $suboneitem['id'] ?>"><?php echo $suboneitem['title'] ?></option>
                 <?php
               }
             }

              ?>

           </select>

         </div>
         <div class="form-group">
           <label for="category">متن زیرآیتم سطح دو : </label>
           <textarea class="form-control" name="body" id="body" rows="3">

           </textarea>
           <small class="form-text text-muted">متن زیر آیتم سطح دو را وارد نمایید.</small>

         </div>

         <div class="form-group">
           <label for="author">تصویر :</label>
           <input type="file" name="image" class="form-control" id="image">
           <small class="form-text text-muted">تصویر مرتبط با زیرآیتم سطح دو خود را وارد نمایید.</small>

         </div>
         <button type="submit" name="add_subtwoitem" class="btn btn-outline-primary">ایجاد</button>


       </form>
     </main>

   </div>

 </div>
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace('body');

</script>
