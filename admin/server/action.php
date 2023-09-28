<?php
require("db.php");
if(isset($_POST["cancel"]))
{
    session_start();
    $donation_id = $_SESSION["donation_id"];
    $sql = "UPDATE donations SET status= 'New' WHERE donation_id = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo `<script>alert('Error'+mysqli_error())</script>`;
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s",  $donation_id);
                    mysqli_stmt_execute($stmt);
                    echo "<script> alert('Donation modified successfully') 
                    window.location.href='../index.php';
                    </script>";
            }

}
if(isset($_POST["accept"]))
{
    session_start();
    $donation_id = $_SESSION["donation_id"];
    $sql = "UPDATE donations SET status= 'Completed' WHERE donation_id = ?";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo `<script>alert('Error'+mysqli_error())</script>`;
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "s",  $donation_id);
                    mysqli_stmt_execute($stmt);
                    echo "<script> alert('Donation accepted successfully') </script>";
            }

}

?>