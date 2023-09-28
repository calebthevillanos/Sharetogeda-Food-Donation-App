<?php
$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="donation_app";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName, 3310);

if(!$conn) {
    die("Connection failed:".mysqli_connect_error());
}
?>