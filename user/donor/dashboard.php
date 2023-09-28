<?php
session_start();
$name = explode(" ", $_SESSION["fullname"]);
$name = $name[0];
$fullname = $_SESSION["fullname"];

require '../../connection.php';
$counts = [];
$count = $pending = 0;
$n = $db->query("SELECT * from donations where donorName='$fullname'");

// going through all 
foreach($n as $row){
    if(strtolower($row['status'])==='pending'){
        ++$pending;
    }
    ++$count;
}

$counts['total'] = $count;
$counts['pending'] = $pending;


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
                    <span id="step-two" style="text-transform: capitalize"><?= $name; ?>,&#32;</span>
                    <span id="step-three">welcome&#32;</span>
                    <span id="step-four">back</span>
                </span>
                <span id="step-five">.</span>

            </div>
            <span id="phrase">Hi 
            <span style="text-transform: capitalize"><?= $name; ?>,&#32;</span> 
                welcome back.</span>
        </h2>
        <div id="info-container">
            <div class="info" id="pending">
                <span>Pending Donations</span>
                <div class="amount">
                    <span><?= count($counts) > 0 ? $counts['pending']:0 ?></span>
                    <i class="fa-solid fa-angles-right" title="View More"></i>
                </div>
            </div>
            <div class="info" id="total">
                <span>Total Donations</span>
                <div class="amount">
                    <span><?= count($counts) > 0 ? $counts['total']:0 ?></span>
                    <i class="fa-solid fa-angles-right" title="View More"></i>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="../js/dashboard.js"></script>
<script src="js/dashboard.js"></script>
</html>