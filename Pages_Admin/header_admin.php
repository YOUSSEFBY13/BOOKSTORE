<?php
session_start();
@include '../configDB.php';
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: ../login/login.php");
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Style Link -->
    <link rel="stylesheet" href="../Style/style_admin.css">
    <!-- Font Awesome Link -->
    <link rel="stylesheet" href="../Style//fontawesome-free-6.3.0-web/css/all.css">

    <title>Page Admin</title>
</head>

<body>

    <nav class="admin_nav">
        <p class="logo_admin"><span>B</span>ookStore</p>
        <a href="search_book_admin.php"><i class="fa fa-search"></i> Search</a>
        <a href="admin_custmer.php"><i class="fa fa-users"></i> Custmer</a>
        <a href="admin_category.php"><i class="fa fa-list"></i>Category</a>
        <a href="book_admin.php"><i class="fa fa-list"></i>Books</a>
        <a href="#"><i class="fa fa-user"></i>Order</a>
        <a href="add_book.php"><i class="fa fa-list"></i>Add Books</a>
        <a href="admin_contact.php"><i class="fa fa-message"></i>Messages</a>
        <a href="#"><i class="fa fa-gears"></i>Settings</a>
        <a href="../Login/logout.php"><i class="fa fa-right-from-bracket"></i>Logout</a>

    </nav>
    <div class="header_admin">
        <div class="border_count">
            <div class="borser1">
                <div>
                    <h1>
                        <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM `custmer`") or die('query failed');
                        $number_of_users = mysqli_num_rows($select_users);
                        ?>
                        <?php echo $number_of_users; ?>
                    </h1>
                    <p>Users</p>
                </div>
                <i class="fa fa-users"></i>
            </div>
            <div class="borser1">
                <div>
                    <h1>
                        <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM books") or die('query failed');
                        $number_of_users = mysqli_num_rows($select_users);
                        ?>
                        <?php echo $number_of_users; ?>
                    </h1>
                    <p>Books</p>
                </div>
                <i class="fa fa-list"></i>
            </div>
            <div class="borser1">
                <div>
                    <h1>
                        <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM contact_books") or die('query failed');
                        $number_of_users = mysqli_num_rows($select_users);
                        ?>
                        <?php echo $number_of_users; ?>
                    </h1>
                    <p>Order</p>
                </div>
                <i class="fa fa-user"></i>
            </div>
            <div class="borser1">
                <div>
                    <h1>
                        <?php
                        $select_users = mysqli_query($conn, "SELECT * FROM contact_books") or die('query failed');
                        $number_of_users = mysqli_num_rows($select_users);
                        ?>
                        <?php echo $number_of_users; ?>
                    </h1>
                    </h1>
                    <p>Messages</p>
                </div>
                <i class="fa fa-message"></i>
            </div>

        </div>
    </div>
    <br />
    <br />
</body>

</html>