<?php
    include_once 'connection.php';
    if($_POST){
        $email = $_POST['EMail'];
        $query = mysqli_query($dbcon , "Update user Set Password='".$email."' where EMail = '".$email."';");
        echo "Successfuly Done.";
    }

