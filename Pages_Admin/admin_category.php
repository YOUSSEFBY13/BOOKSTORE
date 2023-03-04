<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';


if (isset($_POST['add_category'])) {

    $name_category = $_POST['name_category'];
    $desc_category = $_POST['desc_category'];
    $image_category = $_FILES['image_category']['name'];
    $image_category_tmp_name = $_FILES['image_category']['tmp_name'];
    $image_category_folder = '../image/' . $image_category;

    if (empty($name_category) || empty($desc_category) || empty($image_category)) {
        echo 'please fill out all';
    } else {
        $insert = "INSERT INTO category (name_category, desc_category, image_category) VALUES ('$name_category', '$desc_category', '$image_category')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            move_uploaded_file($image_category_tmp_name, $image_category_folder);
            echo 'new Category added successfully';
        } else {
            echo 'could not add the Category';
        }
    }
};

if (isset($_GET['delete'])) {
    $id_category = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM category WHERE id_category = $id_category");
    header('location:admin_category.php');
};

?>



<div class="container-book-add">


    <div class="container-add">

        <div class="admin-book-form-container">

            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Add a New Category</h3>
                <input type="text" placeholder="enter book category name" name="name_category" class="box-book-add">
                <input type="text" placeholder="enter description category" name="desc_category" class="box-book-add">
                <input type="file" accept="image/png, image/jpeg, image/jpg" name="image_category" class="box-book-add">
                <input type="submit" class="btn-add-book" name="add_category" value="Add Category">
                <a href="admin_category.php" class="btn-add-book">Go book </a>
            </form>

        </div>

        <?php

        $select = mysqli_query($conn, "SELECT * FROM category");

        ?>
        <div class="book-add">
            <table class="book-add-table">
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Category Image</th>
                        <th>Category Name</th>
                        <th>Category Description</th>
                        <th>action</th>
                    </tr>
                </thead>
                <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                    <tr>
                        <td><?php echo $row['id_category']; ?></td>
                        <td><img src="../image/<?php echo $row['image_category']; ?>" height="100" alt=""></td>
                        <td><?php echo $row['name_category']; ?></td>
                        <td><?php echo $row['desc_category']; ?></td>
                        <td>
                            <a href="edit_category.php?edit=<?php echo $row['id_category']; ?>" class="btn-edit"> <i class="fas fa-edit"></i> edit </a>
                            <a href="admin_category.php?delete=<?php echo $row['id_category']; ?>" class="btn-delete"> <i class="fas fa-trash"></i> delete </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

    </div>