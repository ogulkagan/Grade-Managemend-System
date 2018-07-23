<?php
    include_once '../connection.php';
    session_start();
        
    
           
          if($_POST){
            $dname = $_POST['dname'];
            $dnum = $_POST['dnumber'];
            
            if($dname=="Name"){
            $query = "UPDATE student SET sName='".$dnum."' Where sid =".$_SESSION['stdid1'];
            mysqli_query($dbcon, $query);
            }
            if($dname=="Surname"){
              $query1 = "UPDATE student SET sSurname='".$dnum."' Where sid =".$_SESSION['stdid1'];
            mysqli_query($dbcon, $query1);
            }
            
            
            }