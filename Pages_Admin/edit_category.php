<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';



$id_category = $_GET['edit'];

if (isset($_POST['update_category'])) {

    $name_category = $_POST['name_category'];
    $desc_category = $_POST['desc_category'];
    $image_category = $_FILES['image_category']['name'];
    $image_category_tmp_name = $_FILES['image_category']['tmp_name'];
    $image_category_folder = 'image/' . $image_category;



    if (empty($name_category) || empty($desc_category) || empty($image_category)) {
        echo 'new book added successfully';
    } else {
        $update_data = "UPDATE category SET name_category='$name_category', desc_category='$desc_category', image_category='$image_category'  WHERE id_category = '$id_category'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($image_category_tmp_name, $image_category_folder);
            header('location:admin_category.php');
        } else {
            echo 'new category added successfully';
        }
    }
};

?>

<div class="container-book-add">
    <div class="container-add">
        <div class="admin-book-form-container centered">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM category WHERE id_category = '$id_category'");
            while ($row = mysqli_fetch_assoc($select)) {
            ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <h3 class="title">update the book</h3>
                    <input type="file" class="box-book-add" name="image_category" accept="image/png, image/jpeg, image/jpg">
                    <input type="text" class="box-book-add" name="name_category" value="<?php echo $row['name_category']; ?>" placeholder="enter the category name">
                    <input type="text" class="box-book-add" name="desc_category" value="<?php echo $row['desc_category']; ?>" placeholder="enter the category description">
                    <input type="submit" value="update category" name="update_category" class="btn-add-book">
                </form>
            <?php }; ?>
        </div>
    </div>
</div>