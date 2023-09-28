<?php

// function to check if it's email
function isEmail($email)
{
   $email_validation_regex = '/^\\S+@\\S+\\.\\S+$/';
   return preg_match($email_validation_regex, $email); 
}

//is password valid
function isPasswordValid($password){
    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/"; 
    return preg_match($password_regex, $password);
}

//function to create a session save the message and redirect user
function redirect($key,$msg,$path){
    $_SESSION[$key] = $msg;
    header('Location: '.$path);
    exit();
}

//function to check if user is logged in
function isLoggedIn(){
    return (isset($_SESSION['email']) && isset($_SESSION['fullname']));
}

?>