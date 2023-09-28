<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/tracking-status.css">
    <title>Tracking Details</title>
</head>
<body>
    <main>
       <!-- <div class="top-info">
            <span id="back-arrow">
                <i class="fa-regular fa-circle-left"></i>
            </span>
            <h1>Tracking Details</h1>
        </div>
        <div class="step-container">
            <div id="step-one" class="step">
                <span>Donation Placed</span>
                <div class="status complete">
                    <span>Completed</span>
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
            <div id="step-two" class="step">
                <span>Donation Picked Up</span>
                <div class="status complete">
                    <span>Completed</span>
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
            <div id="step-three" class="step">
                <span>Donation Arrived at Office</span>
                <div class="status complete">
                    <span>Completed</span>
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
            <div id="step-four" class="step">
                <span>Donation Quality Checked</span>
                <div class="status complete">
                    <span>Completed</span>
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
            <div id="step-five" class="step">
                <span>Donation Shipped to Destination</span>
                <div class="status complete">
                    <span>Completed</span>
                    <i class="fa-regular fa-circle-check"></i>
                </div>
            </div>
            <div id="step-six" class="step">
                <span>Donation Processed at Destination</span>
                <div class="status">
                    <span>On Progress</span>
                    <i class="fa-solid fa-spinner fa-spin-pulse"></i>
                </div>
            </div>
        </div> -->
        
        <div class="extra-information">
        <span id="no-documentation">Upload Photo Evidence of Successful Donation</span>  
        <form method="POST" action="server/proof.php" enctype="multipart/form-data">
                <input name="proof" type="file" accept="Image/*" required>
                <button name="upload" type="submit">Upload</button>
    </form>
        </div>
        <div id="track-location">
            <a href="track-location.php">Track Location</a>
        </div>
    </main>
</body>
<script src="../../js/back-arrow.js"></script>
<script src="../js/tracking-status.js"></script>
</html>