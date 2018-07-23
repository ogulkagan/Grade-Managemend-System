<?php


        if(!isset($_SESSION['uName'])){
            header("Location: ../index.php");
        }
        else{
            if($_SESSION['isAdmin'] == 1){
                header("Location: ../index.php");
            }
            
        }
