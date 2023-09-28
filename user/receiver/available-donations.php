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

if(isset($_POST['saveReceipt'])){
  $userId = $_SESSION['userId'];
  $reservationId = $_POST['reservationId'];
  $filename = $_FILES["proof"]["name"];
  $uploadedName = generateRandomString(10)." ".$filename;
  $file_temp = $_FILES["proof"]["tmp_name"];
  move_uploaded_file($file_temp, "receipts/".$uploadedName);

  if($db->exec("INSERT INTO reservationProof(photo,reservationId,userId) values ('$uploadedName','$reservationId','$userId')")){
    ?>
    <script>
      alert("Receipt Uploaded Successfully !!!")
    </script>
    <?php
  }

}

$donations = [];
$n = $db->query("select * from donations where status='Completed'");
foreach($n as $row){
  $donationId = $row['donation_id'];
  $n1 = $db->query("select count(*) as result,donationId,id,status from reservations where donationId='$donationId'");
  foreach($n1 as $r){
    $reservationStatus = '';
    $reservationId = $r['id'];

    if($r['result']>0 && strtolower($r['status'])!=='reserved'){
      $reservationStatus = 'pending';
    }
    else if($r['result']>0 && strtolower($r['status'])=='reserved'){
      $reservationStatus = 'reserved';
    }
    else if($r['result']<=0){
      $reservationStatus = 'new';
    }


    $row["reservationStatus"] = $reservationStatus;
    $row["reservationId"] = $reservationId;
  }

  array_push($donations,$row);
 
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css" />
    <title>Available Donations</title>
</head>
<body>
    <div style="padding:40px">
        <h2 class="title">Available Donations</h2>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>    
        <tr id="header">
                <th class="center">Donation Item</th>
                <th>Quantity</th>
                <th>Pick up Location</th>
                <th>Receipt</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
</thead>
   <tbody>
      <?php 
      foreach($donations as $row)
      {
        $image = "";
        $reservationId = $row['reservationId'];
        $n = $db->query("SELECT count(*) as result, reservationId, photo from reservationProof where reservationId='$reservationId'");
        foreach($n as $r){
          if($r['result']>0){
            $image = $r['photo'];
          }
        }
        
      ?>
            <tr class="even">
                <td id="donation-id" class="donation-id" class="center"><?= $row['foodDesc']; ?></td>
                <td id="donorname" class="receiver-id"><?= $row["foodQuantity"]; ?></td>
                <td id="pickup-location" class="pickup-location"><?= $row["site"]; ?></td>
                <td class='receiver-id'><img src="<?= "./receipts/".$image ?>"  alt="Upload Receipt Proof" width="50" height="50" /></td>
                <td id="status" class="status"><?= $row["reservationStatus"]; ?></td>
                <!-- <td class="center">1</td> -->
                <td>
                
                    <?php
                     if(strtolower($row["reservationStatus"])=="new"){
                    ?>
                    <button 
                    id="reserve"
                    name="reserve" 
                    style="border:none; border-radius: 10px;
                     padding:12px; background-color: dodgerblue;
                     color:white;
                    "
                     data-value="<?= $row['donation_id'] ?>"
                     type="button"
                     onclick="reserve(this,'reserve')"
                    >Reserve</button>
                    <?php } else if(strtolower($row["reservationStatus"])=="pending") { ?>
                    <button  
                    id="cancel"
                    name="cancel"
                    onclick="reserve(this,'cancel')"
                    data-value="<?= $row['reservationId'] ?>"
                    style="border:none; border-radius: 10px;
                     padding:12px; background-color: red;
                     color:white;
                    ">Cancel</button>

                    <?php if(strlen($image)<=0){ ?>
                    <form method="post" enctype="multipart/form-data" class="mt-2" action="" style="display: flex;justify-content: space-evenly;flex-direction:row;">
                        <input type="file" name="proof" id="fileToUpload">
                        <input type="text" name="reservationId" hidden value="<?= $row['reservationId'] ?>" />
                        <button type="submit" name="saveReceipt" style="border:none; border-radius: 10px;
                          padding:12px; background-color: #007bff;
                          color:white;
                          ">Upload</button>
                    </form>

                    <?php } ?>
                    <?php } else{?>
                        <b style="color: green;">Reserved</b>
                      <?php } ?>
               </td>
            </tr>
            <?php }?>
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
$(document).ready(function () {
$('#example2').DataTable();
});
var rad = function(x) {
  return x * Math.PI / 180;
};

window.onload = () => {
    fetch("./server/receiverDonate.php?q=donations")
    .then(res => res.json())
    .then((data) => {
              
    }
    )
    .catch(error => console.log(error))
    }

function saveDetails(e)
{
    document.getElementById("reserve").style.display="none";
      document.getElementById("cancel").style.display="block";
}

var getDistance = function(p1, p2) {
  var R = 6378137;
  var dLat = rad(p2 - p1);
  var dLong = rad(p2 - p1);
  var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
    Math.cos(rad(p1)) * Math.cos(rad(p2)) *
    Math.sin(dLong / 2) * Math.sin(dLong / 2);
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  var d = R * c;
  return d;
}


//function to execute action on donation (reserve/cancel donation)
function reserve(e,action){
  let id = e.getAttribute('data-value');
  let url = ''
  if(action=='reserve'){
   url = `./ajax.php?q=reserve&id=${id}`
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

</script>
<script src="js/available-donations.js"></script>
</html>