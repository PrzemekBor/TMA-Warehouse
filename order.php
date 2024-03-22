<?php
include('connection.php');
session_start();
$user_check=$_SESSION['username'];

$ses_sql = mysqli_query($data,"SELECT username FROM users WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];

if(!isset($user_check))
{
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <h2>Trade and Material Assets (TMA) Warehouse</h2>
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>


<header>
    <div id="menu">
        <ul>
            <li><a href="home.php">HOME PAGE</a></li>
        </ul>
</header>

<?php

if(isset($_POST) && !empty($_POST['send']) && $_POST['send']=='send') {

    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBNAME', 'tma_warehouse');
    define('DBHOST', 'localhost');


    require_once('classes/mysql.php');

    $db = new db();

    $to_db_data = array();
    foreach ($_POST as $key => $val) {
        $to_db_data[$key] = "'" . addslashes($val) . "'";
    }
    $unit_of_measurement = $to_db_data['unit_of_measurement'];
    $quantity = $to_db_data['quantity'];
    $price_UAH = $to_db_data['price_UAH'];
    $comment = $to_db_data['comment'];
    $item_id = $to_db_data['item_id'];


    if ($db->num_rows($db->query("SELECT * FROM items INNER JOIN request ON items.item_id=request.item_id WHERE items.item_id = $item_id;")) == 0) {
        if ($db->query("INSERT INTO request (`unit_of_measurement`,`quantity`, `price_UAH`, `comment`, `status`)
    values ($unit_of_measurement,$quantity,$price_UAH,$comment,'New')")) {

            print "<div id=\"logo\">
        <p>Request created</p>
    </div>";
        } else {

            print('');
        }
    }
}
?>
</body>
</html>