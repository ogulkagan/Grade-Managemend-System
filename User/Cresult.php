<?php
session_start();
    include_once '../connection.php';
    
    if($_POST){
        $gradess=$_POST["sid"]; 
        $st_id=$_POST["grade"];   
        $dog = $_SESSION['catordog_id'];
        
        
         $query_for_cid= "Select cid from dog where Id=".$dog;
         $result_cid= mysqli_query($dbcon,$query_for_cid);
                                  $cid1= mysqli_fetch_array($result_cid);
                                  $cid=$cid1['cid'];
                                  echo $st_id;
        $update_cresult= mysqli_query($dbcon,"UPDATE cresult SET alp='".$gradess."' WHERE cid=".$cid." and sid=".$st_id); 
        
    }
    