<?php
session_start();
@include 'header_admin.php';
@include '../configDB.php';



if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `contact_books` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_contact.php');
}

?>



<div class="container-book-add">


    <div class="container-add">

        <section class="messages">
            <h1 class="t_message">Messages</h1>
            <div class="box-message">
                <?php
                // Select all messages
                $select_message = mysqli_query($conn, "SELECT * FROM `contact_books`") or die('query failed');

                // Check if there are any messages
                if (mysqli_num_rows($select_message) > 0) {
                    // Display each message
                    while ($fetch_message = mysqli_fetch_assoc($select_message)) {
                ?>
                        <div class="message">
                            <p>First Name: <span><?php echo $fetch_message['first_name']; ?></span></p>
                            <p>Last Name: <span><?php echo $fetch_message['last_name']; ?></span></p>
                            <p>Email: <span><?php echo $fetch_message['email']; ?></span></p>
                            <p>Subject: <span><?php echo $fetch_message['Subject']; ?></span></p>
                            <p>Message: <span><?php echo $fetch_message['message']; ?></span></p>
                            <a href="admin_contact.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn-message">Delete Message</a>
                        </div>
                <?php
                    }
                } else {
                    echo '<p class="empty">You have no messages!</p>';
                }
                ?>
            </div>
    </div>
</div>
</section>