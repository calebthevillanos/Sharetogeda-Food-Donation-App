<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Receipt History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
 
</head>
<body>
    <div>
        <h2 class="title">Receipt History</h2>
        
        
        <table id="example" class="table table-striped table-bordered" style="width:100%">
             <thead>
            <tr id="header">
                <th class="center">Reservation ID</th>
                <th>Receipt Image</th>
                <th>Date</th>
            </tr>
        </thead>
            <tbody>     
            <?php
           require '../../connection.php';
           $userId = $_SESSION['userId'];
           $n = $db->query("select * from reservationProof where userId='$userId'");
            foreach($n as $row)
            {

          ?>
            <tr class="odd">
                <td class="donation-id" class="center"><?php echo $row['reservationId'] ?></td>
                <td class="receiver-id">
                <img src="<?= "./receipts/".$row['photo'] ?>"  alt="Upload Receipt Proof" width="50" height="50" />
                </td>
                <td class="status"><?php echo $row['date'] ?></td>
            </tr>
        <?php

}

?>
</tbody>
        </table>
    </div>
</body>

<script>
$(document).ready(function () {
    $('#example').DataTable();
});
 </script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>


<script src="../js/history.js"></script>
<script src="js/receipt-history.js"></script>
</html>