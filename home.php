<?php
include("check.php");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home</title>
    <link href="css/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<div id="logo">
    <p>Hello, <?php echo $login_user;?>!</p>
    <span>Choose what you want to do</span>
    <br>
    <span>Click Logout to end the session.</span>
</div>
<div class="box2">
    <a id="button2" href="list_of_goods.php">List of goods</a>
    <a id="button2" href="logout.php">Logout</a>
</div>
</body>
</html>