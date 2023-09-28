<?php
  session_start();
require("db/db.php");
if(isset($_POST['upload']))
{
$donorName = $_SESSION["fullname"];
$filename = $_FILES["proof"]["name"];
$uploadedName = $donorName." ".$filename;
$file_temp = $_FILES["proof"]["tmp_name"];
move_uploaded_file($file_temp, "donation_proofs/".$uploadedName);
$sql = "INSERT INTO donationproof(senderName, photoproof) VALUES(?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo `<script>alert('Error'+mysqli_error())</script>`;
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "ss",  $donorName, $uploadedName);
                    mysqli_stmt_execute($stmt);
                    echo"<script>
                    alert('Proof uploaded Successfully');
                     </script>";
                     header("Location: ../index.php");
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit();
                }
}
?>