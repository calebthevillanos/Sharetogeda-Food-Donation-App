<?php
session_start();

$email = $_SESSION['email'];
$userId = $_SESSION['userId'];

require '../../connection.php';
require '../../functions.php';

$n = $db->query("SELECT * FROM users where id='$userId'");
$n1 = $db->query("SELECT * FROM reservations where userId='$userId'");
$user = [];
$pending = $completed = 0;

foreach($n as $row){
    $user=$row;
}

foreach($n1 as $row){
    if(strtolower($row['status'])=='pending'){
        ++$pending;
    }
    if(strtolower($row['status'])=='reserved'){
        ++$completed;
    }
}

//updating usrs info
if(isset($_POST['updateForm1'])){

    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];

    if($db->exec("UPDATE users set email='$email',fullname='$fullname',address='$address' where id='$userId' ")){
        $n = $db->query("SELECT * FROM users where id='$userId'");
        foreach($n as $row){
            $user=$row;
        }

        $_SESSION['fullname'] = $user['fullname'];
        $_SESSION['email']  = $user['email'];
        $_SESSION['tel']  = $user['tel'];
        $_SESSION['type']  = $user['type'];
        $_SESSION['longitude']  = $user['longitude'];
        $_SESSION['latitude']  = $user['latitude'];
        $_SESSION['userId']  = $user['id'];
    
    ?>

        <script>
            alert("Account Information Updated Successfully !!!");
        </script>

  <?php 
  }


  //function to update password
  if(isset($_POST['updatePassword'])){
    die("Hello");
    $oldPassword = $_POST['old-password'];
    $newPassword = $_POST['new-password'];
    $retypePassword = $_POST['retype-password'];

    if(!isPasswordValid($newPassword)){
        echo "<script>alert('Password should be Min 8 characters, contain atleast One upperase and atleast One Lowercase')</script>";
    }

    if($newPassword!=$retypePassword){
        echo "<script>alert('New Password Must be same as Re-type password')</script>";
    }
    
    if(password_verify($oldPassword,$user['password'])){
        $password = password_hash($newPassword,PASSWORD_DEFAULT);
        if($db->exec("UPDATE users set password='$password' where id='$userId' ")){
            echo "<script>alert('Password Updated Successfully !!!')</script>";
        }
    }else{
        echo "<script>alert('Sorry invalid current password !!!')</script>";
        exit();
    }

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
    <link rel="stylesheet" href="../css/update-profile.css">
    <title>Update Profile For Receiver</title>
</head>
<body>
    <header>
        <nav id="navbar">
            <div id="logo">
                <img src="../../resources/images/logo-cropped.jpg" alt="">
            </div>
        </nav>
    </header>

    <main>
        <section id="top-info">
            <div id="user-logo">
                <!-- Comment the i tag or the span to either use the initial of the user's name or the user icon respectively -->
                <!-- <i class="fa-solid fa-user"></i> -->
                <span id="initial"></span>
            </div>
            <div id="user-info">
                <div id="top-user-info">
                    <h1 id="name"><?= $_SESSION['fullname'] ?></h1>
                    <div id="time-joined">
                        <i class="fa-regular fa-calendar-minus"></i>
                        <span><?= date("F jS, Y", strtotime($user['joinedDate'])) ?></span>
                    </div>
                </div>
                <div id="bottom-user-info">
                    <div class="info-container">
                        <div class="top-donation">    
                            <span id="pending-donations"><?= $pending ?></span>
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <span>PENDING RECEIVALS</span>
                    </div>
                    <div class="info-container">
                        <div class="top-donation">    
                            <span id="successful-donations"><?= $completed ?></span>
                            <i class="fa-solid fa-pizza-slice"></i>
                        </div>
                        <span>SUCCESSFUL RECEIVALS</span>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="change-info">
            <form action="" id="update-form" class="form" method="POST">
                <div class="form-head">
                    <h3>UPDATE PROFILE</h3>
                    <span>Edit your account info here.</span>
                </div>
                <div class="form-body">
                    <div id="email-entry" class="entry">
                        <label for="">Email</label>
                        <input type="text" name="email" value="<?= $user['email'] ?>" id="email-input" />
                        <button id="email-btn" class="btn">Change email</button>
                    </div>
                    <div id="password-entry" class="entry">
                        <label for="">Change password</label>
                        <button id="password-btn" class="btn">Change password</button>
                    </div>
                    <div id="fullname-entry" class="entry">
                        <label for="fullname-input">Fullname</label>
                        <input type="text" value="<?= $user['fullname'] ?>" name="fullname" id="fullname-input" />
                    </div>
                    <div id="address-entry" class="entry">
                        <label for="address-input">Address</label>
                        <input type="text" value="<?= $user['address'] ?>" name="address" id="address-input" />
                    </div>
                    <div class="submit-container">
                        <input class="btn" name="updateForm1" type="submit" value="Save Changes">
                    </div>
                </div>
            </form>

            <form action="" id="password-form" class="form" method="POST">
                <div class="form-head">
                    <h3>CHANGE PASSWORD</h3>
                    <span>Change your password here.</span>
                </div>
                <div class="form-body">
                    <div id="old-password-entry" class="entry">
                        <label for="old-password-input">Old Password</label>
                        <input required type="password" name="old-password" id="old-password-input" class="password" />
                        <i id="" class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <div id="new-password-entry" class="entry">
                        <label for="new-password-input">New Password</label>
                        <input required type="password" name="new-password" id="new-password-input" class="password" />
                        <i class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <div id="retype-password-entry" class="entry">
                        <label for="retype-password-input">Retype Password</label>
                        <input required type="password" name="retype-password" id="retype-password-input" class="password" />
                        <i class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <span id="error-message"></span>
                    <div class="submit-container">
                        <button id="cancel-password-btn" class="btn cancel">Cancel</button>
                        <button name="updatePassword" type="submit" class="btn btn-danger">Change Password</button>
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
<script src="../js/update-profile.js"></script>
<script src="../../js/password-hide-show.js"></script>
</html>