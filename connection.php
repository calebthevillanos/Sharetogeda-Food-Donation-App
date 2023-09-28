<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=sharetogeda;','root','');
    
}catch(PDOEXception $e){
    echo $e;
}

?>