<?php
session_start();
@include 'confirmDB.php';
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}





if (isset($_POST['send'])) {

    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $Subject = mysqli_real_escape_string($conn, $_POST['Subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $select_message = mysqli_query($conn, "SELECT * FROM `contact_books` WHERE first_name = '$first_name'  AND last_name = '$last_name' AND email = '$email' AND Subject = '$Subject' AND message = '$message'") or die('query failed');

    if (mysqli_num_rows($select_message) > 0) {
        echo 'message sent already!';
    } else {
        mysqli_query($conn, "INSERT INTO `contact_books`(first_name, last_name, email, Subject, message) VALUES( '$first_name', '$last_name', '$email', '$Subject',  '$message')") or die('query failed');
        echo 'message sent successfully!';
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title> Registre </title>
    <link rel="stylesheet" href="../Style/style_login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome link  -->
    <link rel="stylesheet" href="file:///C:/Users/YOUSSEF_HB/Desktop/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

</head>

<body>
    <!-- section header -->
    <?php
    @include 'header.php'
    ?>

    <div class="login">
        <div class="container" style="margin-left: 340px;">
            <div class="title">Message</div>
            <div class="content">
                <form action="" method="post">
                    <div class="user-details">
                        <div class="input-box">
                            <span class="details">first name</span>
                            <input type="text" name="first_name" placeholder="Enter your first name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">last name</span>
                            <input type="text" name="last_name" placeholder="Enter your last name" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Email</span>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Subject</span>
                            <input type="text" name="Subject" placeholder="Enter your Subject" required>
                        </div>
                        <div class="input-box">
                            <span class="details">Message</span>
                            <textarea style="  resize: none;width: 63rem;height: 200px;" placeholder=" Enter your Message" name="message" required></textarea>
                        </div>
                    </div>
                    <div class="button">
                        <input type="submit" name="send" value="Send message">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- section footer -->
    <?php
    @include 'footer.php'
    ?>
</body>

</html>