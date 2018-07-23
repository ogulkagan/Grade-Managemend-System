<?php
    include_once '../connection.php';
    session_start();

    $query_for_aid = mysqli_query($dbcon, "Select aid from attendance where Id=".(int)$_SESSION['catordog_id']);
    while($aid= mysqli_fetch_array($query_for_aid))
    {
         $query = "DELETE FROM atresult WHERE sid=".(int)$_SESSION['stdid1']." and aid='".$aid['aid']."'";
         mysqli_query($dbcon, $query);
    }
      unset($_SESSION['stdid1']);