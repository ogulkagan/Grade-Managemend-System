<?php

    include 'connection.php';
    $field = $_POST['Field'];
    $name = $_POST['Name'];
    $type =$_POST['type'];
    $td=$_POST['td'];
    if($type=="grade"){
    $query = mysqli_query($dbcon,"UPDATE scale SET ".$field." = '".$name."' Where ScaleId = 'Def';");}
    else{
        if(is_numeric($name))
        {
            if($name > 0 && $name <100)
            {
                $query = mysqli_query($dbcon,"UPDATE scale SET ".$field."=".$name." Where ScaleId = 'Def';");
            }
            else{
                echo "Wrong Input";
            }
        }
         else{
                echo "Wrong Input";
            }
     }
    
  

