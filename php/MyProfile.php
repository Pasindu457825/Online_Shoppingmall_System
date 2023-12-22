<?php
    session_start();
    include_once 'Config.php';

    $result = mysqli_query($con,"SELECT image FROM user WHERE email='" . $_SESSION["email"] . "'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) {

        $imagepath = $row["image"];

    }

    if (isset($_POST['deleteAccount'])) {
        $result = mysqli_query($con, "DELETE FROM user WHERE email='" . $_SESSION["email"] . "'");
        if ($result) {
            echo "success";
            exit();
        } else {
            echo "error";
            exit();
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/My profile.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(function(){
        $("#header").load("../php/Header.php");
        $("#footer").load("../html/Footer.html");
    });

    function openConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "block";
    }

    function closeConfirmationDialog() {
    document.getElementById("confirmationDialog").style.display = "none";
    }

    function deleteItem() {
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: { deleteAccount: true },
            success: function(response) {
                if (response === "success") {
                    closeConfirmationDialog();
                    window.location.href = "logout.php";
                } else {
                    alert("Error deleting account");
                }
            },
            error: function() {
                alert("Error deleting account");
            }
        });
    }
    </script>
    <style>
    .modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5);
    }
        
    .modal-content {
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 300px;
    }

    .button-container {
    text-align: center;
    }

    .button-container button {
    margin: 5px;
    }
    </style>
</head>

<div id="header"></div>

<br>
<body>
    <div class="maincontainer">
        <div class="myorder h-400">
            <div class="profile_container">
                <div class="profile-pic-div row">
                    <img src=<?php 
                        if(isset($imagepath)){
                            echo "../uploads/" . rawurlencode($imagepath);
                        }
                        else {
                            echo "../image/image.jpg";
                        }
                    ?> id="photo">
                    <input type="file" id="file">
                    <label for="file" id="uploadBtn">Choose Photo</label>
                </div>
                <div class="row">
                    <label class="ulabel"><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"]?></label>
                    <a href="UpdateAcc.php" class="updatebtn uptbtn">Update Account Details</a>
                    <button class="updatebtn dltbtn1" style="width:430px; border:none;" name="delete" onclick="openConfirmationDialog()">Delete Account</button>
                    
                </div>
                <div id="confirmationDialog" class="modal">
                <div class="modal-content">
                    <h3>Confirm Deletion</h3>
                    <p>Are you sure you want to delete?</p>
                    <div class="button-container">
                    <button id="confirmDeleteButton" onclick="deleteItem()">Delete</button>
                    <button onclick="closeConfirmationDialog()">Cancel</button>
                    </div>
                </div>
                </div>
                
            </div>
            <ul class="menu-header11">
                <h1 style="color: rgb(15, 9, 99);" class="A12">MY</h1>
                <div class="pay backgroundbtn1">
                    <img src="../image/adress.png"><br><br>
                    <a class="order1 btn1 btn1-click" href="../html/UpdateAddItems.html">address</a>
                </div>
                    <div class="pay backgroundbtn1">
                        <img src="../image/card2.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="../html/updatecard.html">Cards</a>
                    </div>
                    <div class="pay backgroundbtn1">
                        <img src="../image/coupon.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="">coupon</a>
                    </div>
                </ul>
        </div><br>
        <div class="myorder">
            <h2>&emsp; My Orders</h2>
                <div class="raw">
                    <div class="pay backgroundbtn">
                        <img src="../image/card.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="../html/Payment.html">Payments</a>
                    </div>
                    <div class="pay backgroundbtn">
                        <img src="../image/Lorry.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="../html/Delivery.html">Deliveries</a>
                    </div>
                    <div class="pay backgroundbtn">
                        <img src="../image/revies.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="../html/Payment.html">Reviews</a>
                    </div>
                    <div class="pay backgroundbtn">
                        <img src="../image/wishlist.png"><br><br>
                        <a class="order1 btn1 btn1-click" href="../html/Delivery.html">wishlists</a>
                    </div>
                </div>
        </div>
        <br>
        <div class="myorder">
            <h2>&emsp; Services</h2>
            <div class="raw">
                <div class="pay backgroundbtn2">
                    <img src="../image/qa.png"><br><br>
                    <a class="order1 btn1 btn1-click" href="../html/Payment.html">Q & A</a>
                </div>
                <div class="pay backgroundbtn2">
                    <img src="../image/feedback.png"><br><br>
                    <a class="order1 btn1 btn1-click" href="../html/Delivery.html">feedback</a>
                </div>
                <div class="pay backgroundbtn2">
                    <img src="../image/news.png"><br><br>
                    <a class="order1 btn1 btn1-click" href="../html/Payment.html">News</a>
                </div>
                </div>
            </div>
            
        </div>

    </div>
    <script src="../js/My Account.js"></script>
</body>
<br>

<div id="footer"></div>

</html>