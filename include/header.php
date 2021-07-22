<?php
include("./include/config.php");
include("./include/db.php");

$query="SELECT * FROM items";
$items=$db->query($query);

// $querysubone="SELECT * FROM suboneitems";
// $suboneitems=$db->query($querysubone);



// if ($suboneitems->rowcount() > 0) {
//   foreach ($suboneitems as $suboneitem) {
//     $querysub1= "SELECT * FROM suboneitems WHERE itemid = 1";
//     $suboneitems=$db->query($querysub1);
//     if ($suboneitems->rowcount() > 0) {
//       foreach ($suboneitems as $suboneitem) {
//         echo $suboneitem['title'];
//       }
//     }
//   }
// }
 ?>


<!DOCTYPE html>
<html lang="fa" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Canada Deadline</title>
  </head>
<body>
<!--start header-->

<div class="wrapper">
    <nav class="navbar navbar-expand-md  px-3">
      <div class="container">
        <div class="logo">
          <a href="index.php" class="navbar-brand ">
            <img src="./img/download.jpg"  alt="logo image">
          </a>
        </div>
        <div class="">
          <h1 class="title">کانادا ددلاین</h1>
          <div class="">
            <nav>
                <ul>
                  <?php 
                  if ($items->rowcount() > 0) {
                     foreach ($items as $item) {
                      $a = $item['id'];
                      echo $a;

                      $querysubone= "SELECT * FROM suboneitems WHERE itemid = $a";
                      $suboneitems=$db->query($querysubone);

                    
                       ?>

                      <li class="nav-item <?php echo(isset($_GET['item']) && $item['id'] == $_GET['item'] ) ? "active" : ""; ?>">
                        <a href="index.php?item=<?php echo $item['id']?>"><?php
                         echo $item['title'] ?></a>
                       <ul>
                        <?php
                        if ($suboneitems->rowcount() > 0) {
                           foreach ($suboneitems as $suboneitem) {
                             ?>
                              <li class="nav-item">
                                <a href="index.php?suboneitem=<?php echo $suboneitem['id']?>"><?php 
                                echo $suboneitem['title']

                               ?>
                              
                              </a>
                            </li>
                            <?php 
                           }
                         } 


                         ?>
                         
                       </ul>
                      
                      </li>
                     <?php  
                     }
                   } 

                   ?>
                  
                </ul>
              </nav>

          </div>

        </div>
        <div class="left-header">
          <div class="nav-icons d-none d-md-block" id="social">
                <a href="#">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>
          </div>
            <!-- End social icon -->
          <div class="search">
            <form class="" action="index.html" method="post">
              <input type="text" name="" value="">
            </form>
          </div>

        </div>





      </div>

    </nav>