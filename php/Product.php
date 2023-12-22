<?php

include_once 'Config.php';
session_start();

$result = mysqli_query($con,"SELECT * FROM shop WHERE id='" . $_GET["id"] . "'");
$row  = mysqli_fetch_array($result);
if(is_array($row)) {

   $name = $row["name"];
   $price = $row["price"];
   $rating = $row["rating"];
   $image = $row["image"];
}

if (isset($_POST['addtoCart'])) {
    $qty = $_POST['qty'];
    $name = mysqli_real_escape_string($con, $name);
    $sql = mysqli_query($con, "INSERT INTO cart (name , qty , price , image , user) VALUES ('$name','$qty','$price','$image','" . $_SESSION["id"] . "')");
    if ($sql) {
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
<header>
    <head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/Product.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
    $(function(){
        $("#header").load("../php/Header.php");
        $("#footer").load("../html/Footer.html");
    });

    function addtocart() {
        var qty = document.getElementById("qty").value; 
        $.ajax({
            url: window.location.href,
            type: "POST",
            data: { addtoCart: true, qty: qty },
            success: function(response) {
                response = response.trim();
                if (response === "success") {
                    alert("Successfully added to the cart");
                    setTimeout("location.href = '../php/Shop.php';",400);
                } else {
                    alert("SQL Error");
                }
            },
            error: function() {
                alert("Javascript Error");
            }
        });
    }
    </script>
</head>

<div id="header"></div>

<br>
<body>
    <div class="container">
        <img src="../uploads/<?php echo $image ?>">
        <div class="column">
            <lable  class="name">Product Name : <?php echo $name ?></lable>
            <lable class="name">Product Price : Rs. <?php echo $price ?></lable>
            <div class="row">
                <label  for="qnt"><a class="name"><b>Quantity : &nbsp;</b></a></label>
                <input type="number" id="qty" name="qty" class="quntity" value="1" required>
            </div>
            
        </div>
        <div class="row1">
            <input type="button" class="btn1 btn2" value="Buy Now">
            <input type="button" name="cart" class="btn1 btn2 btn3" onclick="addtocart()" value="Add to cart">
        </div><br><br><br>
        <div class="des">
            <h3>Description</h3>
            <p>A product description is a form of marketing copy used to describe and explain the benefits of your product. In other words, it provides all the information and details of your product on your ecommerce site. These product details can be one sentence, a short paragraph or bulleted.</p>
        </div><br><br>
        <div class="rating">
            <h3>Ratings & Reviews</h3>
            <div class="star">
                <?php
                for($i=0; $i<$row['rating']; $i++)
                {
                    echo "<i class='fa fa-star'></i>";
                }
                for($i=0; $i<(5-$row['rating']); $i++)
                {
                    echo "<i class='fa fa-star-o'></i>";
                }?>
            </div>

        </div>
        <center class="a">Related Products</center>
        <div class="row3">
            <img src="../image/pic-10.png" class="p1">
            <img src="../image/pic-9.png" class="p1">
            <img src="../image/pic-12.png" class="p1">
            <img src="../image/pic-13.png" class="p1">
        </div>
        
    </div>
</body>
<br>

<div id="footer"></div>
</html>