<?php
require_once '../../connection.php';
require '../../functions.php';
session_start();

//block of code to save users longitude and latitude in session
if(isset($_GET['q'])){
    if($_GET['q']=='saveLongLat'){
        $_SESSION['longitude'] = $_GET['longitude'];
        $_SESSION['latitude'] = $_GET['latitude'];

        $res = [];
        $res['status'] = 200;
        $res['message'] = 'Location saved successfully !!!';

        echo json_encode($res);
    }
}

//savign user to db
if(isset($_POST['saveUser'])){

    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $type = "";
    $emailExist = false;

    $n = $db->query("SELECT count(id) as result from users where email = '$email'");
    foreach($n as $row){
        if($row['result']>0){
            $emailExist = true;
        }
    }


    if(isset($_POST['donor'])){
        $type='donor';
    }
    if(isset($_POST['receiver'])){
        $type='receiver';
    }

    if(!is_numeric($tel) || strlen($tel)<8 || strlen($tel) > 8){
        redirect('error','Invalid phone number enter valid phone number','registration.php');
    }
    if(!isEmail($email)){
        redirect('error','Invalid Email Please Enter Correct Email ex: example@gmail.com','registration.php');
    }
    if($emailExist){
        redirect('error','Sorry this email address is already taken','registration.php');
    }
    if(!isPasswordValid($password)){
        redirect('error','Password should be Min 8 characters, contain atleast One upperase and atleast One Lowercase','registration.php');
    }
    if($password != $cpassword){
        redirect('error','Passwords are not thesame','registration.php');
    }
    if(strlen($type)<=0){
        redirect('error','You must select account type (donor/receiver)','registration.php');
    }
    try{
        $password = password_hash($password,PASSWORD_DEFAULT);
        $long = floatval($_SESSION['longitude']);
        $lat = floatval($_SESSION['latitude']);
        $date = date("Y-m-d h:i:s");

        if($db->exec("INSERT INTO users (fullname,address,tel,email,password,type,longitude,latitude, joinedDate) values ('$fullname','$address','$tel','$email','$password','$type','$long','$lat', '$date')")){
            redirect('success','Account created successfully','registration.php');
        }   

    }catch(Exception $e){
        redirect('error',$e,'registration.php');
    }
}


//block of code to login user
if(isset($_POST['loginUser'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isFound = false;

    $n = $db->query("SELECT count(id) as result from users where email = '$email'");
    foreach($n as $row){
        if($row['result']>0){
            $isFound = true;
        }
    }

    if($isFound){
        $n = $db->query("SELECT * from users where email = '$email'");
        foreach($n as $row){
            if(password_verify($password,$row['password'])){
                $_SESSION['fullname'] = $row['fullname'];
                $_SESSION['email']  = $row['email'];
                $_SESSION['tel']  = $row['tel'];
                $_SESSION['type']  = $row['type'];
                $_SESSION['longitude']  = $row['longitude'];
                $_SESSION['latitude']  = $row['latitude'];
                $_SESSION['userId']  = $row['id'];

                //here redirect user to proper dashboard base on user type
                if($row["type"] == "admin"){
                    header('Location: ../../admin/index.php');
                    exit();
                }
                else if($row["type"] == "donor")
                {
                    header('Location: index.php');
                    exit();
                }
                else {
                    header('Location: ../receiver/index.php');
                    exit();
                    }
            }
        }
    }

    redirect('error',"Login Fail Verify Email and Password !!!",'login.php');

}


?>