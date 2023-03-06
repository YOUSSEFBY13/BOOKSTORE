<?php

session_start();
@include 'header.php';
@include '../configDB.php';


if (isset($_POST['update'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE cart_book SET book_cart_quantity = '$update_value' WHERE id_cart_book = '$update_id'");
    if ($update_quantity_query) {
        echo '<div class="message"><span> Update successfully.</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart_book WHERE id_cart_book = '$remove_id'");
    
};

if (isset($_GET['delete_all'])) {
    mysqli_query($conn, "DELETE FROM cart_book");
}





?>



<div class="shop_H">
    <h1 class="shop_h1">Shopping Cart</h1>
    <!-- <button class="shop2_button" onclick="window.location.href='order_user.php'">CHECKOUT</button> -->
</div>
<div class="shop_cart">
    <ul>
        <li class="item">Item</li>
    </ul>
    <ul class="qty">
        <li>Qty</li>
        <li>Price</li>
        <li></li>
    </ul>
</div>

<?php

$select_cart = mysqli_query($conn, "SELECT * FROM cart_book");
$grand_total = 0;
if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {

?>
        <form action="" method="post">

            <div class="shop_cart">
                <ul class="shop_cart_book">
                    <img src="../Image/<?php echo $fetch_cart['book_cart_image']; ?>" alt="" class="cart_images">
                    <div class="shop_autor">
                        <h3 style="max-width: 500px;"><?php echo $fetch_cart['book_cart_name']; ?></h3>
                        <p><?php echo $fetch_cart['book_cart_autor']; ?></p>
                    </div>
                </ul>
                <ul class="qty_2">
                    <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id_cart_book']; ?>">
                    <li><input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['book_cart_quantity']; ?>"></li>
                    <li><?php echo $fetch_cart['book_cart_price']; ?></li>
                    <li><a style="text-decoration: none; color: #333;" href="shopping_cart.php?remove=<?php echo $fetch_cart['id_cart_book']; ?>" onclick="return confirm('remove item from cart?')" class="fa fa-trash"></a></li>
                </ul>
            </div>
    <?php
        $grand_total += intval($fetch_cart['book_cart_quantity']) * floatval($fetch_cart['book_cart_price']);
    };
} else {
    echo '<p style="margin-left: 300px;">Your shopping cart is empty.</p>';
};
    ?>
    <p class="total">TOTAL: <?php echo $grand_total; ?> DH</p><br /><br />
    <?php
    if (mysqli_num_rows($select_cart) > 0) {?>
    <div class="shop2_button2">
        <button class="ptn_check"> <a href="Order_user.php">CHECKOUT</a></button>
        <input type="submit" value="UPDATE" name="update" class="btn_up">
    </div>
    <?php }?>
    <div class="shop2_button3">
        <button class="btn_empty"><a href="shopping_cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');">EMPTY</a></button>
        <button class="btn_shop" onclick="window.location.href='index_book.php'">CONTINUE SHOPPING</button>
    </div>
        </form>

        <?php
        @include 'footer.php'

        ?>