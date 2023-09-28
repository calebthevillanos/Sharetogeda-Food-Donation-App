<?php
session_start();
$name = $_SESSION["fullname"];
$email = $_SESSION["email"];

require "../connection.php";

if(isset($_POST['setToComplete'])){
    $donationId = $_POST['completeId'];
    if($db->exec("UPDATE donations set status='Completed' where donation_id='$donationId'")){
        ?>
                <script>
                    alert("Donation Confirmed !!!")
                    window.location.reload();
                </script>
        <?php
    }
}

$counts = [];
$count = $completed = $pending = $donors = $receivers = 0;
$n = $db->query("SELECT * from donations");
$n1 = $db->query("SELECT * from users");

// going through all 
foreach($n as $row){
    if(strtolower($row['status'])==='pending'){
        ++$pending;
    }
    if(strtolower($row['status'])==='completed'){
        ++$completed;
    }
    ++$count;
}

foreach($n1 as $row){
    if(strtolower($row['type'])==='donor'){
        $donors++;
    }else if(strtolower($row['type'])==='receiver'){
        $receivers++;
    }
}

$counts['total'] = $count;
$counts['pending'] = $pending;
$counts['completed'] = $completed;
$counts['donors'] = $donors;
$counts['receivers'] = $receivers;


//getting all reservations
$reservations = [];
$n = $db->query("select * from  reservations");
foreach($n as $r){
    $donationId = $r['donationId'];
    $n1 = $db->query("select * from donations where donation_id='$donationId'");
    foreach($n1 as $row){
        $row['reservationStatus'] = $r['status'];
        $row['userId'] = $r['userId'];
        $row['reservationId'] = $r['id'];

        array_push($reservations,$row);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/settings-flyout.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <title>Admin Panel</title>
</head>
<body>
<style>
    #modal,#modal2{
        width: 100%;
        height: 100%;
        position: absolute;
        display: none;
        justify-content: center;
        align-items: center;
        background-color: rgba(0,0,0,0.5);
        z-index: 99;
    }
   
    #submodal{
        width: 90%;
        height: 85%;
        background-color: white;
        border-radius: 10px;
    }
    #modal2 #submodal{
        height: 98%;
    }
    .modal-wrapper{
        width: 100%;
        height: 70%;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }
    .left,.right{
        width: 40%;
        height: 100%;
    }
    .donation-action{
        width: 98%;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1%;
    }
</style>
        <!-- Modal to add new Donation site -->

        <div id="modal">
            <div id="submodal">
                <button class="btn btn-danger m-2" onclick="toggleModal(false)" style="float: right;">close</button>
                <div class="modal-wrapper">
                    <div class="left">
                        <div>
                            <div class="form-group">
                                <label for="siteName">Drop off Site Name</label>
                                <input type="text" class="form-control" disabled id="siteName" name="siteName" aria-describedby="emailHelp" placeholder="Drop off site name">
                            </div>
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input type="text" class="form-control" disabled id="longitude" name="longitude" placeholder="Longitude">
                            </div>

                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input type="text" class="form-control" disabled id="latitude" name="latitude" placeholder="Latitude">
                            </div>

                            <button type="button" onclick="saveSite()" name="saveSite" class="btn btn-primary">Save Drop Off Location</button>
                        </div>
                    </div>
                    <div class="right">
                    <section id="right-side">
                        <!-- Google Map Here...  -->
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                        <p id="address-line-1" class="address"></p>
                    </section>
                    </div>
                </div>
            </div>
       </div>

        <!-- Modal to add new Donation site -->

        <div id="modal2">
            <div id="submodal">
                <b style="font-size: 22px;" class="m-4">Confirm Receivers Reservations</b>
                <button class="btn btn-danger m-2" onclick="toggleModal1(false)" style="float: right;">close</button>
                <div class="modal-wrapper">
                <table id="#modal-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                    <tr id="header">
                            <th class="center">Donation Item</th>
                            <th>Donation Quantity</th>
                            <th>Drop Off Location</th>
                            <th>Status</th>
                            <th>Upload Proof</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    <?php
                        foreach($reservations as $row){
                            $image = "";
                            $reservationId = $row['reservationId'];
                            $n = $db->query("SELECT count(*) as result, reservationId, photo from reservationProof where reservationId='$reservationId'");
                            foreach($n as $r){
                              if($r['result']>0){
                                $image = $r['photo'];
                              }
                            }
                    ?>
                            <tr class='odd'>
                            <td class='donation-id' class='center'><?= $row['foodDesc'] ?></td>
                            <td class='donation-id' class='center'><?= $row['foodQuantity'] ?></td>
                            <td class='donation-id' class='center'><?= $row['site'] ?></td>
                            <td class='donation-id' class='center'><?= $row['reservationStatus'] ?></td>
                            <td class='receiver-id'><img src="<?= "../user/receiver/receipts/".$image ?>"  alt="No photo Proof Uploaded" width="50" height="50" /></td>
                            
                            <?php
                                if(strtolower($row['reservationStatus'])=='pending'){?>
                                <td class='donation-id' class='center'>
                                    <button data-value="<?= $row['reservationId'] ?>" onclick="toggleReservation(this,'confirm')" class='btn btn-primary'>Confirm</button>
                                    
                                </td>
                               <?php } else{?>
                                <td class='donation-id' class='center' style='color: green;'>
                                    <b>Confirmed</b>
                                    <button data-value="<?= $row['reservationId'] ?>" onclick="toggleReservation(this,'decline')" class='btn btn-danger'>Cancel</button>
                                </td>
                                
                            <?php } ?>
                            </tr>

                    <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
       </div>
    <section id="left-pane">
        <h2 class="title">
            <span>Admin Panel</span>
            <span class="email" style="margin-top:2%;"><?= $email ?></span>
        </h2>
        <hr>
        <div class="action-container">
            <div class="action">
                <button id="dashboard-btn" class="action-btn active" onclick="clickHandler(event); ">Dashboard</button>
            </div>
            <div class="action">
                <button id="donation-btn" class="action-btn" onclick="clickHandler(event);setActive(0);">Manage Donations</button>
            </div>
            <div class="action">
                <button id="donor-btn" class="action-btn" onclick="clickHandler(event);setActive(1);">View Donors</button>
            </div>
            <div class="action">
                <button id="receiver-btn" class="action-btn" onclick="clickHandler(event);setActive(1);">View Receivers</button>
            </div>
        </div>
    </section>
    <section id="right-pane">
        <nav id="navbar">
            <span class="svg">
                <img src="../resources/images/menu4.png" alt="">
            </span>
            <span id="menu-toggler" class="svg">
                <img src="../resources/images/menu4.png" alt="">
            </span>
            <button id="settings-btn" class="svg">
                <img src="../resources/images/settings100.png" alt="">
            </button>
            
            <div id="settings">
                <a href="update-profile.html">Update Profile</a>
                <hr>
                <form id="signout-form" action="login.html" method="">
                    <input type="submit" value="Sign out" />
                </form>
            </div>
        </nav>

        <main>
            <div id="donation-site">
                <form method="post" action="server/addSite.php">
                    
                </form>
            </div>
            <div id="dashboard" class="content active">
                <h2>Hi <?= $name ?>, welcome back!</h2>
                <div id="info-container">
                    <div class="info" id="new">
                        <span>Pending Donations</span>
                        <div class="amount">
                            <span><?= count($counts) > 0 ? $counts['pending']:0 ?></span>
                            <i class="fa-solid fa-angles-right" title="View More"></i>
                        </div>
                    </div>
                    <div class="info" id="complete">
                        <span>Complete Donations</span>
                        <div class="amount">
                            <span><?= count($counts) > 0 ? $counts['completed']:0 ?></span>
                            <i class="fa-solid fa-angles-right" title="View More"></i>
                        </div>
                    </div>
                    <div class="info" id="total-donations">
                        <span>Total Donations</span>
                        <div class="amount">
                            <span><?= count($counts) > 0 ? $counts['total']:0 ?></span>
                            <i class="fa-solid fa-angles-right" title="View More"></i>
                        </div>
                    </div>
                    <div class="info" id="reg-donors">
                        <span>Total Reg. Donors</span>
                        <div class="amount">
                            <span><?= count($counts) > 0 ? $counts['donors']:0 ?></span>
                            <i class="fa-solid fa-angles-right" title="View More"></i>
                        </div>
                    </div>
                    <div class="info" id="reg-receivers">
                        <span>Total Reg. Receivers</span>
                        <div class="amount">
                            <span><?= count($counts) > 0 ? $counts['receivers']:0 ?></span>
                            <i class="fa-solid fa-angles-right" title="View More"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        require("server/donations.php");
        ?>
    <div id="donation-history" style="margin-bottom:25% !important;">
        <div class="donation-action">
            <h2 class="title">Donations Table</h2>
            <button class="btn btn-primary m-2" onclick="toggleModal(true)">Add Donation Site</button>
            <button class="btn btn-info m-2" onclick="toggleModal1(true)">Validate Reservations</button>
        </div>
        <table id="example" class="table table-striped table-bordered" style="width:100%; ">
        <thead>
        <tr id="header">
                <th class="center">Donor Name</th>
                <!-- <th>Items</th> -->
                <th>Donation Photo</th>
                <th>Status</th>
                <!-- <th class="center">Quantity</th> -->
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        <?php
            $n = $db->query("select * from donations");
            foreach($n as $detail)
            {
            $donationId = $detail['donation_id']; 
            $n = $db->query("select * from donationproof where donationId='$donationId'");
            $image = "";
            foreach($n as $r){
                $image = $r['photoproof'];
            }

                ?>
                 <tr class='odd'>
                <td class='donation-id' class='center'><?= $detail["donorName"] ?></td>
                <td class='receiver-id'><img src="<?= "../user/donor/server/donation_proofs/".$image ?>" width="50" height="50" /></td>
                <td class='status'><?= $detail["status"]?></td>
                <td>
                <span><?= $detail["donation_date"] ?></span>
                <div style="display:none;" class='view-detail'>
                <button style="
                background-color: dodgerblue;
                display:none;
                color: white;
                border:none;
                padding: 7px;
                border-radius: 10px" 
                >View Detail</button>
                </div>
                </td>
                <td>
                    <?= strtolower($detail['status'])=='completed' ? '<b style="color:green;">Completed</b>': '' ?>
                    <?= strlen($image)>0 && strtolower($detail['status'])=='new' ? "
                        <form method='post'>
                            <input type='text' name='completeId' value='".$detail['donation_id']."' hidden />
                            <button type='submit' name='setToComplete' class='btn btn-primary'>Confirm<button>
                        </form>
                    ": ''?>
                    <?= strlen($image)<=0 && strtolower($detail['status'])=='new' ? "<b style='color:red;'>Incomplete</b>": ''  ?>
                </td>
                 </tr>
            <?php }        
        ?>
        </tbody>
        </table>
</div>
        
            <div id="donations" class="content table-container" style="display:none;">
                <div id="donation-history" class="table-item active">
                    <div class="top-info">
                        <h2>Donationfffs Table</h2>
                        <span class="back-arrow not-active">
                            <i class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tr id="header">
                            <th class="center">Donor ID</th>
                            <!-- <th>Items</th> -->
                            <th>Receiver ID</th>
                            <th>Status</th>
                            <!-- <th class="center">Quantity</th> -->
                            <th>Date</th>

                        </tr>
                        
                    </table>
                </div>
            </div>
                <div id="history-detail" class="table-item">
                    <div class="top-info">
                        <h2>Donation Detail</h2>
                        <span  class="back-arrow">
                            <i onclick="location.reload();" class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <div id="info-container">
                        <div id="donor" class="category">
                            <span class="title">Donor Info</span>
                            <div id="donor-id" class="info">
                                <h4>Donor ID</h4>
                                <span id="user-donor-id" class="user-donor-id">1000001 - Click for more info</span>
                            </div>
                            <div id="donor-name" class="info">
                                <h4>Name</h4>
                                <span id="user-donor-name">John Doe</span>
                            </div>
                        </div>
                        <div id="receiver" class="category">
                            <span class="title">Receiver Info</span>
                            <div id="receiver-id" class="info">
                                <h4>Receiver ID</h4>
                                <span id="user-receiver-id" class="user-receiver-id">292 - Click for more info</span>
                            </div>
                            <div id="receiver-name" class="info">
                                <h4>Name</h4>
                                <span id="user-receiver-name">Mary Ann</span>
                            </div>
                        </div>
                        <hr>
                        <div id="items" class="category">
                            <span class="title">Items</span>
                            <div id="items" class="info">
                                <h4>Items</h4>
                                <span id="items-details">Cornflakes, Milk, Spaghetti</span>
                            </div>
                            <div id="quantity" class="info">
                                <h4>Quantity</h4>
                                <span id="items-quantity">1, 3, 4</span>
                            </div>
                            <div id="status" class="info">
                                <h4>Status</h4>
                                <span id="item-status">Pending</span>
                                <div class="track-status">
                                    <form method="post" action="server/checkImage.php">
                                    <button name="track" type="submit">Track Status</button>
                                    </form>
                                </div>
                            </div>
                            <div id="date" class="info">
                                <h4>Date</h4>
                                <span id="donation-date">2023-10-23 11:30</span>
                            </div>
                        </div>
                    </div>
                <div id="track-status" class="table-item">
                    <div class="top-info">
                        <h2>Tracking Details</h2>
                        <span class="back-arrow">
                            <i class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <div class="step-container">
                        <div id="step-one" class="step">
                            <span>Donation Placed</span>
                            <div class="status complete">
                                <span>Completed</span>
                                <i class="fa-regular fa-circle-check"></i>
                                <div class="change-status">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-two" class="step">
                            <span>Donation Picked Up</span>
                            <div class="status">
                                <span>On Progress</span>
                                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                <div class="change-status active">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-three" class="step">
                            <span>Donation Arrived at Office</span>
                            <div class="status">
                                <span>On Progress</span>
                                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                <div class="change-status active">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-four" class="step">
                            <span>Donation Quality Checked</span>
                            <div class="status">
                                <span>On Progress</span>
                                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                <div class="change-status active">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-five" class="step">
                            <span>Donation Shipped to Destination</span>
                            <div class="status">
                                <span>On Progress</span>
                                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                <div class="change-status active">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div id="step-six" class="step">
                            <span>Donation Processed at Destination</span>
                            <div class="status">
                                <span>On Progress</span>
                                <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                                <div class="change-status active">
                                    <button onclick="markComplete(event)">
                                        <i class="fa-solid fa-check" title="Mark Complete"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="extra-information">
                        <span>Documentation</span>
                        <div class="gallery">
                            <span id="no-documentation">Process isn't complete, hence no documentation.</span>
                            <!-- IMAGES TO BE SHOWN WHEN PROCESS IS COMPLETED SHOULD BE PLACED HERE. -->
                            <!-- <img src="../../resources/images/uploaded-images/1.jpg" alt="">
                            <img src="../../resources/images/uploaded-images/2.jpg" alt="">
                            <img src="../../resources/images/uploaded-images/3.jpg" alt=""> -->
                        </div>
                    </div>
                    <div class="upload-images">
                        <span class="upload-span">Upload Completion Images</span>
                        <form action="" method="POST">
                            <input type="file" multiple name="upload-image" id="upload-image">
                            <button type="submit">Upload</button>
                        </form>
                    </div>
                    <div id="track-location-div">
                        <button class="track-location">Track Location</button>
                    </div>
                </div>
                <div id="track-location" class="table-item">
                    <div class="top-info">
                        <h2>Track Location</h2>
                        <span class="back-arrow">
                            <i class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <div id="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14969.891201196193!2d57.395299!3d-20.280688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c5c9f4d1c80b5%3A0x9088d2393f5f29c8!2sMiddlesex%20University%20Mauritius!5e0!3m2!1sen!2sng!4v1681429257338!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
            
                    <div id="legend-container">
                        <h3 class="legend-title">Legends</h3>
                        <div id="legends">
                            <div id="shipping-destination" class="legend">
                                <img src="../resources/images/green-dot.png" alt="">
                                <span class="content">Shipping Destination</span>
                            </div>
                            <div id="shipping-origin" class="legend">
                                <img src="../resources/images/blue-dot.png" alt="">
                                <span class="content">Shipping Origin</span>
                            </div>
                            <div id="shipping-vehicle" class="legend">
                                <img src="../resources/images/truck.png" alt="">
                                <span id="vehicle-content" class="content">Shipping Vehicle</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php 
            require_once("server/checkImage.php");
            ?>
            <div id="donors" class="content table-container" style="background-color:white;">
                <div id="donor-table" class="table-item active">
                    <div class="top-info">
                        <h2>Donors Table</h2>
                        <span class="back-arrow not-active">
                            <i class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    
                    <table id="example2" class="table table-striped table-bordered table-responsive" style="width:100%">
        <thead>
        <tr id="header">
                <th class="center">Donor ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date Joined</th>
            </tr>
        </thead>
        <tbody>
            <?php
               $n = $db->query("select * from donations");
              foreach($n as $donors) { 
                $email = $donors['donorEmail'];
                $n1 = $db->query("select * from users where email='$email'");
                foreach($n1 as $r){
                    $donors['joinedDate'] = $r['joinedDate'];
                }
                ?>
                            <tr class="odd">
                                <td class="donor-id"><?= $donors['donation_id'] ?></td>
                                <td class="donor-name"><?= $donors['donorName'] ?></td>
                                <td class="email"><?= $donors['donorEmail'] ?></td>
                                <td>
                                    <span class="date-joined"><?= date("F jS, Y", strtotime($donors['joinedDate'])) ?></span>
                                    <!-- -->
                                    <button style="
                                    background-color: dodgerblue;
                                    color: white;
                                    border:none;
                                    padding: 7px;
                                    display:none;
                                    border-radius: 10px">View Detail</button>
                                </td>
                            </tr>
             <?php } ?>
        </tbody>
        </table>
         </div>
              </div>
                <div id="donor-detail" class="table-item" style="background-color: white;">
                    <div class="top-info">
                        <h2>Donor Detail</h2>
                        <span class="back-arrow">
                            <i onclick="location.reload();" class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <div class="info-container">
                        <form action="POST">
                            <div class="entry">
                                <label for="donor-id-input">ID</label>
                                <input id="donor-id-input" disabled type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="donor-name-input">Name</label>
                                <input id="donor-name-input" disabled type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="donor-email-input">Email</label>
                                <input id="donor-email-input" disabled  type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="donor-phone-input">Phone Number</label>
                                <input id="donor-phone-input" disabled type="text" value="+230 5 123 4567">
                            </div>
                            <div class="entry">
                                <label for="donor-address-input">Address</label>
                                <input id="donor-address-input" disabled type="text" value="3 Koboo Close, Off Saint Laurel Road, New York, America">
                            </div>
                            <div class="entry">
                                <label for="donor-date-joined-input">Date Joined</label>
                                <input id="donor-date-joined-input" disabled type="text" value="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php
              require_once("server/receiver.php");
            ?>
            <div id="receivers" class="content table-container">
                <div id="receiver-table" class="table-item active">
                    <div class="top-info">
                        <h2>Receivers Table</h2>
                        <span class="back-arrow not-active">
                            <i class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <table id="example3" class="table table-striped table-bordered table-responsive" style="width:100%" cellspacing="0">
                        <thead>
                            <tr id="header">
                                <th>Receiver ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Date Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
                             $receiverDetails = array();
                             for($i=0;$i<count($receiversName);$i++)
                              {
                             $receiverDetails["donorId"] = $receiversId[$i];
                             $receiverDetails["donorTel"] = $receiversTel[$i];
                             $receiverDetails["donorAddress"] = $receiversAddress[$i];
                             $receiverDetails["donorName"] = $receiversName[$i];
                             $receiverDetails["donorEmail"] = $receiversEmail[$i];
                             $receiverDetails["date"] = $receiversdates[$i];
                             $receiverDetailString = implode("#", $receiverDetails);
                           ?>
                            <tr class="even">
                                <td class="receiver-id"><?= $receiversId[$i] ?></td>
                                <td class="receiver-name"><?= $receiversName[$i] ?></td>
                                <td class="email"><?= $receiversEmail[$i] ?></td>
                                <td>
                                    <span class="date-joined"><?= $receiversdates[$i] ?></span>
                                    <button
                                    style="
                background-color: dodgerblue;
                color: white;
                border:none;
                padding: 7px;
                border-radius: 10px"
                                    data-value="<?= $receiverDetailString ?>" onclick="viewReceiverDetails(this)">View Detail</button>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                </div>
                <div id="receiver-detail" class="table-item">
                    <div class="top-info">
                        <h2>Receiver Detail</h2>
                        <span class="back-arrow">
                            <i onclick="location.reload();" class="fa-regular fa-circle-left"></i>
                        </span>
                    </div>
                    <div class="info-container">
                        <form action="POST">
                            <div class="entry">
                                <label for="receiver-id-input">ID</label>
                                <input id="receiver-id-input" disabled type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="receiver-name-input">Name</label>
                                <input id="receiver-name-input" disabled type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="receiver-email-input">Email</label>
                                <input id="receiver-email-input" disabled  type="text" value="">
                            </div>
                            <div class="entry">
                                <label for="receiver-phone-input">Phone Number</label>
                                <input id="receiver-phone-input" disabled type="text" value="+230 5 123 4567">
                            </div>
                            <div class="entry">
                                <label for="receiver-address-input">Address</label>
                                <input id="receiver-address-input" disabled type="text" value="3 Koboo Close, Off Saint Laurel Road, New York, America">
                            </div>
                            <div class="entry">
                                <label for="receiver-date-joined-input">Date Joined</label>
                                <input disabled id="receiver-date-joined-input" type="text" value="">
                            </div>
                        </form>
                    </div>
                    </div>
        </main>
        
        
    </section>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    window.onload = () => {
        document.getElementById("address-line-1").innerHTML = `<b>Longitude: </b>${sessionStorage.getItem("longitude")} <b>Latitude: </b>${sessionStorage.getItem("latitude")}`
    }
function myMap() {
    var latitude = parseFloat(sessionStorage.getItem("latitude"))
    var longitude = parseFloat(sessionStorage.getItem("longitude"))
    var marker = new google.maps.Marker({
    position: {latitude, longitude},
    animation:google.maps.Animation.BOUNCE
});
var mapProp= {
  center:new google.maps.LatLng(latitude? latitude : -20.2667, longitude? longitude : 57.3667),
  zoom:7,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
const myLatlng = { lat: latitude, lng: longitude };
 // Create the initial InfoWindow.
 let infoWindow = new google.maps.InfoWindow({
    content: "Click to save drop off location",
    position: myLatlng,
  });

  infoWindow.open(map);
  // Configure the click listener.
  map.addListener("click", (mapsMouseEvent) => {

    const pos = mapsMouseEvent.latLng.toJSON()
    console.log("Click position: ",pos)
    getMapInfoLatLong(pos?.lng,pos?.lat)
    // Close the current InfoWindow.
    infoWindow.close();
    // Create a new InfoWindow.
    infoWindow = new google.maps.InfoWindow({
      position: mapsMouseEvent.latLng,
    });
    infoWindow.setContent(
      JSON.stringify(mapsMouseEvent.latLng.toJSON(), null, 2)
    );
    infoWindow.open(map);
  });

marker.setMap(map);
}

window.initMap = myMap;


function getMapInfoLatLong(longitude,latitude){
    const API_KEY = "AIzaSyD972QQNhdx7-VQS75dl1pLnZyfSOrnyMY"
    const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${latitude},${longitude}&key=${API_KEY}`
    fetch(url)
    .then(res => res.json())
    .then(data => {
        console.log("Geo Data: ",data)
        if(data.hasOwnProperty('plus_code')){
            let address = data.plus_code?.compound_code.split(" ")
            delete address[0];
            let obj = {}
            obj['name'] = address.join(" ")
            obj["longitude"] = longitude;
            obj["latitude"] = latitude;

            console.log("Composed Data: ",obj)
            fillFormWithMapData(obj)
        }
    })
    .catch(err => console.log("Geocoding error: ",err))
}

function fillFormWithMapData(obj){
    document.getElementById('siteName').value = obj?.name
    document.getElementById('longitude').value = obj?.longitude
    document.getElementById('latitude').value = obj?.latitude

    sessionStorage.setItem("siteInfo",JSON.stringify(obj))
}

function saveSite(){
    const obj = JSON.parse(sessionStorage.getItem("siteInfo"))
    fetch(`./ajax.php?q=saveSite&siteName=${obj.name}&longitude=${ obj?.longitude}&latitude=${obj?.latitude}`)
    .then(res => res.json())
    .then(data => {
        if(data.value=="1"){
            alert("Drop Off Site Save Successfully !!!")
            document.getElementById('siteName').value = ""
            document.getElementById('longitude').value = ""
            document.getElementById('latitude').value = ""
        }
    })
    .catch(err=> console.log(err))
}

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD972QQNhdx7-VQS75dl1pLnZyfSOrnyMY&callback=myMap"></script>



<script>
$(document).ready(function () {
$('#example').DataTable();
});
$(document).ready(function () {
$('#example2').DataTable();
});
$(document).ready(function () {
$('#example3').DataTable();
});
$(document).ready(function () {
$('#modal-table').DataTable();
});


function toggleModal(action){
    if(!action){
        document.getElementById("modal").style.display="none";
    }else{
        document.getElementById("modal").style.display="flex";
    }
}

function toggleModal1(action){
    if(!action){
        document.getElementById("modal2").style.display="none";
    }else{
        document.getElementById("modal2").style.display="flex";
    }
}

//functon
function toggleReservation(e,action){
  let id = e.getAttribute('data-value');
  let url = ''
  if(action=='confirm'){
   url = `./ajax.php?q=confirm&id=${id}`
  }else{
    url = `./ajax.php?q=cancel&id=${id}`
  }
  fetch(url)
  .then(res => res.json())
  .then(data => {
    console.log(data)
    if(data.ok){
      alert('Action Executed Successfully !!!');
      window.location.reload();
    }
  })
  .catch(err => console.log(err))
}

function viewDonorDetails(e)
{
    document.getElementById("donors").style.display="none";
    document.getElementById("donor-detail").style.display = "initial";
    var donorValues = e.getAttribute("data-value").split("#");
  document.getElementById("donor-name-input").value = donorValues[3]
  document.getElementById("donor-email-input").value = donorValues[4]
  document.getElementById("donor-id-input").value = donorValues[0]
  document.getElementById("donor-phone-input").value = donorValues[1]
  document.getElementById("donor-address-input").value = donorValues[2]
  document.getElementById("donor-date-joined-input").value = donorValues[5]
  console.log(donorValues)
}
function viewReceiverDetails(e)
{
    document.getElementById("receivers").style.display="none";
    document.getElementById("receiver-detail").style.display = "initial";
    var receiverValues = e.getAttribute("data-value").split("#");
  document.getElementById("receiver-name-input").value = receiverValues[3]
  document.getElementById("receiver-email-input").value = receiverValues[4]
  document.getElementById("receiver-id-input").value = receiverValues[0]
  document.getElementById("receiver-phone-input").value = receiverValues[1]
  document.getElementById("receiver-address-input").value = receiverValues[2]
  document.getElementById("receiver-date-joined-input").value = receiverValues[5]
}

function setActive(num)
{
    if(num==1)
    document.getElementById("donation-history").style.display="none"
    if(num==0)
    document.getElementById("donation-history").style.display="initial"
    document.getElementById("history-detail").style.display = "none";
}
function viewdetails(e)
{
    var dataValues = e.getAttribute("data-value").split("#");
    if(dataValues[7] === null)
    document.getElementById("receiver-id").style.display="none" //4
    else
    document.getElementById("user-receiver-id").style.display=dataValues[7] //4

    document.getElementById("donation-history").style.display="none";
    document.getElementById("history-detail").style.display = "block";
    document.getElementById("history-detail").style.backgroundColor = "white"
    document.getElementById("user-donor-id").innerHTML =dataValues[0]
    document.getElementById("user-donor-name").innerHTML =dataValues[1]
    document.getElementById("user-receiver-name").innerHTML =dataValues[3] //3
    document.getElementById("items-details").innerHTML =dataValues[5]
    document.getElementById("items-quantity").innerHTML =dataValues[2] //2
    document.getElementById("item-status").innerHTML =dataValues[4] //7
    document.getElementById("donation-date").innerHTML =dataValues[6] //6

}
</script>
<script src="../js/settings-flyout.js"></script>
<script src="js/index.js"></script>
<script src="js/custom-back-arrow.js"></script>
</html>