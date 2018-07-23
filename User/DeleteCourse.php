<?php
session_start();
  include_once '../connection.php';
    
$query_for_dogsection= mysqli_query($dbcon,"select * from dog where cid=".$_SESSION['cid']);
$query_for_catsection= mysqli_query($dbcon,"select * from cat where cid=".$_SESSION['cid']);
        
        
        
        if(mysqli_num_rows($query_for_dogsection) && mysqli_num_rows($query_for_catsection)){
           echo "1";
        }
        
        else{
            $query_for_mail=mysqli_query($dbcon,"select * from course where cid=".$_SESSION['cid']);
            $mail= mysqli_fetch_array($query_for_mail);
            if($mail['admin_mail']==$_SESSION["uName"]){
            $query_for_delete= mysqli_query($dbcon,"Delete from course where cid=".$_SESSION['cid']);
             $query_for_scale= mysqli_query($dbcon,"Delete from scale where ScaleId='".$_SESSION['cid']."'");
            }
                
              echo "2";
        }
        