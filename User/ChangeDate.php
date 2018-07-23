<?php
    include_once '../connection.php';
    session_start();
    
             if($_POST){
            $dname = $_POST['dname'];
            $dnum = $_POST['dnumber'];
            
            
            
            
            if($dname=="Date"){
            $query = "UPDATE attendance SET atDate='".$dnum."' Where aid ='".$_SESSION['aid']."'";
            mysqli_query($dbcon, $query);
            }
            if($dname=="Visibility"){
              $query1 = "UPDATE attendance SET Visible=".(int)$dnum. " Where aid ='".$_SESSION['aid']."'";
            mysqli_query($dbcon, $query1);
            }
            
           
           } 
