<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../resources/fontawesome-free-6.3.0-web/css/all.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../css/update-profile.css">
    <title>Update Profile For Donor</title>
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
                    <h1 id="name">John Doe</h1>
                    <div id="time-joined">
                        <i class="fa-regular fa-calendar-minus"></i>
                        <span>Joined on 11th March, 2023</span>
                    </div>
                </div>
                <div id="bottom-user-info">
                    <div class="info-container">
                        <div class="top-donation">    
                            <span id="pending-donations">0</span>
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <span>PENDING DONATIONS</span>
                    </div>
                    <div class="info-container">
                        <div class="top-donation">    
                            <span id="successful-donations">0</span>
                            <i class="fa-solid fa-pizza-slice"></i>
                        </div>
                        <span>SUCCESSFUL DONATIONS</span>
                    </div>
                </div>
            </div>
        </section>
        <hr>
        <section id="change-info">
            <form action="index.php" id="update-form" class="form" method="">
                <div class="form-head">
                    <h3>UPDATE PROFILE</h3>
                    <span>Edit your account info here.</span>
                </div>
                <div class="form-body">
                    <div id="email-entry" class="entry">
                        <label for="">Email</label>
                        <input type="text" name="email-input" id="email-input" />
                        <button id="email-btn" class="btn">Change email</button>
                    </div>
                    <div id="password-entry" class="entry">
                        <label for="">Change password</label>
                        <button id="password-btn" class="btn">Change password</button>
                    </div>
                    <div id="fullname-entry" class="entry">
                        <label for="fullname-input">Fullname</label>
                        <input type="text" name="fullname-input" id="fullname-input" />
                    </div>
                    <div id="address-entry" class="entry">
                        <label for="address-input">Address</label>
                        <input type="text" name="address-input" id="address-input" />
                    </div>
                    <div id="mobile-number" class="entry">
                        <label for="mobile-input">Mobile Number</label>
                        <input type="text" name="mobile-input" id="mobile-input" />
                    </div>
                    <div class="submit-container">
                        <input class="btn" type="submit" value="Save Changes">
                    </div>
                </div>
            </form>

            <form action="index.php" id="password-form" class="form" method="">
                <div class="form-head">
                    <h3>CHANGE PASSWORD</h3>
                    <span>Change your password here.</span>
                </div>
                <div class="form-body">
                    <div id="old-password-entry" class="entry">
                        <label for="old-password-input">Old Password</label>
                        <input type="password" name="old-password-input" id="old-password-input" class="password" />
                        <i id="" class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <div id="new-password-entry" class="entry">
                        <label for="new-password-input">New Password</label>
                        <input type="password" name="new-password-input" id="new-password-input" class="password" />
                        <i class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <div id="retype-password-entry" class="entry">
                        <label for="retype-password-input">Retype Password</label>
                        <input type="password" name="retype-password-input" id="retype-password-input" class="password" />
                        <i class="fa-solid fa-eye-slash dt eye-icon"></i>
                    </div>
                    <span id="error-message"></span>
                    <div class="submit-container">
                        <button id="cancel-password-btn" class="btn cancel">Cancel</button>
                        <input id="change-password-btn" class="btn" type="submit" value="Change Password">
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
<script src="../js/update-profile.js"></script>
<script src="../../js/password-hide-show.js"></script>
</html>