<?php
session_start();
@include '../configDB.php';
@include 'header.php';

$id = "";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$select =  "SELECT * FROM books WHERE id = $id";
$result = $conn->query($select);


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
        echo 'Book already added to cart.';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO cart_book(book_cart_name, book_cart_autor, book_cart_price, book_cart_image, book_cart_quantity) VALUES('$book_cart_name', '$book_cart_autor', '$book_cart_price', '$book_cart_image', '$book_quantity')");
        echo 'Book added to cart successfully.';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Detail</title>

    <style>
        /* Book Details style */

        .book_details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            margin-top: 100px;
        }

        .book_detail_1 {
            display: flex;
            margin-top: 200px;
        }

        .book_detail_1 img {
            width: 300px;
            height: 450px;
        }

        .detail_book {
            margin-left: 30px;
        }

        .detail-title {
            font-size: 32px;
            font-weight: bold;
            margin: 0;
            max-width: 500px;
        }

        .detail-autor {
            font-size: 18px;
            margin: 10px 0;
        }

        .detail-price {
            font-size: 24px;
            margin: 10px 10px 0 10px;
            border: 1px solid #089da1;
            border-radius: 5px;
            padding: 25px 0 25px 10px;
        }

        .old-price {
            font-size: 24px;
            margin: 10px 30px 0 10px;
            border: 1px solid #089da1;
            border-radius: 5px;
            padding: 25px 0 25px 10px;
            color: red;
            text-decoration: line-through;
        }

        .pricce {
            display: flex;
            flex-wrap: nowrap;
        }

        .add_detail_cart {
            background-color: #089da1;
            border: none;
            border-radius: 30px;
            color: white;
            padding: 12px 60px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            margin: 10px 0;
            cursor: pointer;
        }

        .fav_detail_cart {
            background-color: #fff;
            border: 1px solid #333;
            border-radius: 30px;
            color: 089da1;
            padding: 12px 60px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 17px;
            margin: 10px 0;
            cursor: pointer;
        }

        .detail_desc {
            max-width: 500px;
            font-size: 18px;
            margin: 20px 0;
            line-height: 1.5;
        }

        .detail_1_book {
            font-size: 24px;
            font-weight: bold;
            margin: 100px 0 0 0;
        }

        .detail_2_book {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .detail_2_book li {
            font-size: 18px;
            margin: 0 0;
        }

        .detail_2_book li span {
            font-weight: bold;
            margin-left: 10px;
        }

        /* Media design */

        @media only screen and (max-width: 768px) {
            .book_details {
                margin: 20px 0 50px 30px;
            }

            .book_detail_1 {
                flex-direction: column;
            }

            .detail_book {
                margin-left: 0;
                margin-top: 30px;
            }
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">

</head>

<body>

    <?php
    $select = mysqli_query($conn, "SELECT * FROM books where id=$id ");
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
    ?>
            <div class="book_details">
                <form action="" method="post">
                    <div class="book_detail_1">
                        <img src="../image/<?php echo $row['book_image']; ?>" alt="images">
                        <div class="detail_book">
                            <h2 class="detail-title"><?php echo $row['book_title']; ?></h2>
                            <p class="detail-autor"><?php echo $row['book_autor']; ?></p>
                            <div class="pricce">
                                <p class="detail-price"> Price: <span> <?php echo $row['book_price']; ?> DH</span></p>
                                <p class="old-price"> Price: <span> <?php echo $row['book_price'] * 1.05; ?> DH</span></p>
                            </div>



                            <input type="hidden" name="book_cart_name" class="new-title" value="<?php echo $row['book_title']; ?>">
                            <input type="hidden" name="book_cart_autor" class="new-title" value="<?php echo $row['book_autor']; ?>">
                            <input type="hidden" name="book_cart_price" class="new-price" value="<?php echo $row['book_price']; ?> DH">
                            <input type="hidden" name="book_cart_image" class="new-autor" value="<?php echo $row['book_image']; ?>">


                            <a href="Categoty_book.php?id=<?php echo $row['id'] ?>"><input type="submit" value="ADD TO CART" name="add_to_cart" class="add_detail_cart"></a>
                            <a href="Categoty_book.php?id=<?php echo $row['id'] ?>"><input type="submit" value="ADD TO FAVORITE" name="add_to_cart" class="fav_detail_cart"></a>
                            <p class="detail_desc"><?php echo $row['book_desc']; ?></p>
                        </div>
                    </div>
                </form>

                <!-- Start Rating Star (Reviews) -->

                <?php
                if (isset($_POST['add'])) {

                    $rate = mysqli_real_escape_string($conn, $_POST['rate']);
                    $rev_title = mysqli_real_escape_string($conn, $_POST['rev_title']);
                    $rev_comm = mysqli_real_escape_string($conn, $_POST['rev_comm']);

                    $select_message = mysqli_query($conn, "SELECT * FROM reviews WHERE rate = '$rate' AND rev_title = '$rev_title' AND rev_comm = '$rev_comm'") or die('query failed');

                    if (mysqli_num_rows($select_message) > 0) {
                        echo '';
                    } else {
                        mysqli_query($conn, "INSERT INTO reviews(rate, rev_title, rev_comm) VALUES( '$rate', '$rev_title', '$rev_comm')") or die('query failed');
                        echo 'message add successfully!';
                    }
                }

                ?>
                <div class="reviws">
                    <div class="detail_1_book">
                        <h1>Book Details</h1>
                        <ul class="detail_2_book">
                            <li>Price: <span><?php echo $row['book_price']; ?> DH</span></li>
                            <li>Number Pages: <span><?php echo $row['book_numbe_page']; ?></span></li>
                            <li>Language: <span><?php echo $row['book_lang']; ?></span></li>
                            <li>Type: <span><?php echo $row['book_type']; ?></span></li>
                            <p class="detail_desc"><?php echo $row['book_desc']; ?></p>
                        </ul>
                    </div>
                    <div class="reviws-row">
                        <form action="" method="post">
                            <h3 class="reviews-h3">Customer Reviews</h3>
                            <label>Review Title</label>
                            <div>
                                <input type="text" class="rev_title" name="rev_title" required>
                            </div>
                            <label>Review Commenter</label>
                            <div>
                                <input type="text" class="rev_comm" name="rev_comm" required>
                            </div>
                            <div class="rateyo" id="rating" data-rateyo-rating="4" data-rateyo-num-stars="5" data-rateyo-score="3"></div>
                            <!-- <span class='result'>0</span> -->
                            <input type="hidden" name="rate" required>
                            <div><input type="submit" value="Add Commenter" name="add" class="reviws-add"> </div>
                        </form>
                    </div>
                    <div class="commenter">
                        <?php
                        $select = mysqli_query($conn, "SELECT * FROM reviews  order by id_rev desc LIMIT 3");
                        if (mysqli_num_rows($select) > 0) {
                            while ($row = mysqli_fetch_assoc($select)) {
                        ?>
                                <form class="details-reviews" action="" method="post">
                                    <div class="review">
                                        <div class="start">
                                            <div class="firstname">
                                                <p><?php echo substr($row['rev_title'], 0, 1); ?></p>
                                            </div>
                                            <div>
                                                <span class="rateN">
                                                    <?php
                                                    $stars = 1;
                                                    while ($stars <= 5) {
                                                        if ($row['rate'] < $stars) {
                                                    ?>
                                                            <i class="fa fa-star-o"></i>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <i class="fa fa-star"></i>
                                                    <?php
                                                        }
                                                        $stars++;
                                                    }
                                                    ?>
                                                </span>
                                                <span class="time"><?php $current_time = date('d/m/y');
                                                                    echo $current_time; ?></span>
                                                <div class="title"><?php echo $row['rev_title']; ?></div>
                                            </div>
                                        </div>
                                        <div class="comment"><?php echo $row['rev_comm']; ?></div>
                                    </div>
                                </form>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <h1 style="margin: 100px 0 0 100px;">Related Books</h1>

    <div class="featured_boks">
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
    </div>

    <?php
    @include 'footer.php';
    ?>
    <script>
        $(function() {
            $(".rateyo").rateYo().on("rateyo.change", function(e, data) {
                var rating = data.rating;
                $(this).parent().find('.score').text('score :' + $(this).attr('data-rateyo-score'));
                $(this).parent().find('.result').text('rating :' + rating);
                $(this).parent().find('input[name=rate]').val(rating); //add rating value to input field
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>