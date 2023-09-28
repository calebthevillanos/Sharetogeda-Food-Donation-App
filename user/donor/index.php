<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/settings-flyout.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Dashboard</title>
</head>
<body>
    <section id="left-pane">
        <div id="user" >
          <div style="background-color: hsl(258.13deg 47.52% 60.39%); border-radius: 50%; width: 120px; height:120px; display: flex;
           align-items: center; justify-content: center;
          ">
          <span style="text-align: center; font-size:50px; text-transform: uppercase"><b>
            <?php
            echo $_SESSION["fullname"][0];
            ?>
          </b></span>
        </div>    
        <span>
            Donor: 
            <?php
            echo $_SESSION["fullname"];
            ?></span>
        </div>
        <div id="features">
            <a href="dashboard.php" class="feature active">Dashboard</a>
            <a href="make-donation.php" class="feature">Make Donation</a>
            <a href="donation-history.php" class="feature">Donation History</a>
        </div>
    </section>
    <section id="right-pane">
        <nav id="navbar">
            <span class="svg">
                <img src="../../resources/images/menu4.png" alt="">
            </span>
            <span id="menu-toggler" class="svg">
                <img src="../../resources/images/menu4.png" alt="">
            </span>
            <button id="settings-btn" class="svg">
                <img src="../../resources/images/settings100.png" alt="">
            </button>
            
            <div id="settings">
                <a href="update-profile.php">Update Profile</a>
                <hr>
                <form id="signout-form" action="login.php" method="">
                    <input type="submit" value="Sign out" />
                </form>
            </div>
        </nav>
        <main>
            <iframe id="frame" src="dashboard.php" frameborder="0"></iframe>
            <div id="overlay"></div>
        </main>
    </section>
</body>
<script>
    window.onload = () => {
       
    }
</script>
<script src="../../js/settings-flyout.js"></script>
<script src="../js/index.js"></script>
</html>