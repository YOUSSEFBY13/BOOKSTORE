<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';

?>

<div class="search_admin">
    <form method="get">
        <input type="text" name="search" placeholder="Serching..." class="search">
        <input type="submit" name="b_search" value="Search" class="search_b">
    </form>
</div>

<div class="container-book-add">


    <div class="container-add">

        <?php
        if (isset($_GET['b_search'])) {
            $search = $_GET['search'];

            $select = mysqli_query($conn, "SELECT * FROM books where CONCAT(book_title, book_autor, book_price, book_desc, book_lang, book_numbe_page, book_type) LIKE '%$search%' ORDER BY id DESC");

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
                <?php
                    }
                }else{
                    echo 'Write For Search';
                }
                ?>
                </table>
            </div>
    </div>
</div>