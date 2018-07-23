<?php
        if(!isset($_SESSION['sid'])){
              header("Location: ../index.php");
        }
        if(isset($_SESSION['uName'])){
              header("Location: ../index.php");
        }