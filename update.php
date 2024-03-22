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
            <li><a href="coordinator.php">HOME PAGE</a></li>
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
    $item_group = $to_db_data['item_group'];
    $unit_of_measurement = $to_db_data['unit_of_measurement'];
    $quantity = $to_db_data['quantity'];
    $price_UAH = $to_db_data['price_UAH'];
    $status = $to_db_data['status'];
    $storage_location = $to_db_data['storage_location'];
    $contact_person = $to_db_data['contact_person'];



        if ($db->query("UPDATE items SET (`item_group`=$item_group,`unit_of_measurement`=$unit_of_measurement, `quantity`=$quantity, `price_UAH`=$price_UAH, `status`=$status, `storage_location`=$storage_location, `contact_person`=$contact_person)
    WHERE $item_group=item_id")) {

            print "<div id=\"logo\">
        <p>Rows updated</p>
        <div id=\"logo\">
    <span>Choose what you want to do</span>
    <br>
    <span>Click Logout to end the session.</span>
</div>
<div class=\"box\">
    <a id=\"button2\" href=\"list_of_goods_c.php\">List of goods</a>
    <a id=\"button2\" href=\"coordinator.php\">Purchase requests</a>
    <a id=\"button2\" href=\"logout.php\">Logout</a>
</div>
    </div>";
        } else {

            print('');
        }

}
?>
</body>
</html>