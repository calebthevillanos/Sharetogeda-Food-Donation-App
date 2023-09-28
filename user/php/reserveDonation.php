<?php
require 'database/databas.php';
if(isset($_POST['reserve'])) {
   $id = $_POST['id'];
 
$sql = "UPDATE  donations SET status = 'pending',receivername = ? WHERE donation_id = ?;";
$stmt = mysqli_stmt_init($conn);

if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../receiver/index.html?Error");
    exit();
}
else
{
    session_start();
    $name = $_SESSION['fullname'];
    mysqli_stmt_bind_param($stmt,"ss",$name,$id);
    mysqli_stmt_execute($stmt);   
     echo "Reservation Ok";
}
}
else{
    header("Location: ../receiver/index.html?Error");
    exit();
}


?>