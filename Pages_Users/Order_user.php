<?php
session_start();
@include 'header.php';
@include '../configDB.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
}

?>
<div class="orders">
    <div class="container-order">

        <form action="" method="POST">
    
            <div class="row">
    
                <div class="col">
    
                    <h3 class="title">Entre your address</h3>
    
                    <div class="inputBox">
                        <span>Full name :</span>
                        <input type="text" placeholder="Entre your name">
                    </div>
                    <div class="inputBox">
                        <span>Email :</span>
                        <input type="email" placeholder="example@gmail.com">
                    </div>
                    <div class="inputBox">
                        <span>Address :</span>
                        <input type="text" placeholder="Entre your Adresse">
                    </div>
                    <div class="inputBox">
                        <span>City :</span>
                        <input type="text" placeholder="Entre your City">
                    </div>
    
                    <div class="flex">
                        <div class="inputBox">
                            <span>State :</span>
                            <input type="text" placeholder="Entre your state">
                        </div>
                        <div class="inputBox">
                            <span>zip code :</span>
                            <input type="text" placeholder="Entre you Zip code">
                        </div>
                    </div>
    
                </div>
    
                <div class="col">
    
                    <h3 class="title">payment</h3>
    
                    <div class="inputBox">
                        <span>Cards Accepted :</span>
                        <img src="../image/card_img.png" alt="">
                    </div>
                    <div class="inputBox">
                        <span>Name your card :</span>
                        <input type="text" placeholder="Entre First name and last name You card">
                    </div>
                    <div class="inputBox">
                        <span>Credit card number :</span>
                        <input type="number" placeholder="0000-0000-0000-0000">
                    </div>
                    <div class="inputBox">
                        <span>Exp month :</span>
                        <input type="text" placeholder="">
                    </div>
    
                    <div class="flex">
                        <div class="inputBox">
                            <span>Exp year :</span>
                            <input type="number" placeholder="">
                        </div>
                        <div class="inputBox">
                            <span>CVV :</span>
                            <input type="text" placeholder="">
                        </div>
                    </div>
    
                </div>
        
            </div>
    
            <input type="submit" value="Proceed To Checkout" class="submit-btn">
    
        </form>
    
    </div>   
</div> 

<?php
@include 'footer.php';
?>    
</body>
</html>