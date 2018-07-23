<?php

include_once 'connection.php';
    if($_POST){
        $email = $_POST['EMail'];
        $query = mysqli_query($dbcon , "Update student Set Password='".$email."' where Sid = ".$email);
        echo "Successfuly Done.";
    }

