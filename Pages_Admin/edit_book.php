<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';


$id = $_GET['edit'];

if (isset($_POST['update_book'])) {

    $book_title = $_POST['book_title'];
    $book_autor = $_POST['book_autor'];
    $book_price = $_POST['book_price'];
    $book_desc = $_POST['book_desc'];
    $book_lang = $_POST['book_lang'];
    $book_numbe_page = $_POST['book_numbe_page'];
    $book_type = $_POST['book_type'];
    $book_image = $_FILES['book_image']['name'];
    $book_image_tmp_name = $_FILES['book_image']['tmp_name'];
    $book_image_folder = '../image/' . $book_image;

    if (empty($book_title) || empty($book_autor) || empty($book_price) || empty($book_desc) || empty($book_lang) || empty($book_numbe_page) || empty($book_type) || empty($book_image)) {
        echo 'new book added successfully';
    } else {

        $update_data = "UPDATE books SET book_title='$book_title', book_autor='$book_autor', book_price='$book_price', book_desc='$book_desc', book_lang='$book_lang', book_numbe_page='$book_numbe_page', book_type='$book_type', book_image='$book_image'  WHERE id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($book_image_tmp_name, $book_image_folder);
            header('location:add_book.php');
        } else {
            echo 'new book added successfully';
        }
    }
};

?>



<div class="container-book-add">


    <div class="container-add">


        <div class="admin-book-form-container centered">

            <?php

            $select = mysqli_query($conn, "SELECT * FROM books WHERE id = '$id'");
            while ($row = mysqli_fetch_assoc($select)) {

            ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="title">update the book</h3>
                    <img src="../image/<?php echo $row['book_image']; ?>" height="100" alt="">
                    <input type="file" class="box-book-add" name="book_image" value="<?php echo $row['book_image']; ?>" accept="image/png, image/jpeg, image/jpg">
                    <input type="text" class="box-book-add" name="book_title" value="<?php echo $row['book_title']; ?>" placeholder="enter the book title">
                    <input type="text" class="box-book-add" name="book_autor" value="<?php echo $row['book_autor']; ?>" placeholder="enter the book autor">
                    <input type="number" min="0" class="box-book-add" name="book_price" value="<?php echo $row['book_price']; ?>" placeholder="enter the book price">
                    <input type="text" class="box-book-add" name="book_desc" value="<?php echo $row['book_desc']; ?>" placeholder="enter the book description">
                    <input type="text" class="box-book-add" name="book_lang" value="<?php echo $row['book_lang']; ?>" placeholder="enter the book stock">
                    <input type="text" class="box-book-add" name="book_type" value="<?php echo $row['book_type']; ?>" placeholder="enter the book type">
                    <input type="text" class="box-book-add" name="book_numbe_page" value="<?php echo $row['book_numbe_page']; ?>" placeholder="enter the book number page">
                    <input type="submit" value="update book" name="update_book" class="btn-add-book">
                </form>



            <?php }; ?>



        </div>

    </div>
</div>