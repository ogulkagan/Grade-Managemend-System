<?php

      
      session_start();
      include_once '../connection.php';
      if($_POST){
          $percentage = $_POST['percentage'];
          $gid = $_POST['gid'];
          $query_for_change_percentage = mysqli_query($dbcon , "Update grade set Percentage=".$percentage." where gid = '".$gid."';");
        
      }

