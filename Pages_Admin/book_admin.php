<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';

$limit = 5; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$offset = ($page - 1) * $limit; 

$select = mysqli_query($conn, "SELECT * FROM books ORDER BY id DESC LIMIT $offset, $limit");

$total_pages = ceil(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM books")) / $limit); 

?>

<div class="container-book-add">
    <div class="container-add">
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
                        <th>Action</th>
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
                            <a href="edit_book.php?edit=<?php echo $row['id']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> Edit </a>
                            <a href="add_book.php?delete=<?php echo $row['id']; ?>" class="btn-delete"> <i class="fas fa-trash"></i> Delete </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

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
    </div>
</div>