<?php
include('login.php');

if ((isset($_SESSION['login']) != ''))
{
    header('Location: home.php');
}


?>
<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Trade and Material Assets (TMA) Warehouse</title>
        <link href="css/index.css" rel="stylesheet" type="text/css">
    </head>

    <body>


    <header>
        <div id="menu">
            <ul>
                <li><a href="index.php">HOME PAGE</a></li>
            </ul>
        </div>
    </header>
    <div id="logo">
        <p>Trade and Material Assets (TMA) Warehouse</p>
        <span>Choose what you want to do</span>
    </div>

    <div id="footer">
        <div class="box">
            <a id="button2" href="#popup1">SING IN</a>
            <a id="button2" href="#popup2">LOG IN</a>
        </div>

        <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Registration</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Fill in the details:<br><br>
                    You Are:
                </div>

                <form action="register.php" method="post">
                    <label id="radio"><input type="radio" name="position" value="coordinator" checked />Coordinator</label>
                    <label id="radio"><input type="radio" name="position" value="employee" checked />Employee</label>
                    <input type="text" name="username" required><label>LOGIN</label>
                    <input type="password" name="password" required><label>PASSWORD</label>
                    <input type="hidden" name="send" value="send"/>
                    <input type="submit" value="SEND">
                </form>

            </div>
        </div>

        <div id="popup2" class="overlay">
            <div class="popup">
                <h2>Login</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Fill in the details:
                </div>
                <form method="post" action="">
                    <input type="text" name="username" required placeholder="Login">
                    <input type="password" name="password" required placeholder="Password">
                    <input type="hidden" name="send" value="send">
                    <input type="submit" name="submit" value="LOG IN">
                </form>
            </div>
        </div>
    </body>
    </html>
