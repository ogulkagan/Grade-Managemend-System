<?php
include 'connection.php';

    $EMail = $_POST['EMail'];
    $uName = $_POST['Name'];
    $uSurname = $_POST['Surname'];
    $Office = $_POST['Office'];
    $Title = $_POST['Title'];
    $isAdmin = $_POST['isAdmin'];
    
    $query = "UPDATE user SET EMail = '".$EMail."' "
            . ",uName = '".$uName."' "
            . ",uSurname = '".$uSurname."' , Title ='".$Title."' , "
            . "Office = '".$Office."'  Where EMail = '".$EMail."';";
           
   
    $asd = mysqli_query($dbcon,$query);
    
        
    
 
