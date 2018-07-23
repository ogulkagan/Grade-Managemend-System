<?php
    include_once '../connection.php';
    session_start();

                $query_for_gid = mysqli_query($dbcon, "Select gid from grade where Id=".(int)$_SESSION['catordog_id']);
               while($gid= mysqli_fetch_array($query_for_gid))
                 {
                    $query = "DELETE FROM gresult WHERE sid=".(int)$_SESSION['stdid1']." and gid='".$gid['gid']."'";
                    mysqli_query($dbcon, $query);
                 }
                $query_for_cid = mysqli_query($dbcon, "Select cid from dog where Id=".(int)$_SESSION['catordog_id']);
                $cid= mysqli_fetch_array($query_for_cid);
                $cid1=$cid['cid'];
                $ID=$_SESSION['stdid1'];
                $query_for_cresult= "Delete from cresult where sid=".$ID." and cid=".$cid1;
                mysqli_query($dbcon, $query_for_cresult);
        unset($_SESSION['stdid1']);