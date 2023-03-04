<?php


session_start();
error_reporting(0);
@include '../configDB.php';




if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);

    if ($password == $cpassword) {
        $sql = "SELECT * FROM custmer WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO custmer (first_name, last_name, city, email, password) VALUES ('$first_name', '$last_name', '$city', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo '<div class="message"><span>Your Completed the Registration. </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
                header("Location: login.php");
                $first_name = "";
                $last_name = "";
                $city = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo '<div class="message"><span>Something Wrong Went. </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
            }
        } else {
            echo '<div class="message"><span>Email Already Exists </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
    } else {
        echo '<div class="message"><span>Password Not Matched. </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
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
        <div class="container">
            <div class="title">Create Account </div>
            <div class="content">
                <form action="" method="post">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">First Name</span>
                            <input type="text" name="first_name" placeholder="Enter your name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Last Name</span>
                            <input type="text" name="last_name" placeholder="Enter your username" required>
                        </div>
                        <div class="input-box">
                            <span class="details">City</span>
                            <input type="text" name="city" placeholder="Enter your City" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Password</span>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Confirm Password</span>
                            <input type="password" name="cpassword" placeholder="Confirm your password" required>
                        </div>
                    </div>
                    <p class="title-signin">Already have an account? <span><a href="login.php">Sign In</a></span></p>
                    <div class="button">
                        <input type="submit" name="submit" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
    </div>