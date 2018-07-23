<?php
    session_start();    
    include_once '../connection.php';
    if($_POST){
            $student =$_POST['stu_id'];
            $examid = $_POST['ex_id'];
            $grades = $_POST['grade'];
            
            
            for($j = 0;$j<count($student);$j++){
            for($i = 0; $i < count($examid[$j]);$i++){
            if($grades[$j][$i] == "Y" || $grades[$j][$i] == "y"){
                $query = "UPDATE atresult SET Result = 1 Where sid = ".$student[$j]." And aid = '".$examid[$j][$i]."';";
                mysqli_query($dbcon, $query);
            }
            else{
               $query = "UPDATE atresult SET Result = 0 Where sid = ".$student[$j]." And aid = '".$examid[$j][$i]."';"; 
               mysqli_query($dbcon, $query);
            }
          }
      }
            
 }