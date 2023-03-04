<?php
include '../configDB.php';
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login/login.php");
    exit();
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link Style -->
    <link rel="stylesheet" href="../Style/style_user.css">
    <link rel="stylesheet" href="../Style/bootstrap-5.1.3-dist/css/bootstrap.css">
    <!-- Script -->
    <script src="../Style/bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <!-- Link Bootstrap -->
    <!-- Bootstrap Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="../Style//fontawesome-free-6.3.0-web/css/all.css">
    <title>BookStore</title>
</head>

<body>
    <div class="nav">
        <ul>
            <li><a href="index_book.php">HOME</a></li>
            <li><a href="#">ABOUTE</a></li>
            <li><a href="contact.php">CONTACT</a></li>
        </ul>
        <a href="index_book.php"><img src="../Image/R-logo.png" alt=""></a>
        <ul>
            <li>
                <?php
                if (isset($_SESSION['email'])) {
                ?>
            <li>
                <a href="../Login/logout.php">LOGOUT</a>
            </li>
        <?php
                } else {
        ?>
            <li class="nav-item">
                <a href="../Login/login.php">LOGIN</a>
            </li>
        <?php
                }
        ?>
        </li>
        <li class="nav-item">
            <?php

            $select_rows = mysqli_query($conn, "SELECT * FROM cart_book") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);

            ?>
            <a href="shopping_cart.php">CART(<span><?php echo $row_count; ?></span>)</a>
        </li>
        <li><a href="#">FAVOURITE()</a></li>
        </ul>
    </div>
    <!-- ==== Start Section Serch ======= -->
    <div class="search_user">
        <form action="search_page.php" method="get">
            <input type="text" name="search" placeholder="Serching..." class="search">
            <input type="submit" name="b_search" value="Search" class="search_b">
        </form>
    </div>
    <!-- ==== End Section Serch ======= -->

    <!-- ========= Start Section Category ========== -->
    <div class="navbar navbar-expand-lg bg-white navbar-light bg-light">
        <div class="collapse navbar-collapse" id="myNavbarToggler2">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Choose a BookStore
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $select = mysqli_query($conn, "SELECT * FROM  category");

                        while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                            <ul>
                                <li><a class="dropdown-item" href="Category_book.php?name_category=<?php echo $row['name_category']; ?>"><?php echo $row['name_category']; ?></a></li>
                            </ul>
                        <?php
                        }
                        ?>
                    </div>
                </li>
                <?php
                $select = mysqli_query($conn, "SELECT * FROM  category  order by id_category desc limit 12");

                while ($row = mysqli_fetch_assoc($select)) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link" href="Category_book.php?name_category=<?php echo $row['name_category']; ?>"><?php echo $row['name_category']; ?></a>
                    </li>
                <?php
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="New_book.php">New Books</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="Category_book.php">Books</a>
                </li>

            </ul>
        </div>
    </div>

    <!-- ========= End Section Category ============ -->
</body>

</html>