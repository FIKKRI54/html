<?php
// Set database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "croffledb";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the sign-up form is submitted
if (isset($_POST['signup'])) {
    // Get user input from the form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create SQL query to insert data into the table
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Get user input from the form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Create SQL query to retrieve user from the table
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    // Check if user exists
    if ($result->num_rows > 0) {
        echo "Login successful";
    } else {
        echo "Invalid email or password";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="Reg.css">
    <style>
        *{
            margin:0; 
            padding:0; 
            box-sizing:border-box;
        }
        body {
            height: 100%;
            font-family: "Inconsolata", sans-serif;
        }
        .Noti{
           position: fixed;
           bottom: 50px;
           left: 50px;
           width: max-content;
           padding: 20px 15px;
           border-radius: 4px;
           background-color: #141619;
           color: #f6f5f9;
           box-shadow: 0 1px 10px rgba(0, 0, 0, 0.1);
           transform: translateY(30px);
           opacity: 0;
           visibility: hidden;
           animation: fade-in 4s linear forwards;
           z-index: 9;
        }
        .Noti_progress{
           position: fixed;
           left: 5px;
           bottom: 5px;
           width: calc(100% - 10px);
           height: 3px;
           transform: scaleX(0);
           transform-origin: left;
           background-image: linear-gradient(to right, #539bdb, #3250bf);
           border-radius: inherit;
           animation: load 3s 0.25s linear forwards;
           z-index: 9;
        }
        @keyframes fade-in{
           5%{
               opacity: 1;
               visibility: visible;
               transform: translateY(0);
           }
           90%{
               opacity: 1;
               transform: translateY(0);
           }
        }
        @keyframes load{
           to {
               transform: scaleX(1);
           }
        }
        .bgimg{
            background-position: center;
            background-size: cover;
            background-image: url(beige-paper-background-simple-diy-craft_53876-132916.avif);
            min-height: 85%;
        }
        .menu
        {
            display: none;
        }
        .cs-top{
            position: fixed;
            width:100%;
            z-index:1
        }
        .cs-top{
            top: 0px;
        }
        .cs-topbar{
            border-top:6px solid #ccc!important
        }
        .cs-row::after,.cs-row:before,.cs-row-padding:after,.cs-row-padding:before,
        .cs-cell-row:before,.cs-cell-row:after,.cs-clear:after,.cs-clear:before,.cs-bar:before,.cs-bar:after{
            content:"";
            display:table;
            clear:both
        }
        .cs-row-padding,.cs-row-padding>.cs-half,.cs-row-padding>.cs-third,.cs-row-padding>.cs-twothird,.cs-row-padding>.cs-threequarter,.cs-row-padding>.cs-quarter,.cs-row-padding>.cs-col{
            padding:0 8px;
        }
        .cs-padding-small{
            padding:4px 8px!important
        }
        .cs-padding{
            padding:8px 16px!important
        }
        .cs-padding-large{
            padding:12px 24px!important
        }
        .cs-padding-16{
            padding-top:16px!important;padding-bottom:16px!important
        }
        .cs-padding-24{
            padding-top:24px!important;padding-bottom:24px!important
        }
        .cs-padding-32{
            padding-top:32px!important;padding-bottom:32px!important
        }
        .cs-padding-48{
            padding-top:48px!important;padding-bottom:48px!important
        }
        .cs-padding-64{
            padding-top:64px!important;padding-bottom:64px!important
        }
        .cs-padding-top-64{
            padding-top:64px!important
        }
        .cs-padding-top-48{
            padding-top:48px!important
        }
        .cs-padding-top-32{
            padding-top:32px!important
        }
        .cs-padding-top-24{
            padding-top:24px!important
        }
        .cs-black,.cs-hover-black:hover{
            color:#fff!important;
            background-color:#000!important
        }
        .cs-col,.cs-half,.cs-third,.cs-twothird,.cs-threequarter,.cs-quarter{
            float:left;
            width:100%
        }
        .cs-col.s3
        {
            width:24.99999%
        }
        .cs-col.s4{
            width:33.33333%;
        }
        .cs-col.s6
        {
            width: 49.99999%;
        }
        .cs-button{
            -webkit-touch-callout:none;
            -webkit-user-select:none;
            -khtml-user-select:none;
            -moz-user-select:none;
            -ms-user-select:none;
            user-select:none
        }   
        .cs-block{
            display: block;
            width: 100%;
        }
        .cs-display-container{
            position: relative;
        }
        .cs-grayscale-min{
            filter: grayscale(50%);
        }
        .cs-display-bottomleft{
            position: absolute;
            left: 0;
            bottom: 0;
        }
        .cs-center{
            text-align: center!important;
        }
        .cs-hide-small{
            display: none!important;
        }
        .cs-tag{
            background-color: #000;
            color:#fff;
            display: inline-block;
            padding-left: 8px;
            padding-right: 8px;
            text-align: center;
        }
        .cs-display-middle{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            -ms-transform: translate(-50%,-50%);
        }
        .cs-text-cyan{
            color:#074dc5!important
        }
        .cs-text-black{
           color:#000
        }
        .cs-text-white{
            color: #fff;
        }
        .cs-display-bottomright{
            position: absolute;
            right: 0;
            bottom: 0;
        }
        .cs-container:after,.cs-container:before,.cs-panel:after,.cs-panel:before,.cs-row:after,.cs-row:before,.cs-row-padding:after,.cs-row-padding:before,
        .cs-cell-row:before,.cs-cell-row:after,.cs-clear:after,.cs-clear:before,.cs-bar:before,.cs-bar:after
        {
            content:"";
            display:table;
            clear:both
        }
        .cs-transparent{
            background-color: transparent;
        }
        .cs-button {
            position: relative;
            display:inline-block;
            padding: 1em 1.8em;
            outline: none;
            border: 1px solid #303030;
            background: #212121;
            color:#fff;
            white-space: nowrap;
            text-transform: uppercase;
            text-decoration: none;
            letter-spacing: 2px;
            font-size: 15px;
            overflow: hidden;
            transition: 0.2s;
            border-radius: 20px;
            cursor: pointer;
            font-weight: bold;
            vertical-align: middle;
        }

        .cs-button:hover {
            box-shadow: 0 0 10px #01fff4, 0 0 25px #001eff, 0 0 50px #01fff4;
            transition-delay: 0.6s;
        }

        .cs-button span {
            position: absolute;
        }

        .cs-button span:nth-child(1) {
            top: 0;
            left: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #01fff4);
        }

        .cs-button:hover span:nth-child(1) {
            left: 100%;
            transition: 0.7s;
        }

        .cs-button span:nth-child(3) {
            bottom: 0;
            right: -100%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #001eff);
            }

            .cs-button:hover span:nth-child(3) {
            right: 100%;
            transition: 0.7s;
            transition-delay: 0.35s;
            }

            .cs-button span:nth-child(2) {
            top: -100%;
            right: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(180deg, transparent, #01fff4);
            }

            .cs-button:hover span:nth-child(2) {
            top: 100%;
            transition: 0.7s;
            transition-delay: 0.17s;
            }

            .cs-button span:nth-child(4) {
            bottom: -100%;
            left: 0;
            width: 2px;
            height: 100%;
            background: linear-gradient(360deg, transparent, #001eff);
            }

            .cs-button:hover span:nth-child(4) {
            bottom: 100%;
            transition: 0.7s;
            transition-delay: 0.52s;
        }

        .cs-button:active {
            background: #01fff4;
            background: linear-gradient(to top right, #ae00af, #001eff);
            color: #bfbfbf;
            box-shadow: 0 0 8px #01fff4, 0 0 8px #001eff, 0 0 8px #01fff4;
            transition: 0.1s;
        }
        .cs-button:active span:nth-child(1) 
            span:nth-child(2) 
            span:nth-child(2) 
            span:nth-child(2) {
            transition: none;
            transition-delay: none;
        }
        .cs-content,.cs-auto
        {
            margin-left:auto;
            margin-right:auto
        }
        .cs-content
        {
            max-width:980px
        }
        .cs-wide
        {
            letter-spacing: 4px;
        }
        .cs-col.m6, .cs-half
        {
            width:49.99999%;
        }
        .cs-round
        {
            border-radius:4px;
        }
        .cs-image
        {
            max-width: 100%;
            height: auto;
        }
        .cs-opacity-min
        {
            opacity: 0.75;
        }
        .cs-large
        {
            font-size: 18px!important;
        }
        .cs-card
        {
            box-shadow:0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px rgba(0,0,0,0.12);
        }
        .cs-quarter
        {
            float:left;
            width:100%
        }
        .cs-quarter
        {
            width: 24.99999%;
        }
        .cs-dark-grey,.cs-hover-dark-grey:hover,.cs-dark-gray,.cs-hover-dark-gray:hover
        {
            color:#fff!important;
            background-color:#616161!important
        }
        .location-button {
        -moz-appearance: none;
        -webkit-appearance: none;
        appearance: none;
        border: none;
        background: none;
        color: #0f1923;
        cursor: pointer;
        position: relative;
        padding: 8px;
        margin-bottom: 20px;
        text-transform: uppercase;
        font-weight: bold;
        font-size: 14px;
        transition: all .15s ease;
        }

        .location-button::before,.location-button::after {
        content: '';
        display: block;
        position: absolute;
        right: 0;
        left: 0;
        height: calc(50% - 5px);
        border: 1px solid #7D8082;
        transition: all .15s ease;
        }

        .location-button::before {
        top: 0;
        border-bottom-width: 0;
        }

        .location-button::after {
        bottom: 0;
        border-top-width: 0;
        }

        .location-button:active,.location-button:focus {
        outline: none;
        }

        .location-button:active::before,.location-button:active::after {
        right: 3px;
        left: 3px;
        }

        .location-button:active::before {
        top: 3px;
        }

        .location-button:active::after {
        bottom: 3px;
        }

        .location-button_lg {
        position: relative;
        display: block;
        padding: 10px 20px;
        color: #fff;
        background-color: #0f1923;
        overflow: hidden;
        box-shadow: inset 0px 0px 0px 1px transparent;
        }

        .location-button_lg::before {
        content: '';
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        width: 2px;
        height: 2px;
        background-color: #0f1923;
        }

        .location-button_lg::after {
        content: '';
        display: block;
        position: absolute;
        right: 0;
        bottom: 0;
        width: 4px;
        height: 4px;
        background-color: #0f1923;
        transition: all .2s ease;
        }

        .location-button_sl {
        display: block;
        position: absolute;
        top: 0;
        bottom: -1px;
        left: -8px;
        width: 0;
        background-color: #074dc5;
        transform: skew(-15deg);
        transition: all .2s ease;
        }

        .location-button_text {
        position: relative;
        }

        .location-button:hover {
        color: #0f1923;
        }

        .location-button:hover .location-button_sl {
        width: calc(100% + 15px);
        }

        .location-button:hover .location-button_lg::after {
        background-color: #fff;
        }
        .cs-input{
            padding:8px;
            display:block;
            border:none;
            border-bottom:1px solid #ccc;
            width:100%;
        }
        .cs-border{
            border:1px solid #ccc !important
        }
        .cs-justify{
            text-align:justify!important;
        }
        .cs-opacity,.cs-hover-opacity:hover{
            opacity:0.60
        }
        .cs-opacity-off,.cs-hover-opacity-off:hover{
            opacity: 1;
        }
        .cs-button-2{
             -webkit-touch-callout:none;
             -webkit-user-select:none;
             -khtml-user-select:none;
             -moz-user-select:none;
             -ms-user-select:none;
             user-select:none
         }
         .cs-button-2 {
             position: relative;
             display:inline-block;
             padding: 1em 1.8em;
             outline: none;
             border: 1px solid #303030;
             background: #212121;
             color:#fff;
             white-space: nowrap;
             text-transform: uppercase;
             text-decoration: none;
             letter-spacing: 2px;
             font-size: 15px;
             overflow: hidden;
             transition: 0.2s;
             border-radius: 20px;
             cursor: pointer;
             font-weight: bold;
             vertical-align: middle;
             width: 130px;
            height: 50px;
            background: transparent;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            color: #ffff;
            font-weight: 500;
            margin-left: 40px;
            transition: .5s;
         }
         .cs-button-2:hover {
             box-shadow: 0 0 10px #01fff4, 0 0 25px #001eff, 0 0 50px #01fff4;
             transition-delay: 0.6s;
             background: #fff;
    color: #162938;
         }
         .cs-button-2 span {
             position: absolute;
         }
         .cs-button-2 span:nth-child(1) {
             top: 0;
             left: -100%;
             width: 100%;
             height: 2px;
             background: linear-gradient(90deg, transparent, #01fff4);
         }
         .cs-button-2:hover span:nth-child(1) {
             left: 100%;
             transition: 0.7s;
         }
         .cs-button-2 span:nth-child(3) {
             bottom: 0;
             right: -100%;
             width: 100%;
             height: 2px;
             background: linear-gradient(90deg, transparent, #001eff);
             }
             .cs-button-2:hover span:nth-child(3) {
             right: 100%;
             transition: 0.7s;
             transition-delay: 0.35s;
             }
             .cs-button-2 span:nth-child(2) {
             top: -100%;
             right: 0;
             width: 2px;
             height: 100%;
             background: linear-gradient(180deg, transparent, #01fff4);
             }
             .cs-button-2:hover span:nth-child(2) {
             top: 100%;
             transition: 0.7s;
             transition-delay: 0.17s;
             }
             .cs-button-2 span:nth-child(4) {
             bottom: -100%;
             left: 0;
             width: 2px;
             height: 100%;
             background: linear-gradient(360deg, transparent, #001eff);
             }
             .cs-button-2:hover span:nth-child(4) {
             bottom: 100%;
             transition: 0.7s;
             transition-delay: 0.52s;
         }
         .cs-button-2:active {
             background: #01fff4;
             background: linear-gradient(to top right, #ae00af, #001eff);
             color: #bfbfbf;
             box-shadow: 0 0 8px #01fff4, 0 0 8px #001eff, 0 0 8px #01fff4;
             transition: 0.1s;
         }
            
        @font-face {
            font-family: CafeFrancoise;
            src: url('CafeFrancoise-EapP9.ttf') format('truetype');
        }
        </style>
</head>

<body>
            <div class="cs-top">
                <div class="cs-row cs-padding cs-transparent">
                    <div class="cs-col s3 cs-center">
                        <a class="cs-button cs-padding" href="Home.html">
                            <span></span>HOME
                        </a>
                    </div>
                    <div class="cs-col s3 cs-center">
                        <a class="cs-button cs-padding btnLogin-popup">
                            <span></span>SIGN IN 
                        </a>
                    </div>
                    <div class="cs-col s3 cs-center">
                        <a class="cs-button cs-padding" href="Menu.html">
                            <span></span>MENU
                        </a>
                    </div>
                    <div class="cs-col s3 cs-center">
                        <a class="cs-button cs-padding" href="Location.html">
                            <span></span>LOCATION
                        </a>
                    </div>
                </div>
            </div>
    
    <div class="wrapper">
        <span class="icon-close"><ion-icon name="close-circle"></ion-icon></span>

        <div class="form-box login">
            <h2>Login</h2>
            <form method="post" action="">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="mail"></ion-icon>
                    </span>
                    <input type="text" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> Remember me</label>
                </div>
                <button type="submit" name="login" value="Login" class="btn">Login</button>
                <div class="login-register">
                    <p>Don't have an account? <a href="#" class="register-link">Register</a></p>
                </div>
            </form>
        </div>

        <div class="form-box register">
            <h2>Registration</h2>
            <form method="post" action="">
                <div class="input-box">
                    <span class="icon">
                        <ion-icon name="person"></ion-icon>
                    </span>
                    <input type="text" name="name" required>
                    <label>Full Name</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail"></ion-icon></span>
                    <input type="text" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox"> I agree to the terms & conditions</label>
                </div>
                <button type="submit" name="signup" value="Sign Up" class="btn">Register</button>
                <div class="login-register">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="Refscript.js"></script>
</body>

</html>
