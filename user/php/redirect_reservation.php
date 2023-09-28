<?php
require 'database/databas.php';
if(isset($_POST['reserve'])) {
$id = $_POST['id'];

$sql = " SELECT * FROM donations WHERE donation_id = ?;";
$stmt = mysqli_stmt_init($conn);
$st = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
   header("Location: ../receiver/index.html?Error-Occureds");
   exit();
}
else
{
  
    mysqli_stmt_bind_param($stmt,"s",$id);
    mysqli_stmt_execute($stmt);   
    $result = mysqli_stmt_get_result($stmt);
  
}
}
else
{

  header("Location: ../receiver/index.html?Error-Occured");
  exit();
}


?>