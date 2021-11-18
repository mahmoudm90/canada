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
    <nav class="navbar navbar-expand-md px-3">


        <div class="logo">
          <a href="index.php" class="navbar-brand ">
            <img src="./img/download.jpg"  alt="logo image">
          </a>
        </div>
        <div class="menu-items">
          <h1 class="title center">کانادا ددلاین</h1>
          <div class="">
            <nav>
                <ul>
                  <?php
                  if ($items->rowcount() > 0) {
                     foreach ($items as $item) {
                      $a = $item['id'];


                      $querysubone= "SELECT * FROM suboneitems WHERE itemid = $a";
                      $suboneitems=$db->query($querysubone);


                       ?>

                      <li class="nav-item <?php echo(isset($_GET['item']) && $item['id'] == $_GET['item'] ) ? "active" : ""; ?>">
                        <?php
                        if ($item['id'] < 4) {
                          ?>
                          <a href="menu-item.php?item=<?php echo $item['id']?>"><?php
                          echo $item['title'] ?></a>
                          <?php
                        }elseif ($item['id'] == 4) {
                          ?>
                          <a href="news.php"><?php
                          echo $item['title'] ?></a>
                          <?php
                        }
                        else{
                          ?>
                          <a href="subitem.php?item=<?php echo $item['id']?>"><?php
                          echo $item['title'] ?></a>
                          <?php

                        }




                         ?>

                       <ul>
                        <?php
                        if ($suboneitems->rowcount() > 0) {
                          $count = 0;
                           foreach ($suboneitems as $suboneitem) {
                            $count = $count + 1;
                            $b = $suboneitem['id'];
                            $querysubtwo= "SELECT * FROM subtwoitems WHERE itemoneid = $b";
                            $subtwoitems=$db->query($querysubtwo);
                            $c = $subtwoitems->rowcount();


                             ?>
                              <li class="nav-item">
                                <a href="subitem.php?suboneitem=<?php echo $suboneitem['id']?>"><?php
                                echo $suboneitem['title']

                               ?>

                              </a>
                              <?php
                              if ($count < 4) {
                                if ($c < 5) {
                                  ?>
                                  <ul>
                                    <?php
                                    if ($subtwoitems->rowcount() > 0) {
                                      foreach ($subtwoitems as $subtwoitem) {
                                        ?>
                                        <li class="nav-item">
                                          <a href="subitem.php?subtwoitem=<?php echo $subtwoitem['id'] ?>"><?php echo $subtwoitem['title']; ?></a>
                                        </li>
                                        <?php
                                      }
                                    }


                                     ?>

                                  </ul>
                                  <?php
                                }else {
                                  ?>
                                  <ul class="subonemin4twomin5">
                                    <?php
                                    if ($subtwoitems->rowcount() > 0) {
                                      foreach ($subtwoitems as $subtwoitem) {
                                        ?>
                                        <li class="nav-item">
                                          <a href="subitem.php?subtwoitem=<?php echo $subtwoitem['id'] ?>"><?php echo $subtwoitem['title']; ?></a>
                                        </li>
                                        <?php
                                      }
                                    }


                                     ?>

                                  </ul>
                                  <?php
                                }




                              }else{
                                if ($c < 3) {
                                  ?>
                                  <ul class="">
                                    <?php
                                    if ($subtwoitems->rowcount() > 0) {
                                      foreach ($subtwoitems as $subtwoitem) {
                                        ?>
                                        <li class="nav-item">
                                          <a href="subitem.php?subtwoitem=<?php echo $subtwoitem['id'] ?>"><?php echo $subtwoitem['title']; ?></a>
                                        </li>
                                        <?php
                                      }
                                    }


                                     ?>

                                  </ul>
                                  <?php
                                }else {
                                  ?>
                                  <ul class="subtwomin5">
                                    <?php
                                    if ($subtwoitems->rowcount() > 0) {
                                      foreach ($subtwoitems as $subtwoitem) {
                                        ?>
                                        <li class="nav-item">
                                          <a href="subitem.php?subtwoitem=<?php echo $subtwoitem['id'] ?>"><?php echo $subtwoitem['title']; ?></a>
                                        </li>
                                        <?php
                                      }
                                    }


                                     ?>

                                  </ul>
                                  <?php
                                }
                              }

                               ?>

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
            <form class="" action="search.php" method="post">
              <div>
                <input type="text" name="searchword" placeholder="جستجو...">
                <button type="submit" class="searchbutton" name="search" value=""><i class="fa fa-search"></i></button>

              </div>

            </form>
          </div>

        </div>

    </nav>
