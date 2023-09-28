<?php
require 'db.php';
$sql = "SELECT * from users where type='donor' ";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?loginerror-sqlerror".mysqli_error($conn));
    exit();
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $donorsId=array();
    $dates=array();
    $donorsTel = array();
    $donorsAddress = array();
    $donorsName = array();
    $donorsEmail = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($dates, $row["joinedDate"]);
            array_push($donorsTel, $row["tel"]);
            array_push($donorsAddress, $row["address"]);
            array_push($donorsName, $row["fullname"]);
            array_push($donorsId, $row["id"]);
            array_push($donorsEmail, $row["email"]);
    }
}
?>