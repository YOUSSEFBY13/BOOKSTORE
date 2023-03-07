<?php
include '../configDB.php';
include 'header.php';


// Add To cart //////
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


<!-- Back to Top -->
<div class="scrollTop" onclick="scrollTopTop();"></div>





<!-- carousel -->

<div class=" ml-5 mr-5">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100 h-50" src="../image/Lester-Alix_2048x600_Bookshop (1).png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-50" src="../image/22_357_2048x600_785k.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 h-50" src="../image/banner.jpg" alt="Third slide">
            </div>
        </div>
    </div>
</div>
<!-- carousel -->

<!-- Books slider -->
<!-- slider book -->

<div class="marggin-section  ml-5 mr-5">
    <div class="featured_boks">
        <h1>Last Add's</h1>
        <div class="featured_book_box" style="margin: 0;">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM  books order by id desc limit 12");
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
            ?>
                    <form action="" method="post" class="best-book">
                        <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt=""></a>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<div class="marggin-section  ml-5 mr-5">
    <div class="featured_boks">
        <div class="featured_book_box" style="margin: 0;">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM books WHERE id < (SELECT MIN(id) FROM (SELECT id FROM books ORDER BY id DESC LIMIT 10) sub) ORDER BY id DESC");
            if (mysqli_num_rows($select) > 0) {
                while ($row = mysqli_fetch_assoc($select)) {
            ?>
                    <form action="" method="post" class="best-book">
                        <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt="" style="max-width: 200px; padding: 12px;"></a>
                    </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- =============================================================== -->
<h1 style="margin: 100px 0 0 100px;">Best Books</h1>
<div class="book-wrap">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM books order by book_type desc limit 9");
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
    ?>
</div>
<!-- ================================= -->

<div class="featured_boks">
    <h1>Another Books</h1>
    <div class="featured_book_box">
        <?php
        $select = mysqli_query($conn, "SELECT * FROM  books order by id desc limit 9");
        if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
        ?>
                <form action="" method="post">
                    <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt="" class="img_slider_bok"></a>
                </form>
        <?php
            }
        }
        ?>
    </div>
</div>
<div class="featured_boks">
    <div class="featured_book_box">
        <?php
            $select = mysqli_query($conn, "SELECT * FROM books WHERE id < (SELECT MIN(id) FROM (SELECT id FROM books ORDER BY id DESC LIMIT 10) sub) ORDER BY id DESC");
            if (mysqli_num_rows($select) > 0) {
            while ($row = mysqli_fetch_assoc($select)) {
        ?>
                <form action="" method="post">
                    <a href="book_detail.php?id=<?php echo $row['id'] ?>"><img src="../image/<?php echo $row['book_image']; ?>" alt="" class="img_slider_bok"></a>
                </form>
        <?php
            }
        }
        ?>
    </div>
</div>

<!-- =============================================================== -->
<h1 style="margin: 0 0 0 100px;">Best Books</h1>
<div class="book-wrap">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM books order by book_price desc limit 9");
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
    ?>
</div>
<!-- ================================= -->

<h1 style="margin: 0 0 0 100px;">Featured Books</h1>
<div class="book-wrap">
    <?php
    $select = mysqli_query($conn, "SELECT * FROM  books order by id desc limit 4");
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
    ?>
</div>


<!-- section footer -->
<?php
@include 'footer.php'
?>


<script type="text/javascript">
    window.addEventListener('scroll', function() {
        var scroll = document.querySelector('.scrollTop');
        scroll.classList.toggle("active", window.scrollY > 500)
    })

    function scrollTopTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })
    }
</script>