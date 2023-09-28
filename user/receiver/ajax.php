<?php
require '../../connection.php';
session_start();

if(isset($_GET['q'])){
    $res = [];
    $res["status"] = 200;
    $userId = $_SESSION['userId'];

    if($_GET['q']=='reserve'){
        $id = $_GET['id'];
        if($db->exec("INSERT INTO reservations (donationId,status,userId) values ('$id','pending','$userId')")){
            $res['ok'] = true;
        }else{
            $res['ok'] = false;
        }
    }
    else if($_GET['q']=='cancel'){
        $id = $_GET['id'];
        if($db->exec("DELETE FROM reservations where id='$id'")){
            $res['ok'] = true;
        }else{
            $res['ok'] = false;
        }
    }

    echo json_encode($res);
}

?>