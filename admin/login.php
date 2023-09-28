<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="overlay"></div>

    <main>
        <div id="title">
            <h2>Admin Login</h2>
            <a href="../../index.html"><img src="../resources/images/logo-cropped.jpg" alt=""></a>
        </div>
        <form action="process.php" id="login-form" method="POST">
            <div class="entry">
                <label for="email-address">Email Address</label>
                <div id="email-input" class="input">
                    <i class="fa-solid fa-envelopes-bulk"></i>
                    <input type="email" name="email-address" id="email-address">
                </div>
            </div>
            <div class="entry">
                <label for="password">Password</label>
                <div id="password-input" class="input">
                    <i class="fa-solid fa-user-lock"></i>
                    <input type="password" name="password" id="password">
                    <i class="fa-solid fa-eye-slash dt" id="eye-icon"></i>
                </div>
            </div>
            <input name="login" type="submit" value="LOGIN">
        </form>
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
    </main>
</body>
<script src="../js/password-hide-show.js"></script>
<script src="js/login.js"></script>
</html>