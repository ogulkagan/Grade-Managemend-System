<?php
    include_once '../connection.php';
    session_start();
    
     if($_POST){
        
         $type = $_POST['Type'];
         $exam = $_POST['Aid'];
         $visibility = $_POST['Status'];
         $pieces = explode(">", $visibility);
          echo $pieces[0]." ".$pieces[1];
         if($type == "cat"){
             
             if(strcmp($pieces[1],"NV") == 0){
                  $query_visibility = mysqli_query($dbcon , "Update attendance Set Visible = 1 where aid='".$exam."';");
                  
             }
             if(strcmp($pieces[1],"V") == 0){
                 $query_visibility = mysqli_query($dbcon , "Update attendance Set Visible = 0 where aid='".$exam."';");
                 
             }
             
         }
         else{
             if(strcmp($pieces[1],"NV") == 0){
                  $query_visibility = mysqli_query($dbcon , "Update grade Set Visible = 1 where gid='".$exam."';");
                  
             }
             if(strcmp($pieces[1],"V") == 0){
                 $query_visibility = mysqli_query($dbcon , "Update grade Set Visible = 0 where gid='".$exam."';");
                
             }
             
             
         }
         
     }

