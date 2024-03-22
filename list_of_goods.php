<?php
include("check.php");
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/index.css" rel="stylesheet" type="text/css">
    <title>List of goods</title>
</head>

<?php
$data = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

$columns = array('item_group','unit_of_measurement','quantity', 'price_UAH', 'status', 'storage_location', 'contact_person');

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $data->query('SELECT * FROM items ORDER BY ' .  $column . ' ' . $sort_order)) {
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';
?>
<body>
<div id="login_user">
    <a>Hello, <?php echo $login_user;?>!</a>
    <a id="button" href="logout.php">Log out</a>
    <a id="button" href="home.php">Back</a>
    <br>
</div>

<div id="logo">
    <p>Trade and Material Assets (TMA) Warehouse</p>
    <span>List of goods</span>
</div>

<div id="order">
    <div class="box3">
        <a id="button" href="#popup1">ORDER</a>
    </div>

    <table>
        <tr>
            <th><a href="?column=item_group&order=<?php echo $asc_or_desc; ?>">Item Group<i class="fas fa-sort<?php echo $column == 'item_group' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=unit_of_measurement&order=<?php echo $asc_or_desc; ?>">Unit<i class="fas fa-sort<?php echo $column == 'unit_of_measurement' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=quantity&order=<?php echo $asc_or_desc; ?>">Quantity<i class="fas fa-sort<?php echo $column == 'quantity' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=price_UAH&order=<?php echo $asc_or_desc; ?>">Price UAH<i class="fas fa-sort<?php echo $column == 'price_UAH' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=status&order=<?php echo $asc_or_desc; ?>">Status<i class="fas fa-sort<?php echo $column == 'status' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=storage_location&order=<?php echo $asc_or_desc; ?>">Status<i class="fas fa-sort<?php echo $column == 'storage_location' ? '-' . $up_or_down : ''; ?>"></i></a></th>
            <th><a href="?column=contact_person&order=<?php echo $asc_or_desc; ?>">Contact Person<i class="fas fa-sort<?php echo $column == 'contact_person' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td<?php echo $column == 'item_group' ? $add_class : ''; ?>><?php echo $row['item_group']; ?></td>
                <td<?php echo $column == 'unit_of_measurement' ? $add_class : ''; ?>><?php echo $row['unit_of_measurement']; ?></td>
                <td<?php echo $column == 'quantity' ? $add_class : ''; ?>><?php echo $row['quantity']; ?></td>
                <td<?php echo $column == 'price_UAH' ? $add_class : ''; ?>><?php echo $row['price_UAH']; ?></td>
                <td<?php echo $column == 'status' ? $add_class : ''; ?>><?php echo $row['status']; ?></td>
                <td<?php echo $column == 'storage_location' ? $add_class : ''; ?>><?php echo $row['storage_location']; ?></td>
                <td<?php echo $column == 'contact_person' ? $add_class : ''; ?>><?php echo $row['contact_person']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>


    <div id="popup1" class="overlay">
        <div class="popup">
            <h2>Fill Your order:</h2>
            <a class="close" href="#">&times;</a>


            <form action="order.php" method="post">
                <?php
                $query ="SELECT * FROM items";
                $result = $data->query($query);
                if($result->num_rows> 0){
                    $options= mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
                ?>
                <select name="GroupID" id="choice"><option>Item name</option>
                    <?php
                    foreach ($options as $option) {
                        ?>
                        <option><?php echo $option['item_group'];  ?> </option>
                        <?php
                    }
                    ?>
                </select>

                <select name="unit_of_measurement" id="choice" required><option>Unit of measurement</option>
                    <?php
                    foreach ($options as $option) {
                        ?>
                        <option><?php echo $option['unit_of_measurement']; ?> </option>
                        <?php
                    }
                    ?>
                </select>

                <input type="text" name="quantity" required><label>Quantity</label>

                <input type="text" name="comment" required><label>Comment</label>
                <input type="hidden" name="item_id"/>
                <input type="hidden" name="send" value="send"/>
                <input type="submit" value="SEND">
            </form>

        </div>
    </div>
</body>
</html>
<?php
$result->free();
}
?>
