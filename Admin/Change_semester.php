<?php
    session_start();
    include '../connection.php';
    include_once 'User_control.php';
    
    if(isset($_POST['Semester'])){
        $pieces = explode(":", $_POST['Semester']);
        $year = $pieces[0];
        $mevsim = $pieces[1];
        $ss = mysqli_query($dbcon , "select Id From semester where Mevsim = '".$mevsim."' And sYear = '".$year."'");
        $result = mysqli_fetch_array($ss);
        
        $current = mysqli_query($dbcon , "Update semester Set sCurrent = 0");
        $query_semester = mysqli_query($dbcon , "Update semester Set sCurrent = 1 where Id =".$result['Id']);
        
    }
