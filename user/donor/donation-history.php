<?php
session_start();
require '../../connection.php';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
  }

//upload photo proof
if(isset($_POST['uploadProof'])){
  $donationId = $_POST['donationId'];
  $filename = $_FILES["proof"]["name"];
  $name = $_SESSION['fullname'];
  $uploadedName = generateRandomString(10)." ".$filename;
  $file_temp = $_FILES["proof"]["tmp_name"];
  move_uploaded_file($file_temp, "./server/donation_proofs/".$uploadedName);

  if($db->exec("INSERT INTO donationproof(senderName,photoproof,donationId) values ('$name','$uploadedName','$donationId')")){
    ?>
    <script>
      alert("Receipt Uploaded Successfully !!!")
    </script>
    <?php
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <!-- <link rel="stylesheet" href="../css/history-detail.css"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />

    
    <title>Donation History</title>
    <style>
        table {
            border: none;
            width: 80%;
            align-self: center;
            background-color: white;
        }
        td {
            padding: 15px;
            text-align: center;
        }
        th {
            padding: 15px;
            border-bottom: 5px solid black;
        }
        #donation-history {
            padding: 40px;
        }
        #donation-detail {
            display: none
        }
        #donation-history h2 {
            margin-bottom: 2%;
            padding: 40px;
        }
        .view-detail button {
            color: white;
            padding: 12px;
            border: none;
            cursor: pointer;
            font-weight: 800;
            letter-spacing: 0.02rem;
            background-color: #3C59F4;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<div id="donation-detail">
    <main>
<div class="top-info">
            <span id="back-arrow">
                <i class="fa-regular fa-circle-left"></i>
            </span>
            <h1>Donation Detail</h1>
</div>

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
                            <span>ID: <span id="donor-id">1000</span></span>
                            <hr>
                            <span>Name: <span id="donor-name"><?= $_SESSION["fullname"] ?></span></span>
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
                            <span>Name: <span id="receiver-name">Mary Ann</span></span>
                        </div>
                    </div>
                </div>
            </section>
            <section id="right-side">
                <div id="item-info-container" class="info-container">
                    <h2 id="item-info" class="info">Item Info</h2>
                    <ul class="detail-list">
                        <li>
                            <div id="items" class="item-detail">
                                <div class="title">
                                    <h5 class="">Food Description</h5>
                                </div>
                                <div class="content">
                                    <span id="foodName">Cornflakes, Milk, Spaghetti</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="status" class="item-detail">
                                <h5 class="title">Status</h5>
                                <div class="content">
                                    <span id="status-content">Pending</span>
                                    <a href="tracking-status.php">View Status</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div id="date" class="item-detail">
                                <h5 class="title">Expiry Date</h5>
                                <div class="content">
                                    <span id="expiryDate">2023-10-23 11:30</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <span id="no-documentation">Upload Photo Evidence of Successful Donation</span>
                <form method="POST" action="server/proof.php" enctype="multipart/form-data">
                <input name="proof" type="file" accept="Image/*" required>
                <button name="upload" type="submit">Upload</button>
            </form>
            </section>
        </div>
    </main>
    </div>
<?php
        require("server/donation_history.nc.php");
        ?>
        <div id="donation-history" style="padding:40px">
        <h2 class="title">Donation History</h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>    
        <tr id="header">        <tr id="header">
                <th class="center">Donation Item</th>
                <th class="center">Quantity</th>
                <th>Drop Location</th>
                <th>Photo Proof</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
            
            $email = $_SESSION['email'];
            $n = $db->query("select * from donations where donorEmail='$email'");
            foreach($n as $donation)
            { 
             $donationId = $donation["donation_id"];
            
             $n = $db->query("select * from donationproof where donationId='$donationId'");
             $imgCount = 0;
             $img = "";
             $site = "";
             foreach($n as $r){
                
                    $imgCount++;
                    $img = $r["photoproof"];
                
             }

             $n = $db->query("select * from donations where donation_id='$donationId'");
             foreach($n as $r){
                $site = $r['site'];
             }

             if(strlen($img)<=0 && strtolower($donation['status'])=='new'){
                $donation['newStatus'] = $donation['status'];
             }else if(strlen($img)>0 && strtolower($donation['status'])=='new'){
                $donation['newStatus'] = 'Pending';
             }else if(strtolower($donation['status'])=='completed'){
                $donation['newStatus'] = $donation['status'];
             }

                ?>
                 <tr class='odd'>
                <td class='donation-id' class='center'><?= $donation["foodDesc"] ?></td>
                <td class='donation-id' class='center'><?= $donation["foodQuantity"] ?></td>
                <td class='receiver-id'><?= $site ?></td>
                <td class='receiver-id'>
                 <img src="<?= "../donor/server/donation_proofs/".$img; ?>" alt="no proof uploaded" width="50" height="50"/>
                </td>
                <td class='status'>
                    <?= $donation["newStatus"] ?>
                </td>
                <td>
                <span><?=  date("F jS, Y", strtotime($donation["donation_date"])) ?></span>
                <form action="" method="post" enctype="multipart/form-data" class="mt-2" action="" style="display: flex;justify-content: space-evenly;flex-direction:row;">
                    <input 
                    style="display: <?= strlen($img)>0 ? 'none':'flex' ?>;"
                    type="file" name="proof" id="fileToUpload">
                    <button
                    type="submit"
                    name="uploadProof"
                    style=" 
                    background-color: dodgerblue;
                    color: white;
                    border:none;
                    padding: 7px;
                    display: <?= strlen($img)>0 ? 'none':'flex' ?>;
                    border-radius: 10px;"
                    >Upload</button> 
                   <input type="text" hidden name="donationId" value="<?= $donation["donation_id"] ?>">
                </form>
                </td>
                 </tr>
            <?php }        
        ?>
        </tbody>
    </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function () {
$('#example').DataTable();
});
    
        </script>
<script src="DataTables/datatables.min.js"></script>
<script src="../../js/back-arrow.js"></script>
<script src="../js/history-detail.js"></script>
<script src="js/donation-history-detail.js"></script>
<!-- <script src="../js/history.js"></script>
<script src="js/donation-history.js"></script> -->
</html>