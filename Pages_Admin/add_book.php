<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';


if (isset($_POST['add_book'])) {

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
        echo 'please fill out all';
    } else {
        $insert = "INSERT INTO books (book_title, book_autor, book_price, book_desc, book_lang, book_numbe_page, book_type, book_image) VALUES ('$book_title', '$book_autor', '$book_price','$book_desc', '$book_lang', '$book_numbe_page', '$book_type', '$book_image')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            move_uploaded_file($book_image_tmp_name, $book_image_folder);
            echo '
            <div class="modal-dialog modal-dialog-centered">new book added successfully</div>
            ';
        } else {
            echo 'could not add the book';
        }
    }
};

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM books WHERE id = $id");
    header('location:book_admin.php');
};


?>
<!-- ------------========================------------- -->


<div class="container-book-add">


    <div class="container-add">

        <div class="admin-book-form-container">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>add a new book</h3>
                <input type="text" placeholder="enter book name" name="book_title" class="box-book-add">
                <input type="text" placeholder="enter book autor" name="book_autor" class="box-book-add">
                <input type="number" placeholder="enter book price" name="book_price" class="box-book-add">
                <textarea type="text" placeholder="enter book description" name="book_desc" class="box-book-add"></textarea>
                <input type="text" placeholder="enter book Language" name="book_lang" class="box-book-add">
                <input type="text" placeholder="enter book number pages" name="book_numbe_page" class="box-book-add">
                <input type="text" placeholder="enter book type" name="book_type" class="box-book-add">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="book_image" class="box-book-add">
                <input type="submit" class="btn-add-book" name="add_book" value="add book">
                <a href="admin_book.php" class="btn-add-book">Go book </a>
            </form>

        </div>

        <?php

        $select = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC LIMIT 6");

        ?>
        <div class="book-add">
            <table class="book-add-table">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Image</th>
                        <th>Book Title</th>
                        <th>Book Autor</th>
                        <th>Book Price</th>
                        <th>Book Description</th>
                        <th>Book Stock</th>
                        <th>Book Number Pages</th>
                        <th>Book Type</th>
                        <th>action</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><img src="../image/<?php echo $row['book_image']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['book_title']; ?></td>
                        <td><?php echo $row['book_autor']; ?></td>
                        <td><?php echo $row['book_price']; ?> DH</td>
                        <td><?php echo $row['book_desc']; ?></td>
                        <td><?php echo $row['book_lang']; ?></td>
                        <td><?php echo $row['book_numbe_page']; ?></td>
                        <td><?php echo $row['book_type']; ?></td>
                        <td>
                            <a href="edit_book.php?edit=<?php echo $row['id']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> edit </a>
                            <a href="add_book.php?delete=<?php echo $row['id']; ?>" class="btn-delete"> <i class="fas fa-trash"></i> delete </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>