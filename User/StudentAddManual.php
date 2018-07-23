<?php
            include_once '../connection.php';
            session_start();
            
            
           if($_POST){   
             if (empty($_POST["ID"]) || empty($_POST["Name"]) ||empty($_POST["Surname"])) {
                echo " TRY AGAİN !";
              } 
              else {
                $ID = $_POST["ID"];
                $name = $_POST["Name"];
                $surname = $_POST["Surname"];
                $type = $_POST['Type'];
                if($type == "cat")
                {
                    $flag=0;
                    $querycourse= mysqli_query($dbcon, "select cid from cat where id=".$_SESSION['catordog_id']);
                    $resultcourse= mysqli_fetch_array($querycourse);
                    $catquery= mysqli_query($dbcon,"select Id from cat where cid=".$resultcourse['cid']);
                    while($search_for_cat= mysqli_fetch_array($catquery))
                    {
                     $getaid=mysqli_query($dbcon,"select aid from attendance where Id=".$search_for_cat['Id']); 
                     $aidresult= mysqli_fetch_array($getaid);
                     $get_atresult= mysqli_query($dbcon,"Select sid from atresult where aid='".$aidresult['aid']."' and sid=".$ID);
                      if(mysqli_num_rows($get_atresult) != 0)
                      {     
                          $flag = 1;
                          break;
                      }
                           
                    }
                    
                    
                    if($flag==0)
                    {
                    $query = "select * from student where Sid = ".$ID;
                    $result = mysqli_query($dbcon, $query);
                    if(mysqli_num_rows($result) < 1){
                            $enter_student= "insert into student(sName,sSurname,Sid,password) values('$name', '$surname', $ID, '$ID')";
                            mysqli_query($dbcon, $enter_student);
                            $enter_student_attendance="Select aid From attendance where Id=".$_SESSION['catordog_id'];
                            $start_query=mysqli_query($dbcon, $enter_student_attendance);
                            while ($row = mysqli_fetch_array($start_query)) {
                                $row_Aid = $row['aid'];
                                $enter_attendance = "insert into atresult(sid,aid,Result) values( $ID,'$row_Aid' , 0)"; 
                                mysqli_query($dbcon, $enter_attendance);
                            }
                        
                    }
                    else{
                    $enter_student_attendance = "Select aid From attendance where id=".$_SESSION['catordog_id'];
                    $start_query = mysqli_query($dbcon, $enter_student_attendance);
                    while ($row = mysqli_fetch_array($start_query)) {
                        $row_Aid = $row['aid'];
                        $enter_attendance = "insert into atresult(sid,aid,Result) values( $ID,'$row_Aid' , 0)"; 
                        mysqli_query($dbcon, $enter_attendance);
                        }
                    }
                    
              
                }
                
                
                }
                else{
                    $flag=0;
                    $querycourse= mysqli_query($dbcon, "select * from dog where Id=".$_SESSION['catordog_id']);
                    $resultcourse= mysqli_fetch_array($querycourse);
                    $catquery= mysqli_query($dbcon,"select * from dog where cid=".$resultcourse['cid']);
                    while($search_for_cat= mysqli_fetch_array($catquery))
                    {
                     $getaid=mysqli_query($dbcon,"select * from grade where Id=".$search_for_cat['Id']); 
                      $aidresult= mysqli_fetch_array($getaid);
                     $get_atresult= mysqli_query($dbcon,"Select * from gresult where gid='".$aidresult['gid']."' and sid=".$ID);
                     if(mysqli_num_rows($get_atresult) != 0)
                      {     
                          $flag = 1;
                          break;
                      }
                      
                    }
                    if($flag==0)
                    {
                    $query = "select * from student where Sid = ".$ID;
                    $result = mysqli_query($dbcon, $query);
                    if(mysqli_num_rows($result) < 1){
                            $enter_student= "insert into student(sName,sSurname,Sid,password) values('$name', '$surname', $ID, '$ID')";
                            mysqli_query($dbcon, $enter_student);
                            $enter_student_grade="Select gid From grade where Id=".$_SESSION['catordog_id'];
                            $start_query=mysqli_query($dbcon, $enter_student_grade);
                            while ($row = mysqli_fetch_array($start_query)) {
                                $row_gid = $row['gid'];
                                $enter_grade = "insert into gresult(Result,sid,gid) values(0,$ID,'$row_gid')"; 
                                mysqli_query($dbcon, $enter_grade);
                            }
                    }
                    else{
                        $enter_student_grade = "Select gid From grade where Id=".$_SESSION['catordog_id'];
                        $start_query = mysqli_query($dbcon, $enter_student_grade);
                        while ($row = mysqli_fetch_array($start_query)) {
                            $row_gid = $row['gid'];
                            $enter_grade = "insert into gresult(Result,sid,gid) values(0,$ID,'$row_gid')"; 
                            mysqli_query($dbcon, $enter_grade);
                          }
                    }
                     
                    $query_for_cid = mysqli_query($dbcon, "Select cid from dog where Id=".$_SESSION['catordog_id']);
                    $cid= mysqli_fetch_array($query_for_cid);
                    $cid1=$cid['cid'];
                    $query_for_cresult= mysqli_query($dbcon, "insert into cresult(sid,cid,alp) values($ID,$cid1,' ')");
                    
                }
             }
                

       }
                
                         
}
            
    