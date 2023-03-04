<?php
session_start();
@include '../configDB.php';
@include 'header.php';



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

////  Prev And Next ///////////
$limit = 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$select = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC LIMIT $offset, $limit");
$total_books = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books ORDER BY id LIMIT 100"));
$total_pages = ceil($total_books / $limit);
?>
    <div class="category-header">
        <img src="../image/New_book.jpeg" alt="" class="category-img">
        <div class="desc-category">
            <h1 class="category-title">New Book</h1>
            <p class="desc-p"><a href="index_book.php">BookStore.com</a></p>
        </div>
    </div>
    <div class="book-wrap">
        <?php
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
                <hr />
        <?php
            }
        }
        ?>
    </div>
    <!-- Pagination -->
    <div class="pagination">
        <?php if ($page > 1) { ?>
            <a href="?page=<?php echo $page - 1; ?>">Prev</a>
        <?php } ?>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a href="?page=<?php echo $i; ?>" <?php if ($page == $i) echo 'class="active"'; ?>><?php echo $i; ?></a>
        <?php } ?>
        <?php if ($page < $total_pages) { ?>
            <a href="?page=<?php echo $page + 1; ?>">Next</a>
        <?php } ?>
    </div>

    <?php
    @include 'footer.php'

    ?>