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
    <link rel="stylesheet" href="../css/form-style.css">
    <link rel="stylesheet" href="../css/login-style.css">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <title>Login Panel</title>
</head>
<body>
    <main>
        <a href="../../index.html">
            <button class="btn btn-primary m-2" style="margin-left: 5%;">Go back Home</button>
        </a>
        <h2>Login To Dashbard</h2>
        <h3>Welcome Back!</h3>
        <form id="login-form" action="process.php" method="post">
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
            <a href="#" class="forgot-password">Forgot Password?</a>
            <div class="entry" id="remember-me-input">
                <input type="checkbox" name="remember-me" id="remember-me">
                <label for="remember-me">Keep me signed in</label>
            </div>
            <input type="submit" name="loginUser" value="LOGIN">
            <a href="registration.php" class="signup">Don't have an account? Signup</a>
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
<script src="../../js/password-hide-show.js"></script>
</html>