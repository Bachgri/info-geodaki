<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form </title>
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

    <script src="./js/jquery-3.6.0.js"></script>
    <style>
        #imgWait {
            width: 100%;
            height: 100vh;
            text-align: center;
            position: absolute;
            background-color: lightgray;
            opacity: 0.9;
            right: 0120%;
            align-items: center;
            border: 3px solid black;
            top: 0;
            padding-top: 20vh;
        }

        #imgWait img {
            opacity: 1;
            width: 60%;
            height: 20vh;
        }
    </style>
    <script>
        var IDUSER = '';
    </script>
</head>

<body>
    <div class="container" id="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
            <form method="POST" id="FormLogin" action="login.php">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="login" placeholder="Email or Phone" id="login" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" id="password" required>
                </div>
                <!-- <div class="row">
                    <i class="fa fa-globe"></i>
                    <select id="ville" name='ville' class="form-control" style="width: 86%; height: 100%;margin-left: 14% !important;font-weight: bold;font-size: 12pt;">
                        <option value="0"> ------- </option>
                        <option value="tanger"> Tanger </option>
                        <option value="marrakech"> Marrakech </option>
                        <option value="arma"> Arma </option>
                    </select>
                </div> -->
                <div class="row" id="txtErr" style="height: auto;"></div>
                <div class="row button">
                    <input type="submit" value="Login" id="btnLogin">
                </div>
            </form>
            <p style="padding-left: 20pt;font-size: 8pt;">Made by <a href="https://insightsolutions.ma/" target="_blank">INSIGHT SOLUTIONS</a> &copy; 2022 || Version 1.2.0</p>

        </div>
    </div>
    <div id="imgWait">
        <img src="./images/wait.gif" alt="">
    </div>
    <script src="./js/login.js"> </script>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/jquery/dist/jquery.js"></script>
    <script src="./js/jquery-3.6.0.js"></script>
</body>

</html>