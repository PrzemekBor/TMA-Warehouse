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

$columns = array('employee_name','items.item_group','request.unit_of_measurement','request.quantity', 'request.price_UAH', 'comment', 'request.status',);

$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

if ($result = $data->query('SELECT request.employee_name, items.item_group, request.unit_of_measurement, request.quantity,request.price_UAH, comment , request.status FROM request INNER JOIN items on request.item_id = items.item_id ORDER BY ' .  $column . ' ' . $sort_order)) {
$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order);
$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
$add_class = ' class="highlight"';
?>
<body>
<div id="login_user">
    <a>Hello, <?php echo $login_user;?>!</a>
    <a id="button" href="logout.php">Log out</a>
    <a id="button" href="coordinator.php">Back</a>
    <br>
</div>

<div id="logo">
    <p>Trade and Material Assets (TMA) Warehouse</p>
    <span>List of requests</span>
</div>
<table>
    <tr>
        <th><a href="?column=employee_name&order=<?php echo $asc_or_desc; ?>">Employee name<i class="fas fa-sort<?php echo $column == 'employee_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=item_group&order=<?php echo $asc_or_desc; ?>">Item Group<i class="fas fa-sort<?php echo $column == 'item_group' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=unit_of_measurement&order=<?php echo $asc_or_desc; ?>">Unit<i class="fas fa-sort<?php echo $column == 'unit_of_measurement' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=quantity&order=<?php echo $asc_or_desc; ?>">Quantity<i class="fas fa-sort<?php echo $column == 'quantity' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=price_UAH&order=<?php echo $asc_or_desc; ?>">Price UAH<i class="fas fa-sort<?php echo $column == 'price_UAH' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=comment&order=<?php echo $asc_or_desc; ?>">Comment<i class="fas fa-sort<?php echo $column == 'comment' ? '-' . $up_or_down : ''; ?>"></i></a></th>
        <th><a href="?column=status&order=<?php echo $asc_or_desc; ?>">Status<i class="fas fa-sort<?php echo $column == 'status' ? '-' . $up_or_down : ''; ?>"></i></a></th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td<?php echo $column == 'employee_name' ? $add_class : ''; ?>><?php echo $row['employee_name']; ?></td>
            <td<?php echo $column == 'item_group' ? $add_class : ''; ?>><?php echo $row['item_group']; ?></td>
            <td<?php echo $column == 'unit_of_measurement' ? $add_class : ''; ?>><?php echo $row['unit_of_measurement']; ?></td>
            <td<?php echo $column == 'quantity' ? $add_class : ''; ?>><?php echo $row['quantity']; ?></td>
            <td<?php echo $column == 'price_UAH' ? $add_class : ''; ?>><?php echo $row['price_UAH']; ?></td>
            <td<?php echo $column == 'comment' ? $add_class : ''; ?>><?php echo $row['comment']; ?></td>
            <td<?php echo $column == 'status' ? $add_class : ''; ?>><?php echo $row['status']; ?></td>



        </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
<?php
$result->free();
}
?>
