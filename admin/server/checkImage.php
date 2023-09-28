<?php
  require("db.php");
  if(isset($_POST["track"]))
  {
    $donorName = $_SESSION["donorName"];
    $itemName = $_SESSION["itemName"];
    $sql = "SELECT COUNT(*) AS num_items FROM donationproof WHERE senderName=? AND item=?";
  $stmt = mysqli_stmt_init($conn);

  if(!mysqli_stmt_prepare($stmt, $sql))
  {

  }
  else {
    mysqli_stmt_bind_param($stmt, "ss", $donorName, $itemName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
     $row = mysqli_fetch_assoc($result);   
     if($row["num_items"] > 0)
        {
            $sql = "UPDATE donations SET status = 'Complete' WHERE foodDesc=?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
            }
            else {
                mysqli_stmt_bind_param($stmt, "s", $itemName);
                mysqli_stmt_execute($stmt);
                echo "<script> alert('Tracked !!!')
                window.location.href = '../index.php'
                </script>";

            }
        } 
        echo "<script> alert('No change !!!')
        window.location.href = '../index.php'
        </script>";
  }
  mysqli_stmt_close($stmt);
}
?>