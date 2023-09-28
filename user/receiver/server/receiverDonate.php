<?php
session_start();
if(isset($_GET["q"]))
{
    if($_GET["q"]=="donations")
    {
$allArray = [];
$name = "Ida Stephanie";
$donationDetail = array();
$userDetail = array();

require "db.php";
$sql = "SELECT * FROM donations WHERE status='Complete' or receivername=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?loginerror-sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
        while($row = mysqli_fetch_assoc($result)) {
            array_push($donationDetail, $row);
            $sql = "SELECT * FROM users WHERE fullname=? OR fullName=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?loginerror-sqlerror".mysqli_error($conn));
                exit();
               } else {
                mysqli_stmt_bind_param($stmt, "ss", $row["donorName"], $name);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                while($row = mysqli_fetch_assoc($result))
                {
                    array_push($userDetail, $row);        
                }
               }
        }
        array_push($allArray, $donationDetail, "#");
        array_push($allArray, $userDetail);
        // array_push($allArray, $receiverLatitude);
        // array_push($allArray, $receiverLongitude);
        // array_push($allArray, $donorName);
        // array_push($allArray, $donationDate);
        // array_push($allArray, $donationId);
        // array_push($allArray, $status);
    }
//echo json_encode($allArray);
}
}
?>
