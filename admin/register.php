<?php
session_start();
include("./include/config.php");
include("./include/db.php");

if (isset($_POST['login'])) {
  if (trim($_POST['email'])!="" and trim($_POST['firstname'])!="" and trim($_POST['lastname'])!="" and trim($_POST['password1'])!="" and trim($_POST['password2'])!=""){
   
    
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];
    // var_dump($fname);
    // var_dump($lname);
    // var_dump($email);
    // var_dump($password1);
    // var_dump($password2);



    if ($password1 == $password2) {

        $query = "INSERT INTO `admins` (`firstname`, `lastname`, `email`, `password`) VALUES(:fname, :lname, :email, :password)";
        $user_insert = $db->prepare($query);
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        
        $params = ['fname'=>$fname, 'lname'=>$lname, 'password'=>$password1, 'email'=>$email];
        $user_insert->execute($params);

        // var_dump($user_insert);
        // echo $user_insert->rowcount() ."Records inserted";
        header("Location:signin.php");
        exit();
    }else{
        header("Location:register.php?err_msg=لطفا پسورد یکسان انتخاب کنید.");
        exit();
    }

   

    // if ($user_select->rowCount() == 1) {
    //        $_SESSION['email'] = $email;
    //        header("Location:index.php");
    //        exit();
    //    }



  }else {
    header("Location:register.php?err_msg=پر کردن تمام فیلدها لزامی است");
    exit();
  }
}
 ?>



<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/admin.css" />

    <title>Canadadeadlinecom-login</title>
</head>

<body>
    <div class="container">

        <div class="row d-flex justify-content-center align-items-center" style="height: 100vh">
            <div class="card bg-light">
                <?php
                if (isset($_GET['err_msg'])) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $_GET['err_msg'] ?>
                    </div>
                <?php
                }
                ?>
                <h3 class="text-center pt-3">ثبت نام</h2>
                    <div class="card-body" style="width: 400px">
                        <form method="post">
                            <div class="form-group">
                                <label class="" for="email">نام</label>
                                <input type="text" class="form-control" name="firstname" id="email" placeholder="نام خود را وارد کنید.">
                            </div>
                            <div class="form-group">
                                <label class="" for="email">نام خانوادگی</label>
                                <input type="text" class="form-control" name="lastname" id="email" placeholder="نام خانوادگی خود را وارد نمایید.">
                            </div>
                            <div class="form-group">
                                <label class="" for="email">ایمیل</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="ایمیل خود را وارد کنید.">
                            </div>
                            <div class="form-group">
                                <label class="" for="password1">رمز عبور</label>
                                <input type="password" class="form-control" name="password1" id="password1" placeholder="رمز عبور خود را وارد نمایید.">
                            </div>
                            <div class="form-group">
                                <label class="" for="password2">تکرار رمز عبور</label>
                                <input type="password" class="form-control" name="password2" id="password2" placeholder="رمز عبور خود را مجددا وارد نمایید.">
                            </div>

                            <button type="submit" name="login" class="btn btn-outline-primary btn-block">ثبت نام</button><br>
                           
                        </form>
                    </div>

            </div>
        </div>
    </div>
</body>
</html>