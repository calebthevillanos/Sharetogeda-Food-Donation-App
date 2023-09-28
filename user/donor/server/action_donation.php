<?php
    session_start();
require("db/db.php");
if(isset($_POST["submit"]))
{
      $donorName = $_SESSION["fullname"];
      $donorEmail = $_SESSION["email"];
      $food_desc = $_POST["foodName"];
      $food_quantity = $_POST["quantity"];
      $expiry_datetime = $_POST["donordatetime"];
      $sitename = explode("-",$_POST["sitename"])[0];
      $donation_datetime = date('Y-m-d h:i:s');
      srand(time());
      $donation_id =  strval(rand());
      $sql = "INSERT INTO donations(donation_id, donorName, donorEmail, foodDesc, foodQuantity, expiryDate, donation_date, site) VALUES(?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)) {
                    echo `<script>alert('Error'+mysqli_error())</script>`;
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "ssssssss",  $donation_id, $donorName, $donorEmail, $food_desc, $food_quantity, $expiry_datetime, $donation_datetime, $sitename);
                    mysqli_stmt_execute($stmt);
                    
                    echo"<script>
                    alert('Donation saved Successfully');
                    window.location.href='../make-donation.php';
                    </script>";
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    exit();
                }
                
    
}

?>