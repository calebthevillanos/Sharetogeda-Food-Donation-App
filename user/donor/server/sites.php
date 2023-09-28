<?php
require "../../connection.php";
$sql = "SELECT * FROM donation_sites";
$stmt = mysqli_stmt_init($conn);
$sites = [];
$n = $db->query($sql);
foreach($n as $row)
{
    array_push($sites, $row);
}
?>