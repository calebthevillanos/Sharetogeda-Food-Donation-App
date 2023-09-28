
<?php
require 'db/db.php';
$name = $_SESSION["fullname"];
$sql = "SELECT * FROM donations WHERE donorName=?";
$stmt = mysqli_stmt_init($conn);
if(!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location: ../login.php?loginerror-sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $donationId=array();
    $receiver=array();
    $receiverId = array();
    $donorId = array();
    $date=array();
    $expiryDate = array();
    $food = array();
    $status=array();
    $donationDetails = [];
    $userDetails = [];
        while($row = mysqli_fetch_assoc($result)) {
            // array_push($donationId,$row['donation_id']);
            // array_push($date, Date("Y-m-d h:i:s", strtotime($row['donation_date'])));
            // array_push($receiver,$row['receivername']);
            // array_push($food, $row["foodDesc"]);
            // array_push($expiryDate, $row["expiryDate"]);
            // array_push($status,$row['status']);
            array_push($donationDetails, $row);
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
                    // if($row["type"] == "donor")
                    // array_push($donorId, $row["id"]);
                    // if($row["type"] == "receiver")
                    // array_push($receiverId, $row["id"]);
                    array_push($userDetails, $row);
                }
        }
        }
}
?>