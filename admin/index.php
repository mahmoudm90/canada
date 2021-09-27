<?php
include("./include/header.php");


$query_items = "SELECT * FROM items ORDER BY id DESC";
$items = $db->query($query_items);


$query_suboneitems = "SELECT * FROM suboneitems  ORDER BY id DESC";
$suboneitems = $db->query($query_suboneitems);

$query_subtwoitems = "SELECT * FROM subtwoitems ORDER BY id DESC";
$subtwoitems = $db->query($query_subtwoitems);

$query_news = "SELECT * FROM news ORDER BY id DESC";
$news = $db->query($query_news);

$query_steps = "SELECT * FROM steps_items ORDER BY id DESC";
$steps = $db->query($query_steps);

if (isset($_GET['entity']) && isset($_GET['action']) && isset($_GET['id'])) {
  $entity = $_GET['entity'];
  $action = $_GET['action'];
  $id = $_GET['id'];

  if ($action == 'delete') {
    if ($entity == 'item') {
      $query = $db->prepare('DELETE  FROM items WHERE id = :id');
    }elseif ($entity == 'suboneitem') {
      $query =$db->prepare('DELETE  FROM suboneitems WHERE id = :id');
    }
    elseif ($entity == 'subtwoitem') {
      $query =$db->prepare('DELETE  FROM subtwoitems WHERE id = :id');
    }
    elseif ($entity == 'new') {
      $query =$db->prepare('DELETE  FROM news WHERE id = :id');
    }
    else  {
      $query =$db->prepare('DELETE  FROM steps_items WHERE id = :id');
    }

    $query->execute(['id'=>$id]);
  }

}
 ?>
<div class="container-fluid">
  <div class="row">
    <?php include("./include/sidebar.php") ?>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
        <h1 class="h2">داشبورد</h1>
      </div><br>
      <h3>آیتم‌های اخیر</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>عنوان</th>
              <th>کوتاه شده متن</th>
              <th>نویسنده</th>
              <th>تاریخ</th>
              <th>تنظیمات</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($items->rowcount()>0) {
              foreach ($items as $item) {
                ?>
                <tr>
                  <td><?php echo $item['id'] ?></td>
                  <td><?php echo $item['title'] ?></td>
                  <td><?php echo substr($item['body'], 0, 200) ?></td>
                  <td><?php echo $item['author'] ?></td>
                  <td><?php echo $item['date'] ?></td>
                  <td>
                    <a href="edit_item.php?id=<?php echo $item['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                    <a href="index.php?entity=item&action=delete&id=<?php echo $item['id'] ?>" class="btn btn-outline-info">حذف</a>
                  </td>
                </tr>
                <?php
              }
            }else {
              ?>
              <div class="alert alert-danger" role="alert">
                آیتمی برای نمایش وجود ندارد!!!

              </div>
              <?php
            }
            ?>
          </tbody>
        </table>

      </div>
      <h3>زیرآیتم‌های سطح یک</h3>
      <br>
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
                $query_items = "SELECT * FROM items ORDER BY id DESC";
                $items = $db->query($query_items);
                while ($row = $items->fetch()) {
                  if ($row['id'] == $suboneitem['itemid']) {
                    $a = $row['title'];
                    break;
                  }
                }
                ?>
                <tr>
                  <td><?php echo $suboneitem['id'] ?></td>
                  <td><?php echo $suboneitem['title'] ?></td>
                  <td><?php echo $a ?></td>
                  <td><?php echo substr($suboneitem['body'],0 ,200) ?></td>
                  <td><?php echo $suboneitem['image_body'] ?></td>
                  <td><?php echo $suboneitem['author'] ?></td>
                  <td><?php echo $suboneitem['date'] ?></td>
                  <td>
                    <a href="edit_suboneitem.php?id=<?php echo $suboneitem['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                    <a href="index.php?entity=suboneitem&action=delete&id=<?php echo $suboneitem['id'] ?>" class="btn btn-outline-info">حذف</a>
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
      <h3>زیرآیتم‌های سطح دو</h3>
      <br>
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
                $query_suboneitems = "SELECT * FROM suboneitems  ORDER BY id DESC";
                $suboneitems = $db->query($query_suboneitems);
                while ($row = $suboneitems->fetch()) {
                  if ($row['id'] == $subtwoitem['itemoneid']) {
                    $b = $row['title'];
                    break;
                  }
                }
                ?>
                <tr>
                  <td><?php echo $subtwoitem['id'] ?></td>
                  <td><?php echo $subtwoitem['title'] ?></td>
                  <td><?php echo $b ?></td>
                  <td><?php echo substr($subtwoitem['body'],0 ,200) ?></td>
                  <td><?php echo $subtwoitem['image_body'] ?></td>
                  <td><?php echo $subtwoitem['author'] ?></td>
                  <td><?php echo $subtwoitem['date'] ?></td>
                  <td>
                    <a href="edit_subtwoitem.php?id=<?php echo $subtwoitem['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                    <a href="index.php?entity=subtwoitem&action=delete&id=<?php echo $subtwoitem['id'] ?>" class="btn btn-outline-info">حذف</a>
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
      <h3>خبرها</h3>
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>عنوان</th>
              <th>خلاصه متن</th>
              <th>تاریخ</th>
              <th>تنظیمات</th>
            </tr>
          </thead>
          <tbody>
            <?php
            if ($news->rowcount()>0) {
              foreach ($news as $new) {
                ?>
                <tr>
                  <td><?php echo $new['id'] ?></td>
                  <td><?php echo $new['title'] ?></td>
                  <td><?php echo substr($new['body'],0 ,200) ?></td>
                  <td><?php echo $new['date'] ?></td>
                  <td>
                    <a href="edit_news.php?id=<?php echo $new['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                    <a href="index.php?entity=new&action=delete&id=<?php echo $new['id'] ?>" class="btn btn-outline-info">حذف</a>
                  </td>
                </tr>
                <?php

              }
            }else {
              ?>
              <div class="alert alert-danger" role="alert">
              خبری برای نمایش وجود ندارد!!!

              </div>
              <?php
            }
            ?>


          </tbody>

        </table>

      </div>
      <h3>مراحل</h3>
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
                $query_items = "SELECT * FROM items ORDER BY id DESC";
                $items = $db->query($query_items);
                while ($row = $items->fetch()) {
                  if ($row['id'] == $step['item_id']) {
                    $c = $row['title'];
                    break;
                  }
                }
                ?>
                <tr>
                  <td><?php echo $step['id'] ?></td>
                  <td><?php echo $step['title'] ?></td>
                  <td><?php echo $c ?></td>
                  <td><?php echo $step['body_image'] ?></td>
                  <td><?php echo $step['class'] ?></td>
                  <td><?php echo substr($step['body'],0 ,200) ?></td>
                  <td><?php echo $step['author'] ?></td>
                  <td><?php echo $step['date'] ?></td>
                  <td>
                    <a href="edit_stepitem.php?id=<?php echo $step['id'] ?>" class="btn btn-outline-info">ویرایش</a>
                    <a href="index.php?entity=step&action=delete&id=<?php echo $step['id'] ?>" class="btn btn-outline-info">حذف</a>
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
