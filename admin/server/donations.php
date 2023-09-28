<?php
require 'db.php';
$sql = "SELECT * from donations";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?loginerror-sqlerror".mysqli_error($conn));
    exit();
} else {
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $donationDetail = [];
    $userDetail = [];
        while($row = mysqli_fetch_assoc($result)) {
            array_push($donationDetail, $row);
            $sql = "SELECT id, type from users where fullname=? OR fullname=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?loginerror-sqlerror".mysqli_error($conn));
            exit();
           } else {
            mysqli_stmt_bind_param($stmt, "ss", $row["donorName"], $row["receivername"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result))
                {
                    array_push($userDetail, $row);
                }
        }   
    }
}
?>