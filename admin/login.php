<?php
require_once '../config/dbcon.php';
session_start();

if(isset($_SESSION['email'])){
    header('location: index.php');
}

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $error = [];

    if(empty($email)){
        $error['email'] = "Email field is required!";
    }
    if(empty($password)){
        $error['password'] = "Password field is required!";
    }

    if(empty($error)){
        $email_check = mysqli_query($con, "SELECT `id`, `name`, `password`, `status` FROM `users` WHERE `email`='$email'");
        if(mysqli_num_rows($email_check) == 1){
            $user_info = mysqli_fetch_assoc($email_check);
            if($user_info['password'] == md5($password)){
                if($user_info['status'] == 1){
                    $_SESSION['email'] = $email;
                    $_SESSION['u_id'] = $user_info['id'];
                    $_SESSION['name'] = $user_info['name'];
                    header('location: index.php');
                }else{
                    $status_error = "Your account is not activated. please wait till an admin activate your account!";
                }
            }else{
                $info_error = "User credential doesn't match!";
            }
        }else{
            $info_error = "User credential doesn't match!";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row justify-content-md-center">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" name="email" id="email"
                        value="<?= isset($email) ? $email : '' ?>">
                        <p class="text-danger"><?php if(isset($error['email'])){ echo $error['email']; } ?></p>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <p class="text-danger"><?php if(isset($error['password'])){ echo $error['password']; } ?></p>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                    <p class="text-danger mt-3"><?php if(isset($info_error)){ echo $info_error; } ?></p>
                    <p class="text-danger mt-3"><?php if(isset($status_error)){ echo $status_error; } ?></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>