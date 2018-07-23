<?php
    
    if(isset($_SESSION['sid']))
    {
        header("Location: ../index.php");
    }
    
    if(!isset($_SESSION['uName']))
    {
        header("Location: ../index.php");
    }
    else{
        if(isset($_SESSION['isAdmin'])){
        if($_SESSION['isAdmin'] == 0){
           header("Location: ../index.php");
         }
        }
    }
