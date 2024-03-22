<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <p>Trade and Material Assets (TMA) Warehouse</p>
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>


<header>
    <div id="menu">
        <ul>
            <li><a href="index.php">HOME PAGE</a></li>
        </ul>
</header>

<?php

if(isset($_POST) && !empty($_POST['send']) && $_POST['send']=='send'){

    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'tma_warehouse');
    define('DBHOST', 'localhost');


    require_once('classes/mysql.php');

    $db = new db();

    $to_db_data = array();
    foreach($_POST as $key=>$val){
        $to_db_data[$key] = "'".addslashes($val)."'";
    }

    $username = $to_db_data['username'];
    $password = $to_db_data['password'];
    $position = $to_db_data['position'];


    if ($db->num_rows($db->query("SELECT username FROM users WHERE username = $username;")) == 0) {
        if ($db->query("INSERT INTO users (`username`, `password`,`position`)
    values ($username,$password,$position)")) {

            print "<div id=\"logo\">
        <p>REGISTRATION WAS SUCCESSFUL</p>
    </div>
    <div id=\"footer\">
        <div class=\"box\">
            <a id=\"button2\" href=\"#popup2\">LOG IN</a>
        </div>
        <div id=\"popup2\" class=\"overlay\">
            <div class=\"popup\">
                <h2>LOGIN</h2>
                <a class=\"close\" href=\"#\">&times;</a>
                <div class=\"content\">
                     Fill in the details:
                </div>
                 <form method=\"post\" action=\"\">
                    <input type=\"text\" name=\"username\" placeholder=\"Login\">
                    <input type=\"password\" name=\"password\" placeholder=\"Password\">
                    <input type=\"hidden\" name=\"send\" value=\"send\">
                    <input type=\"submit\" name=\"submit\" value=\"LOG IN\">
                </form>
            </div>
        </div>";
        } else {

            print('');
        }
    }
    else print "<div id=\"logo\">
        <p>THE GIVEN LOGIN ALREADY EXISTS! CHOOSE ANOTHER.</p>
    </div>
     <div id=\"footer\">
        <div class=\"box\">
            <a id=\"button\" href=\"#popup1\">REGISTER</a>
        </div>

        <div id=\"popup1\" class=\"overlay\">
            <div class=\"popup\">
                <h2>REGISTRATION</h2>
                <a class=\"close\" href=\"#\">&times;</a>
                <div class=\"content\">
                     Fill in the details:
                </div>

                    <form action=\"register.php\" method=\"post\">
                    <label id=\"radio\"><input type=\"radio\" name=\"position\" value=\"coordinator\" checked />Coordinator</label>
                    <label id=\"radio\"><input type=\"radio\" name=\"position\" value=\"employee\" checked />Employee</label>
                    <input type=\"text\" name=\"username\" required><label>LOGIN</label>
                    <input type=\"password\" name=\"password\" required><label>HASLO</label>
                    <input type=\"hidden\" name=\"send\" value=\"send\"/>
                    <input type=\"submit\" value=\"SEND\">
                </form>

            </div>
        </div>";

}
?>
</body>
</html>
