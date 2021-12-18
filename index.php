<!DOCTYPE html>
<html lang="en">
<?php
    include_once "lib/config.php";
    include_once 'lib/DataProvider.php';
    include_once "checkID.php";

    global $db_host, $db_username, $db_password, $db_name;
    $connection = new mysqli($db_host, $db_username, $db_password, $db_name);
    /* check connection */
    if ($connection->connect_error) {      
        die("Failed to connect: " . $connection->connect_error);
    }
    session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eye Disease DSS</title>

    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery.zoom.min.js"></script>

    <style>
        .well
        {
            background: rgba(255, 255, 255 , 0.7);
            border: none;
    
        }
		body
		{
			background-image: url('img/background1.png');
			background-repeat: no-repeat;
			background-attachment: fixed;
            background-size: 100% 100%;
		}
		p
		{
			font-size: 13px;
            color: #FF1493;
		}

    </style>
</head>

<body>  
    <div class="container">

        <!-- Header -->
        <div class="container">
        <!--Header box-->
            <div class="container">
                <table>
                    <tr style = "width: 100%">
                        <th>
                        <a href="index.php">
                            <img src="img/logo.png" alt="image not found" class="logo">
                        </a>
                        </th>

                        <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>

                        <th class ="w3-right-align">
                            <?php
                            if(isset($_SESSION["username"]))
                            {
                                include ("modules/mAccountInfor.php");
                            }
                            else
                            {
                                include ("modules/mAccountLogin.php");
                            }
                            ?>
                        </th>
                    </tr>
                </table>
            </div>


            <!--Nav bar-->
            <?php
                if(isset($_SESSION["name"]) && isset($_SESSION["username"])){
                    if($_SESSION["username"] != 'admin'){
                    echo"
                    <div class='w3-container'>
                        <div class='w3-bar w3-pale-red w3-border w3-padding w3-round-large'>
                            <a href='index.php?name=".$_SESSION["name"]."'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Home</button></a>
                            <a href='Diagnosis.php?name=".$_SESSION["name"]."'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Disease Diagnosis</button></a>
                            <a href='Medicine.php?name=".$_SESSION["name"]."'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Medicine Recommendation</button></a>
                            <a href='Usage.php?name=".$_SESSION["name"]."'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Usage Instruction</button></a>
                        </div>
                    </div>
                ";

                }
                        

                else{
                    echo"
                    <div class='w3-container'>
                    <div class='w3-bar w3-pale-red w3-border w3-padding w3-round-large'>
                        <a href='AdminIndex.php'>
                            <button href='#' class='w3-bar-item w3-button w3-mobile w3-round-large'>Home</button></a>
                        <a href='AdminFood.php'>
                            <button href='#' class='w3-bar-item w3-button w3-mobile w3-round-large'>Food</button></a>
                        <a href='AdminDrink.php' class='w3-bar-item w3-button w3-mobile w3-round-large'>Drinks</a>
                            <div class = 'w3-dropdown-hover'>
                            <button class = 'w3-bar-item w3-button w3-mobile w3-round-large'>Admin</button>
                                <div class = 'w3-dropdown-content w3-bar-block w3-card-4'>
                                <a href='addingFood.php'>
                                    <button href='#' class='w3-bar-item w3-button'>Adding Food</button></a>
                                <a href='addingDrinks.php'>
                                    <button href='#' class='w3-bar-item w3-button'>Adding Drinks</button></a>
                                </div>
                            </div>
                        <a href='AdminQuery.php'>
                            <button href='#' class='w3-bar-item w3-button w3-pink w3-mobile w3-right w3-round-large'>Query</button></a>
                    </div>
                </div>
                    ";
                }
            }
            ?>
        </div>

        <!-- Photo box -->
        <div class="w3-content w3-section" style="width:100%;">
            <img class="photoSlides" src="img/chaa1.png" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/chaa2.png" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/chaa3.png" style="width:100%; height:100%;">
            <img class="photoSlides" src="img/chaa4.png" style="width:100%; height:100%;">
        </div>

        <!-- About us box -->
        <hr>
        <div class="row" style="color: #e0607b">
            <div class="col-md-12 well">
                <h4><strong>About</strong></h4><br>
                <p style="color: #e0607b">A decision support website for ophthalmic diagnosis and medicine recommendations, developed by CHAA.</p>
                <p style="color: #e0607b">Supports Cao Thắng Eye Hospital ophthalmologists in disease diagnosis and medicine prescription.</p>
                <p style="color: #e0607b">Three features: ophthalmic diagnosis based on symptoms, ophthalmic medicine recommendation based on the diagnosis, and medicine usage listing.</p>
                <br>
                <h4><strong>For more information, please kindly contact CHAA via:</strong></h4>
                <p style="color: #e0607b">Email: chauhuongananh.chaa@gmail.com</p>
                <p style="color: #e0607b">Phone: +84 070 228 400</p>
                <!-- <p style="color: #BD87AE">QR Code:</p>
                <img src="img/qrcode.png" style="width:20%; height:20%;"> -->
            </div>  
        </div>
    </div>

    <!-- Photo box algorithm -->
    <script>
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("photoSlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
        myIndex++;
        if (myIndex > x.length) {myIndex = 1}    
        x[myIndex-1].style.display = "block";  
        setTimeout(carousel, 3000); // Change image every 3 seconds
        }
    </script>
</body>
</html>