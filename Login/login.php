<?php

// Start a new or resume an existing session
session_start();



error_reporting(0);

@include '../configDB.php';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "SELECT * FROM admin_book WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['is_admin'] = true;
        header("Location: ../Pages_Admin/book_admin.php");
    }
    if (isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM custmer WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            header("Location: ../Pages_Users/index_book.php");
        } else {
            echo '<div class="message"><span> Error in Email or Password. </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
    }
}



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link style -->
    <link rel="stylesheet" href="../Style/style_login.css">
</head>
<body>

    <div class="login">
        <div class="image">
            <img src="image/blog_2.jpg" alt="">
        </div>
        <div class="container">
            <div class="title">Create Account </div>
            <div class="content">
                <form action="" method="post">
                    <div class="user-details" style="display: inline-block;display: inline-block;">
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" name="email" placeholder="Enter your email" style="width: 30rem;" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" name="password" placeholder="Enter your password" style="width: 30rem;" required>
                        </div>
                    </div>
                    <p class="title-signin">I don't have an account? <span><a href="register.php">Sign Up</a></span></p>
                    <div class="button">
                        <input type="submit" name="submit" value="Sign In" style="width: 30rem;">
                    </div>
                </form>
            </div>
        </div>
    </div>