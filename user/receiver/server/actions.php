<?php
session_start();
require "db.php";
if(isset($_POST["reserve"]))
{
    $name = $_SESSION['fullname'];
    $sql = "UPDATE donations SET status='Reserve', receivername=? WHERE donation_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?loginerror-sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $name,$_SESSION["donation_id"]);
        mysqli_stmt_execute($stmt);
        header("Location: ../index.php");
        exit();
    }
}
if(isset($_POST["cancel"]))
{
    $new = 'New';
    $sql = "UPDATE donations SET status='New', receivername=? WHERE donation_id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../login.php?loginerror-sqlerror");
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $new, $_SESSION["donation_id"]);
        mysqli_stmt_execute($stmt);
        header("Location: ../index.php");
        exit();
    }
}
?>