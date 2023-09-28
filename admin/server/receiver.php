<?php
require 'db.php';
$sql = "SELECT * from users where type='receiver' ";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?loginerror-sqlerror".mysqli_error($conn));
    exit();
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $receiversId=array();
    $receiversdates=array();
    $receiversName = array();
    $receiversTel = array();
    $receiversAddress = array();
    $receiversEmail = array();
        while($row = mysqli_fetch_assoc($result)) {
            array_push($receiversdates, $row["joinedDate"]);
            array_push($receiversTel, $row["tel"]);
            array_push($receiversAddress, $row["address"]);
            array_push($receiversName, $row["fullname"]);
            array_push($receiversId, $row["id"]);
            array_push($receiversEmail, $row["email"]);
    }
}
?>