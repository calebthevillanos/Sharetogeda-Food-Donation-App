<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/form-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style>
         .wrapper-type{
                    width: 100%;
                    height: auto;
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                }
                .checkbox-donor,.checkbox-receiver{
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    font-size: 13px;
                }
                .checkbox-donor input[type='radio'],.checkbox-donor label,
                .checkbox-receiver input[type='radio'], .checkbox-receiver label{
                    cursor: pointer;
                }
                .checkbox-donor input[type='radio'],
                .checkbox-receiver input[type='radio']{
                    margin-left: 5%;
                }
    </style>
    <title>Registration Page</title>
</head>
<body>
    <main>
        <a href="../../index.html">
            <button class="btn btn-primary m-2" style="margin-left: 5%;">Go back Home</button>
        </a>
        <h2>Registration Now !!!</h2>
        <form id="registration-form" action="process.php" method="post">
            <div class="entry">
                <label for="full-name">Full Name</label>
                <div id="name-input" class="input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="fullname" id="full-name" required>
                </div>
            </div>
            <div class="entry">
                <label for="address">Address</label>
                <div id="address-input" class="input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="address" id="address" required>
                </div>
            </div>
            <div class="entry">
                <label for="mobile-number">Mobile Number</label>
                <div id="number-input" class="input">
                    <i class="fa-solid fa-square-phone"></i>
                    <input type="tel" name="tel" id="mobile-number" required>
                </div>
            </div>
            <div class="entry">
                <label for="email-address">Email Address</label>
                <div id="email-input" class="input">
                    <i class="fa-solid fa-envelopes-bulk"></i>
                    <input type="email" name="email" id="email-address" required>
                </div>
            </div>
            <div class="entry">
                <label for="password">Password</label>
                <div id="password-input" class="input">
                    <i class="fa-solid fa-user-lock"></i>
                    <input type="password" name="password" id="password" required>
                    <i class="fa-solid fa-eye-slash dt" id="eye-icon"></i>
                </div>
            </div>
            <div class="entry">
                <label for="password">Confirm Password</label>
                <div id="password-input" class="input">
                    <i class="fa-solid fa-user-lock"></i>
                    <input type="password" name="cpassword" id="cpassword" required>
                    <i class="fa-solid fa-eye-slash dt" id="eye-icon"></i>
                </div>
            </div>

            <div class="wrapper-type">
                <div class="checkbox-donor">
                    <label for="donor"><b>Donor</b></label>
                    <input type="radio" onchange="toggleUserType(this,'receiver')"  name="donor" id="donor" >
                </div>
                <div class="checkbox-receiver">
                    <label for="receiver"><b>Receiver</b></label>
                    <input type="radio" onchange="toggleUserType(this,'donor')" name="receiver" id="receiver" >
                </div>
            </div>

            <input type="submit" name="saveUser" value="Sign Up">
            <a href="login.php" class="login">Already have an account? Login</a>
        </form>
    </main>
    <span class="vertical-separator"></span>
    <aside>

    <?php if(isset($_SESSION['error'])){ ?>
        <div style="width:80%;float:right;" class=" mt-2 mx-3  alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Opps</strong> <?= $_SESSION['error']; ?>
        </div>
    <?php unset($_SESSION['error']); } ?>

    <?php if(isset($_SESSION['success'])){ ?>
        <div style="width:80%;float:right;" class=" mt-2 mx-3  alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']); } ?>
        

        <div id="logo">
            <a href="../../index.php"><img src="../../resources/images/logo-cropped.jpg" alt=""></a>
        </div>
    </aside>
</body>
<script src="./js/validate-user-type.js"></script>
<script src="../../js/password-hide-show.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</html>