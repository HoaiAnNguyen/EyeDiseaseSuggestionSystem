<?php
include_once "lib/config.php";
include_once('lib/DataProvider.php');
include_once "checkID.php";

global $db_host, $db_username, $db_password, $db_name;
$connection = new mysqli($db_host, $db_username, $db_password, $db_name);
/* check connection */
if ($connection->connect_error) {
    die("Failed to connect: " . $connection->connect_error);
}
session_start();
$mysample = '';

function setval($varval)
{
    $mysample = $varval;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Eye Disease DSS</title>

    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

    <!-- Chau Huong -->
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jquery.zoom.min.js"></script>

    <style>
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky+.content {
            padding-top: 60px;
        }

        body {
            background-image: url('img/background1.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        p {
            font-size: 13px;
            color: #FF1493;
        }

        .pro_pic {
            border-radius: 50%;
            height: 50px;
            width: 50px;
            margin-bottom: 15px;
            margin-right: 15px;
        }

        .title {
            margin-top: 10px;
            margin-bottom: 10px;
            font-size: 35px;
            color: #DC143C;
            text-align: center;
            display: block;
        }

        .food-and-drink-title {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            text-transform: uppercase;
            font-size: 18px;
            letter-spacing: 2.5px;
            font-weight: 800;
            color: #e0607b;
            display: block;
        }

        .section-title {
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
            text-transform: uppercase;
            font-size: 20px;
            letter-spacing: 1px;
            font-weight: 700;
            color: #e0607b;
            display: block;
        }

        .btn-group {
            width: 100%;
            height: auto;
            margin: 15px 10px 15px 10px;
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            border-radius: 8px;
        }

        .buttonSymptom {

            background-color: #e0607b;
            border: 1px solid #DC143C;
            /* Green border */
            color: white;
            /* White text */
            padding: 10px 24px;
            /* Some padding */
            cursor: pointer;
            /* Pointer/hand icon */
            width: 100%;
            /* Set a width if needed */
            display: block;
            /* Make the buttons appear below each other */
            border-radius: 8px;

        }



        .buttonSymptom:not(:last-child) {
            border-bottom: none;
            /* Prevent double borders */
        }

        .SubmitSymptoms {
            background-color: lightskyblue;
            border: 1px solid blue;
            /* Green border */
            color: black;
            /* White text */
            padding: 10px 24px;
            /* Some padding */
            cursor: pointer;
            /* Pointer/hand icon */
            width: 100%;
            /* Set a width if needed */
            display: block;
            /* Make the buttons appear below each other */
            border-radius: 8px;
        }

    </style>
</head>

<body>
    <div class="container">
        <!--Header box-->
        <div class="container">
            <table>
                <tr style="width: 100%">
                    <th>
                        <a href="index.php">
                            <img src="img/logo.png" alt="image not found" class="logo">
                        </a>
                    </th>

                    <th>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>

                    <th class="w3-right-align">

                        <?php
                        if (isset($_SESSION["username"])) {
                            include("modules/mAccountInfor.php");
                        } else {
                            include("modules/mAccountLogin.php");
                            include("modules/mAccountSignUp.php");
                        }
                        ?>
                    </th>
                </tr>
            </table>
        </div>


        <!--Nav bar-->
        <?php
        if (isset($_SESSION["name"]) && isset($_SESSION["username"])) {
            if ($_SESSION["username"] != 'admin') {
                $USER = $_SESSION["username"];
                // echo"
                //      <script type='text/javascript'>
                //      alert('".$username."');
                //      </script>
                //  ";


                echo "
                    <div class='w3-container'>
                        <div class='w3-bar w3-pale-red w3-border w3-padding w3-round-large'>
                            <a href='index.php?name=" . $_SESSION["name"] . "'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Home</button></a>
                            <a href='Diagnosis.php?name=" . $_SESSION["name"] . "'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Disease Diagnosis</button></a>
                            <a href='Medicine.php?name=" . $_SESSION["name"] . "'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Medicine Recommendation</button></a>
                            <a href='Usage.php?name=" . $_SESSION["name"] . "'>
                                <button href='#' class='w3-col m3 w3-bar-item w3-button w3-mobile w3-round-large'>Usage Instruction</button></a>
                        </div>
                    </div>
                ";
            } else {
                $USER = "admin";
                echo "
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

    <div class="container">
        <div class="w3-container">
            <!--Side Bar-->
            <nav class="w3-col m3 w3-row-padding w3-round-large w3-animate-left" style="z-index:3" id="mySidebar">
                <div class="w3-row m3 w3-row-padding w3-margin-top w3-round-large" style="background-color: #ffd1dc">
                    <div class="w3-container w3-margin-top w3-margin-bottom">
                        <a href="#" onclick="close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
                            <i class="fa fa-remove"></i>
                        </a>
                        <h1 class="food-and-drink-title">MEDICINE RECOMMENDATION</h1>
                        <br>
                        <p style="text-align: center">This feature facilitates the process of recommending medicine for ophthalmic diagnoses.</p>
                        <p style="text-align: center">The list of commonly recommended medicine for the chosen diagnosis generated by this system aids ophthalmologists in selecting the right medicine.</p>
                    </div>
                </div>

                <div class="w3-row m3 w3-row-padding w3-margin-bottom w3-margin-top w3-round-large w3-collapse" style="z-index:3; background-color: #ffd1dc">
                    <div class="w3-container w3-margin-top w3-margin-bottom">
                        <a class="main w3-bar-item w3-button w3-padding">
                            <i class='w3-margin-right fas fa-sign-in-alt'></i>Input: Disease
                        </a>

                        <a class="main w3-bar-item w3-button w3-padding">
                            <i class="fas fa-sign-out-alt w3-margin-right"></i>Output: Medicine
                        </a>

                    </div>
                </div>
            </nav>

            <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

            <!--Page Content-->

            <div class="w3-col m9 w3-container w3-row-padding w3-margin-top w3-round-large w3-animate-right" style="background-color: #ffd1dc">
                <!-- Selected symptoms -->
                <div class="w3-col l8 w3-row-padding w3-round-large w3-animate-right">
                    <div class="w3-container w3-margin-top w3-margin-bottom">
                        <div class="section-title">DISEASE:</div>
                        <div id="symps"></div>
                        <div>
                            <div class="section-title" id="DiseaseTitle"></div>
                            <div id="Disease1"></div>
                        </div>
                    </div>
                </div>
                <!-- List of symptoms -->

                <div class="w3-col m4 w3-row-padding w3-round-large w3-animate-right" style="z-index:3" id="mySidebar">
                    <div class="SymptomsGroup">
                        <div class="btn-group">
                            <div class="buttonSymptom" id="buttonSymptom1">Cận thị</div>
                            <div class="buttonSymptom" id="buttonSymptom2">Loạn thị</div>
                            <div class="buttonSymptom" id="buttonSymptom3">Lão thị</div>
                            <div class="buttonSymptom" id="buttonSymptom4">Viêm giác mạc</div>
                            <div class="buttonSymptom" id="buttonSymptom5">Rách võng mạc</div>
                            <div class="buttonSymptom" id="buttonSymptom6">Đục thủy tinh thể</div>
                            <div class="buttonSymptom" id="buttonSymptom7">Viêm giác mạc</div>
                            <div class="buttonSymptom" id="buttonSymptom8">Rối loạn phim nước mắt</div>
                        </div>
                    </div>
                    <p id="demo"></p>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        //scroll when hit the y

        $(document).ready(function() {
            // Add smooth scrolling to all links
            $("a").on('click', function(event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        });
        // FETCH
        const buttonSymptomElement1 = document.querySelector('#buttonSymptom1');
        const buttonSymptomElement2 = document.querySelector('#buttonSymptom2');
        const buttonSymptomElement3 = document.querySelector('#buttonSymptom3');
        const buttonSymptomElement4 = document.querySelector('#buttonSymptom4');
        const buttonSymptomElement5 = document.querySelector('#buttonSymptom5');
        const buttonSymptomElement6 = document.querySelector('#buttonSymptom6');
        const buttonSymptomElement7 = document.querySelector('#buttonSymptom7');
        const buttonSymptomElement8 = document.querySelector('#buttonSymptom8');
        const SubmitSymptomFunction = document.querySelector('#SubmitSymptomFunction');

        // PRINT
        const symps = document.querySelector('#symps');
        const DiseaseTitle = document.querySelector('#DiseaseTitle');

        var Symptom_Name = [];

        buttonSymptomElement1.onclick = () => {
            Symptom_Name.push("Cận thị");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement2.onclick = () => {
            Symptom_Name.push("Loạn thị");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement3.onclick = () => {
            Symptom_Name.push("Lão thị");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement4.onclick = () => {
            Symptom_Name.push("Viêm giác mạc");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement5.onclick = () => {
            Symptom_Name.push("Rách võng mạc");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="Refresh Tears (Natri Carboxymethyl cellulose 0,5%),Indocollyre 0,1% (Indomethacine 0,1%), Hylene (Na Hyaluronate), Acetazolamid, SuperKan F (ginkgo biloba 80mg), Ocuvite, Kaleorid LP 600mg (Potassium Chloride 600mg)";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement6.onclick = () => {
            Symptom_Name.push("Đục thủy tinh thể");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="Hylene (Na Hyaluronate), Logpatat (Vitamin A, E), Circumax 120mg (Ginkgo Biloba 120mg), Kary Uni (Pirenoxine 0.05mg), Hylene (Na Hyaluronate), Dewoton (Vitamin, Minerals)";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement7.onclick = () => {
            Symptom_Name.push("Viêm giác mạc");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }
        buttonSymptomElement8.onclick = () => {
            Symptom_Name.push("Rối loạn phim nước mắt");
            symps.textContent = `${Symptom_Name}`;
            var Title = "Medicine:";
            DiseaseTitle.textContent = `${Title}`;
            var medicine="hehe";
            Disease1.textContent=`${medicine}`;
        }

    </script>

</body>

</html>