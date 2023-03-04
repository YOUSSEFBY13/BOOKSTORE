<?php
session_start();
@include '../configDB.php';

$name_category = "";
if (isset($_GET['name_category'])) {
    $name_category = $_GET['name_category'];
}


if (isset($_POST['add_to_cart'])) {

    $book_cart_name = $_POST['book_cart_name'];
    $book_cart_autor = $_POST['book_cart_autor'];
    $book_cart_price = $_POST['book_cart_price'];
    $book_cart_image = $_POST['book_cart_image'];
    $book_quantity = 1;

    $select = mysqli_query($conn, "SELECT * FROM cart_book WHERE book_cart_name = '$book_cart_name'");

    if (mysqli_num_rows($select) > 0) {
        echo '<div class="message"><span> book already added to cart </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO cart_book(book_cart_name, book_cart_autor, book_cart_price, book_cart_image, book_cart_quantity) VALUES('$book_cart_name', '$book_cart_autor', '$book_cart_price', '$book_cart_image', '$book_quantity')");
        echo '<div class="message"><span> book added to cart succesfully </span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="file:///C:/Users/YOUSSEF_HB/Desktop/fontawesome-free-6.3.0-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">

    <style>

        .book-new {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 100px;
        }


        .new-img {
            width: 200px;
            height: auto;
            margin-right: 20px;
        }

        .new-title {
            max-width: 700px;
        }

        .new-autor {
            color: grey;
            font-size: 1.3rem;
            margin-left: 20px;
        }

        .new-price {
            color: #089da1;
            margin-left: 20px;
        }

        .new-button {
            width: 20rem;
            height: 3rem;
            background: #089da1;
            border: #089da1;
            border-radius: 22px;
        }

        .new-button i {
            color: #fff;
            font-size: 25px;
            margin-right: 5px;
        }

        .new-button a {
            text-decoration: none;
            color: #fff;
            font-size: 25px;
            margin-right: 5px;
        }

        .new-button a:hover {
            text-decoration: none;
            color: #fff;
        }

        .new-button:hover {
            width: 22rem;
            height: 3.3rem;
        }

        hr {
            width: 50%;
            margin-left: 25%;
            background-color: black;
        }

        .new-desc {
            max-width: 700px;
        }

        @media only screen and (max-width: 1024px) {
            .category-img {
                display: none;
            }

            .book-new {
                display: flex;
                flex-flow: column;
                margin: 100px;
            }

            .new-desc {
                max-width: 300px;
            }

        }

        .add_cart {
            width: 300px;
            height: 40px;
            border: 1px solid #089da1;
            border-radius: 17px;
            background: #089da1;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php
    @include 'header.php'

    ?>

    <div class="category-header">
        <div class="desc-category">
            <h1 class="category-title"><?php echo $name_category; ?> Books</h1>
            <p class="desc-p"><a href="index_book.php">BookStore.com</a></p>
        </div>
        <?php
        $select = mysqli_query($conn, "SELECT category.image_category FROM category INNER JOIN books ON books.book_type = category.name_category WHERE category.name_category = '$name_category' LIMIT 1");
        while ($row = mysqli_fetch_assoc($select)) {
        ?>
            <img src="../image/<?php echo $row['image_category']; ?>" alt="" class="category-img">
        <?php
        }
        ?>

    </div>

    <?php
    $select = mysqli_query($conn, "SELECT * FROM books INNER JOIN category ON books.book_type = category.name_category WHERE category.name_category = '$name_category'");
    if (mysqli_num_rows($select) > 0) {
        while ($row = mysqli_fetch_assoc($select)) {
    ?>
            <form action="" method="post">
                <div class="book-new">
                    <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt="" class="new-img"></a>
                    <div class="new-detail">
                        <h1 class="new-title"><?php echo $row['book_title']; ?></h1>
                        <h4 class="new-autor"><?php echo $row['book_autor']; ?></h4>
                        <h2 class="new-price"><?php echo $row['book_price']; ?> DH</h2>
                        <p class="new-desc"><?php echo $row['book_desc']; ?></p>

                        <input type="hidden" name="book_cart_name" class="new-title" value="<?php echo $row['book_title']; ?>">
                        <input type="hidden" name="book_cart_autor" class="new-title" value="<?php echo $row['book_autor']; ?>">
                        <input type="hidden" name="book_cart_price" class="new-price" value="<?php echo $row['book_price']; ?> DH">
                        <input type="hidden" name="book_cart_image" class="new-autor" value="<?php echo $row['book_image']; ?>">

                        <input type="submit" value="Add To Cart" name="add_to_cart" class="add_cart">
                    </div>
                </div>
            </form>
    <?php
        }
    }
    ?>






    <?php
    @include 'footer.php'

    ?>

</body>

</html>