<?php
    session_start();
    include_once 'connection.php';
    if($_POST){
        
        
        $i=$_POST['grade'];
        
        $query = "Select * FROM scale where ScaleId = 'Def'";
                $responce = mysqli_query($dbcon, $query);
                $row = mysqli_fetch_array($responce);
               
                $jj=$i;
                
                 while($row['grade'.$jj]!=-1){
                     $j=$jj+1;
                  $query_change = "Update scale Set grade".$jj."='".$row['grade'.$j]."' where ScaleId = 'Def'";
                $grade_change= mysqli_query($dbcon, $query_change);
                $query_res = "Update scale Set res".$jj."=".$row['res'.$j]." where ScaleId = 'Def'";
               $res_change=mysqli_query($dbcon, $query_res);
                       
                      
                      $jj++;
                 }
        
        
        
        
    }