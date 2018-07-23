<?php
session_start();
?>
<?php

  include_once '../connection.php';
    
$section=$_POST['section'];
    $cid = $_SESSION["cid"];
    $mail=$_SESSION["uName"];
        
        $query="Select * from cat where cid=".(int)$cid." and section=".$section;
        $dr1=mysqli_query($dbcon, $query);
        if(mysqli_num_rows($dr1)){
          
        } 
       else{
            $sql = "INSERT INTO cat(eMail,cid,section) VALUES ('$mail',$cid,$section)";
        mysqli_query($dbcon, $sql); 
       }
        
         $query2="Select * from dog where cid=".(int)$cid." and section=".$section;
        $dr2=mysqli_query($dbcon, $query2);
        
        
         if(mysqli_num_rows($dr2)){
           
        }
        else{
             $sql = "INSERT INTO dog(eMail,cid,section) VALUES ('$mail',$cid,$section)";
        mysqli_query($dbcon, $sql); 
        }
        
?>
       