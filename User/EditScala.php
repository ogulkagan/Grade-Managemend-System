<?php
session_start();
    include_once '../connection.php';

    $field = $_POST['Field'];
    $name = $_POST['Name'];
    
    
        $query = mysqli_query($dbcon,"UPDATE scale SET ".$field."=".(int)$name." where ScaleId='".$_SESSION['cid']."'");