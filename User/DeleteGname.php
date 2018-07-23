<?php
    include_once '../connection.php';
    session_start();
    if(isset($_POST['gid'])){
        $query = "DELETE FROM gresult WHERE gid='". $_POST['gid']. "'";
        mysqli_query($dbcon, $query);

        $query1 = "DELETE FROM grade WHERE gid='". $_POST['gid']. "'";
        mysqli_query($dbcon, $query1);
    }
    
            
          
        
            
          
