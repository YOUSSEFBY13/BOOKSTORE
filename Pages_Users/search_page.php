<?php

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}


@include '../configDB.php';
@include 'header.php';



// Add To Cart /////////
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


<div class="book-wrap">
    <?php
    if (isset($_GET['b_search'])) {
        $search = $_GET['search'];
        $select = mysqli_query($conn, "SELECT * FROM books where CONCAT(book_title, book_autor, book_price, book_lang, book_numbe_page, book_type) LIKE '%$search%' ORDER BY id DESC");
        if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
    ?>
                <form action="" method="post" class="card-book">
                    <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt="" class="new-img" style="max-width: 200px;"></a>
                    <div class="name-book"><?php echo $row['book_title']; ?></div>
                    <div class="autor-book"><?php echo $row['book_autor']; ?></div>
                    <div class="price"><?php echo $row['book_price']; ?> DH</div>

                    <input type="hidden" name="book_cart_name" class="new-title" value="<?php echo $row['book_title']; ?>">
                    <input type="hidden" name="book_cart_autor" class="new-title" value="<?php echo $row['book_autor']; ?>">
                    <input type="hidden" name="book_cart_price" class="new-price" value="<?php echo $row['book_price']; ?> DH">
                    <input type="hidden" name="book_cart_image" class="new-autor" value="<?php echo $row['book_image']; ?>">
                    <button type="submit" name="add_to_cart" style="padding: 16px;">Add To Cart</button>
                </form>
    <?php
            }
        }
    } else if (!isset($_GET['search'])) {
        echo 'Write For Search';
    }
    ?>
</div>
<?php
@include 'footer.php'
?>