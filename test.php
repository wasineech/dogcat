<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Galada" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
</head>
<body>
    <div class="navbar">

    <?php
   //header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $sql = "SELECT * FROM pet WHERE pet_name = 'ei'";
    $query = mysqli_query($con,$sql);
    $result = array();

    while($row = mysqli_fetch_array($query)){

       echo "<img src='" . $row["pet_picture"] . "' alt='I'>";
    }

mysqli_close($con);
?> 
    <span class="left">
        <img width="200px" src="img/logo.png" id="logo">
    </span>
    <span class="right">
        <a href="home.php">Home</a>
        <div class="dropdown">
            <button class="dropbtn">Guides 
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
            <a href="menu.php">calorie</a>
            <a href="healthymenu.php">healthy set</a>
            <a href="losemenu.php">lose weight set</a>
            <a href="gianmenu.php">gain weight set</a>
            </div>
        </div> 
        <a href="login.php">Login</a>
        <a href="reg.php">Register</a>
    </span>
    </div>

    <div class="main">
    
        <header class="containerheader">
            <img width="100%" height="550px" src="header.jpg">
        </header>

        <div class="centered" id="hdname">My Healthy Meal Plan</div>
        <div class="centered" id="hdsubname">วางแผนการรับประทานอาหารด้วยตัวคุณเองง่ายๆ เริ่มกันเลย!</div>

        <span class="centered" id="hdbt">


        <button class="btn success" onclick="window.location.href='/mealplan/login.php'">เข้าสู่ระบบ</button>

        &nbsp&nbsp&nbsp&nbsp

        <button class="btn warning" onclick="window.location.href='/mealplan/reg.php'">สมัครสมาชิก</button>

        </sapn>

    </div>

    <center><h1 class="Htopic">บทความแนะนำ</h1></center>

    <span class="card">
        <img src="img/healthyset.jpg" alt="Avatar" style="width:100%">
        <div class="ctcard">
            <h2><b>healthy menu</b></h2> 
            <a href="healthymenu.php">อ่านเพิ่มเติม>></a> 
        </div>
    </span>
    <span class="card">
        <img src="img/lose.jpg" alt="Avatar" style="width:100%">
        <div class="ctcard">
            <h2><b>lose weight menu</b></h2> 
            <a href="losemenu.php">อ่านเพิ่มเติม>></a> 
        </div>
    </span>
    <span class="card">
        <img src="img/gain.jpg" alt="Avatar" style="width:100%">
        <div class="ctcard">
            <h2><b>gain weight menu</b></h2> 
            <a href="gianmenu.php">อ่านเพิ่มเติม>></a> 
        </div>
    </span>

     <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
                

    <footer>
        <p>COPYRIGHT MY HEALTH MEAL PLAN</p>
    </footer>

    
</body>
</html>




