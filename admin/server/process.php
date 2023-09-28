<?php
require_once '../../connection.php';
require '../../functions.php';
if(isset($_POST['login'])){
    $email = $_POST['email-address'];
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

                //here redirect user to proper dashboard base on user type
                redirect('success',"Login successfully !!!",'admin/index.php');
                break;
            }
        }
    }

    redirect('error',"Login Fail Verify Email and Password !!!",'admin/login.php');

}

?>