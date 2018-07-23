<?php
include_once 'connection.php';
    if($_POST){
            $first = $_POST['first'];
            $second = $_POST['second'];
            try{
                $query_course1 = "Update course SET admin_mail='".$second."' Where admin_mail='".$first."'";
                $result_course1 = mysqli_query($dbcon, $query_course1);
                
                $query_attendance2 = "Update cat SET eMail = '".$second."' Where eMail = '".$first."'";
                $result_attendance2 = mysqli_query($dbcon, $query_attendance2);
        
                $query_grade3 = "Update dog SET eMail = '".$second."' Where eMail='".$first."'";
                $result_grade3 = mysqli_query($dbcon, $query_grade3);
                
                echo "Succesfull";
            } catch (Exception $ex) {
                echo "Please Try Again !".$ex;
            }
            
        
    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    


