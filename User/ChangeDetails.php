<?php
    include_once '../connection.php';
    session_start();
    
             if($_POST){
            $dname = $_POST['dname'];
            $dnum = $_POST['dnumber'];
            
            
            
            
            if($dname=="Percentage"){
            $query = "UPDATE grade  SET " . $dname. "=" .(int)$dnum." Where gid ='".$_SESSION['gid']."'";
            mysqli_query($dbcon, $query);
            }
            if($dname=="Visibility"){
                if($dnum=="Y" || $dnum=="y"){
              $query1 = "UPDATE grade SET Visible=1 Where gid ='".$_SESSION['gid']."'";
              
            mysqli_query($dbcon, $query1);
                }
               else{
                   $query1 = "UPDATE grade SET Visible=0 Where gid ='".$_SESSION['gid']."'";
              
            mysqli_query($dbcon, $query1); 
               }
            }
            
            if($dname=="Final"){
                  if($dnum=="Y" || $dnum=="y"){
                  $query2 = "UPDATE grade  SET is_final=1 Where gid ='".$_SESSION['gid']."'";
            mysqli_query($dbcon, $query2);
                  }
                 else{
                      $query2 = "UPDATE grade  SET is_final=0 Where gid ='".$_SESSION['gid']."'";
            mysqli_query($dbcon, $query2);
                 }
            }
           } 