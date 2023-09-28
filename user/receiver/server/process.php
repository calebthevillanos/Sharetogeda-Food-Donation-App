<?php
  require "../../../connection.php";
  if(isset($_GET["q"]))
  {
    $array = [];
    if($_GET["q"] == 'donations')
    {
        $sql = "SELECT * FROM donations";
        $n = $db->query($sql);
        foreach($n as $row)
        {
            array_push($array, $row);
        }
       echo json_encode($array);
    }
  }
?>