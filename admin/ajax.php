<?php
require '../connection.php';
session_start();


if(isset($_GET['q'])){
    $res = [];
    $res["ok"] = true;
    if($_GET['q']=='saveSite'){
            $sitename = $_GET['siteName'];
            $longitude = $_GET['longitude'];
            $latitude = $_GET['latitude'];
        
            if($db->exec("INSERT INTO donation_sites(name,longitude,latitude) values('$sitename','$longitude','$latitude')")){
               $res["value"] = "1";
                echo json_encode($res);
            }else{
                $res["value"] = "0";
                echo json_encode($res);
            }
    }


    if($_GET['q']=='confirm'){
        $id = $_GET['id'];
        if($db->exec("UPDATE reservations set status ='reserved' where id='$id'")){
            $res['ok'] = true;
        }else{
            $res['ok'] = false;
        }
        echo json_encode($res);
    }
    else if($_GET['q']=='cancel'){
        $id = $_GET['id'];
        if($db->exec("UPDATE reservations set status ='pending' where id='$id'")){
            $res['ok'] = true;
        }else{
            $res['ok'] = false;
        }

        echo json_encode($res);
    }
}


?>