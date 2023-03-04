<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `custmer` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_custmer.php');
}

?>


<section class="users-detail">

    <h1 class="title-detail"> Custmer </h1>

    <div class="box-container-user">
        <?php
        $select_users = mysqli_query($conn, "SELECT * FROM `custmer`") or die('query failed');
        while ($fetch_users = mysqli_fetch_assoc($select_users)) {
        ?>
            <div class="box-user">
                <p> user id : <span><?php echo $fetch_users['id']; ?></span> </p>
                <p> First Name : <span><?php echo $fetch_users['first_name']; ?></span> </p>
                <p> Last Name : <span><?php echo $fetch_users['last_name']; ?></span> </p>
                <p> email : <span><?php echo $fetch_users['email']; ?></span> </p>
                <p> City : <span><?php echo $fetch_users['city']; ?></span> </p>
                <a href="admin_custmer.php?delete=<?php echo $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">Delete User</a>
            </div>
        <?php
        };
        ?>
    </div>

</section>