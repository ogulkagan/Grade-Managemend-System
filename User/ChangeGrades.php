<?php
    include_once '../connection.php';
    session_start();
        if($_POST){
            $student = $_POST['stu_id'];
            $examid = $_POST['ex_id'];
            $grades = $_POST['grade'];
            
          
           for($j = 0;$j<count($student);$j++){
               for($i = 0; $i < count($examid[$j]);$i++){
                    $query = "UPDATE gresult SET Result= ".$grades[$j][$i]." Where sid = ".$student[$j]." And gid = '".$examid[$j][$i]."';";
                    if (mysqli_query($dbcon, $query)) {
                        echo "Succesfull.";
                    } else {
                         echo "Wrong Query. Please Try Again.";
                    }  
                }
           }
          
        }