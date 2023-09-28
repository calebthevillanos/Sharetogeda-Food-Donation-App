<?php
require 'database/databas.php';
$sql = "SELECT * FROM donations WHERE status = 'new';";
$stmt = mysqli_stmt_init($conn);
$st = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
  header("Location: ../receiver/index.html?Erorr-occured");
}
else
{
    mysqli_stmt_execute($stmt);   
    $result = mysqli_stmt_get_result($stmt);
}
?>