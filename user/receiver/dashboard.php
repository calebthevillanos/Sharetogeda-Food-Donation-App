<?php
session_start();
require '../../connection.php';

$reservations = [];
$userId = $_SESSION['userId'];

$n = $db->query("select * from reservations where userId='$userId'");
$total = $pending = $reserved = 0; 

foreach($n as $row){
 if(strtolower($row['status'])=='pending'){
    ++$pending;
 }else if(strtolower($row['status'])=='reserved'){
    ++$reserved;
 }

 ++$total;
}

$reservations['total'] = $total;
$reservations['pending'] = $pending;
$reservations['reserved'] = $reserved;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <main>
        <h2>
            <div id="container">
                <span class="child">
                    <span id="step-one">Hi&#32;</span>
                    <span id="step-two"><?= $_SESSION["fullname"]?>,&#32;</span>
                    <span id="step-three">welcome&#32;</span>
                    <span id="step-four">back</span>
                </span>
                <span id="step-five">.</span>

            </div>
            <span id="phrase">Hi <?= $_SESSION["fullname"]?>, welcome back</span>
        </h2>
        <div id="info-container">

             <div class="info" id="incomplete">
                <span>Pending Reservations</span>
                <div class="amount">
                    <span><?= $reservations['pending'] ? $reservations['pending']:0  ?></span>
                    <i class="fa-solid fa-angles-right" title="View More"></i>
                </div>
            </div>

            <div class="info" id="successful">
                <span>Successfull Reservations</span>
                <div class="amount">
                    <span><?= $reservations['reserved'] ? $reservations['reserved']:0  ?></span>
                    <i class="fa-solid fa-angles-right" title="View More"></i>
                </div>
            </div>

            <div class="info" id="successful">
                <span>Total Reservations</span>
                <div class="amount">
                    <span><?= $reservations['total'] ? $reservations['total']:0  ?></span>
                    <i class="fa-solid fa-angles-right" title="View More"></i>
                </div>
            </div>
           
        </div>
    </main>
</body>
<script src="../js/dashboard.js"></script>
<script src="js/dashboard.js"></script>
</html>