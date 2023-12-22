<?php

include_once 'Config.php';

?>

<!DOCTYPE html>
<html>

<head>
    <title>Treasure Mart</title>
    <link rel="stylesheet" href="../css/Shop.css">
    <link rel="stylesheet" href="../css/Header&Footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function () {
            $("#header").load("../php/Header.php");
            $("#footer").load("../html/Footer.html");
        });
    </script>
</head>

<div id="header"></div>
<!--End Header-->

<!----featured categories--->

<div class="categories">
    <div class="small1-container">
        <div class="row1">
            <img src="../image/slide1.png">
            <img src="../image/pic-2.png">
            <img src="../image/pic-3.png">
        </div>
    </div>
</div>

<!----featured products--->
<div class="small-container">
    <h2 class="title">Featured products</h2>
    <div class="row">
        <?php
        $sql = "SELECT * FROM shop ORDER BY id ASC";
        $result = mysqli_query($con, $sql);
        if ($result->num_rows > 0)
            while ($row = $result->fetch_assoc()) { ?>
        <div class="col-4">
            <img src="<?php echo "../uploads/" . rawurlencode($row['image']); ?>">
            <h4 class="h4">
                <?php echo $row['name']; ?>
            </h4>
            <div class="rating">
                <?php
                for ($i = 0; $i < $row['rating']; $i++) {
                    echo "<i class='fa fa-star'></i>";
                }
                for ($i = 0; $i < (5 - $row['rating']); $i++) {
                    echo "<i class='fa fa-star-o'></i>";
                } ?>
            </div>
            <p>Rs.
                <?php echo $row['price']; ?>
            </p>
            <form method="POST" action="Product.php?action=view&id=<?php echo $row['id']; ?>">
            <div class="pen">
            <div class="pen2">
                <a href="Product.php?id=<?php echo $row['id']; ?>" class="btn1 btn2">Buy Now </a><br><br>
            </div>
                <div class="pen1">
                     <a href ="../html/UpdateAddItems.html"><img src="../image/pen.png"></a>
                </div>
                
            </div>
                
        </div>
        
        <?php
            } ?>
    </div>
</div>


<!---offer-->
<div class="offer">
    <div class="small2-container">
        <div class="row">
            <div class="col-2">
                <img src="../image/phone.png" class="offer-img">
            </div>
            <div class="col-2">
                <p>Exclusively Available On Treasure Mart</p>
                <h1>IPHONE 14</h1>
                <small>Apple iPhone 14 Pro Max smartphone.<br>Features 6.7″ display, Apple A16 Bionic chipset, 4323 mAh
                    battery, 1024 GB storage, 6 GB RAM, ...</small><br><br>
                <a href="" class="btn1 btn3"> Buy Now &#8594;</a>
            </div>
        </div>
    </div>
</div>

<div id="footer"></div>

</html>
<!--End Footer-->