<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/history-detail.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Receipt History Details</title>
</head>
<body>
    <main>
        <div class="top-info">
            <span id="back-arrow">
                <i class="fa-regular fa-circle-left"></i>
            </span>
            <h1>Receipt Detail</h1>
        </div>
<?php
 require '../php/view-history-detail.php';
 if($row = mysqli_fetch_assoc($result))
 {

?>
        <div id="section-container">
            <section id="left-side">
                <h2 id="user-info" class="info">User Info</h2>
                <div id="user-info-container" class="info-container">
                    <div id="from" class="detail" title="Donor">
                        <div class="header purple">
                            <h5>From</h5>
                            <i class="fa-regular fa-circle-up"></i>
                        </div>
                        <div class="info-detail purple">
                            <div class="overlay"></div>
                            <span>ID: <span id="donor-id"><?php echo $row['donation_id'] ?></span></span>
                            <hr>
                            <span>Name: <span id="donor-name"><?php echo $row['donorName'] ?></span></span>
                        </div>
                    </div>
                    <div id="to" class="detail" title="Receiver">
                        <div class="header yellow">
                            <h5>To</h5>
                            <i class="fa-regular fa-circle-down"></i>
                        </div>
                        <div class="info-detail yellow">
                            <div class="overlay"></div>
                            <span>ID: <span id="receiver-id">292</span></span>
                            <hr>
                            <span>Name: <span id="receiver-name"><?php echo $_SESSION['name'] ?></span></span>
                        </div>
                    </div>
                </div>
            </section>
            
            <!-- <span class="vertical-separator"></span> -->
            
            <section id="right-side">
                <div id="item-info-container" class="info-container">
                    <h2 id="item-info" class="info">Item Info</h2>
                    <ul class="detail-list">
                        <li>
                            <div id="items" class="item-detail">
                                <div class="title">
                                    <h5 class="">Items</h5>
                                </div>
                                <div class="content">
                                    <span id=""><?php echo $row['foodDesc'] ?></span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="quantity" class="item-detail">
                                <h5 class="title">Quantity</h5>
                                <div class="content">
                                    <span id=""><?php echo $row['foodQuantity'] ?></span>
                                    <span id="">&nbsp;respectively</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="status" class="item-detail">
                                <h5 class="title">Status</h5>
                                <div class="content">
                                    <span id="status-content"><?php echo $row['status'] ?></span>
                                    <a href="tracking-status.html">Track receipt</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="date" class="item-detail">
                                <h5 class="title">Date</h5>
                                <div class="content">
                                    <span id=""><?php echo $row['donation_date'] ?></span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>
        </div>
        <?php
 }
 ?>
    </main>


</body>
<script src="../../js/back-arrow.js"></script>
<script src="../js/history-detail.js"></script>
<script src="js/receipt-history-detail.js"></script>
</html>