<?php

require 'database/databas.php';
$sql = "SELECT count(*) FROM donations where receivername = ? and status = 'pending' or status = 'complete';";
$stmt = mysqli_stmt_init($conn);
$st = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
   header("Location: ../receiver/index.php?Error-Occured");
   exit();
}
else
{
    session_start();
    mysqli_stmt_bind_param($stmt,"s",$_SESSION['fullname']);
    mysqli_stmt_execute($stmt);   
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $total = implode($row);
}



?>