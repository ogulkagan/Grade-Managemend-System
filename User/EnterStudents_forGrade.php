<?php
        session_start();
        include_once '../connection.php';
                   if($_FILES){
                    if(isset($_FILES["file"]["name"]) && $_FILES['file']['type'] != 'text/plain') {
                      echo "<span>File could not be accepted ! Please upload any '*.txt' file.</span>";
                      exit();
                    } 
                    else {
                     //İsmi ve Yolunu tuttum !
                     $fileName = $_FILES['file']['tmp_name'];
                     //Açamadıysam error
                     $file = fopen($fileName,"r") or exit("Unable to open file!");
                    
                     while (($line = fgets($file)) !== false) {     
                        $pieces = explode(" ", $line);

                        //echo $pieces[0] . $pieces[1]. $pieces[2]."<br>";
                        $data[0] = isset($pieces[0]) ? $pieces[0] : null;
                        $data[1] = isset($pieces[1]) ? $pieces[1] : null;
                        $data[2] = isset($pieces[2]) ? $pieces[2] : null;
                        echo $data[0].$data[1].$data[2];
                        
                        $flag=0;
                        $querycourse= mysqli_query($dbcon, "select * from dog where id=".$_SESSION['catordog_id']);
                        $resultcourse= mysqli_fetch_array($querycourse);
                        $catquery= mysqli_query($dbcon,"select * from dog where cid=".$resultcourse['cid']);
                        while($search_for_cat= mysqli_fetch_array($catquery))
                        {
                         $getaid=mysqli_query($dbcon,"select * from grade where Id=".$search_for_cat['Id']); 
                          $aidresult= mysqli_fetch_array($getaid);
                         $get_atresult= mysqli_query($dbcon,"Select * from gresult where gid='".$aidresult['gid']."' and sid=".$data[0]);
                         if(mysqli_num_rows($get_atresult) != 0)
                          {     
                              $flag = 1;
                              break;
                          }

                        }
                        if($flag==0)
                        {
                        $query = "select * from student where Sid = ".$data[0];
                        $result = mysqli_query($dbcon, $query);
                        if($result){
                                if(mysqli_num_rows($result) < 1){
                                    $enter_student= "insert into student(sName,sSurname,Sid,password) values('$data[1]', '$data[2]', $data[0], '$data[0]')";
                                    mysqli_query($dbcon, $enter_student);

                                    $enter_student_attendance= " Select gid From grade where Id=".$_SESSION['catordog_id'];
                                    $start_query=mysqli_query($dbcon, $enter_student_attendance);
                                    while ($row = mysqli_fetch_array($start_query)) {
                                        $row_Gid = $row['gid'];
                                        $enter_attendance = "insert into gresult values(0,$data[0], '$row_Gid')"; 
                                        mysqli_query($dbcon, $enter_attendance);
                                    }
                                }
                                else{
                                    $enter_student_attendance = "Select gid From grade where id=".$_SESSION['catordog_id'];
                                    $start_query = mysqli_query($dbcon, $enter_student_attendance);
                                    while ($row = mysqli_fetch_array($start_query)) {
                                        $row_Aid = $row['gid'];
                                        $enter_attendance = "insert into gresult values(0,$data[0], '$row_Gid')"; 
                                        mysqli_query($dbcon, $enter_attendance);
                                    }
                                }
                    $query_for_cid = mysqli_query($dbcon, "Select cid from dog where Id=".$_SESSION['catordog_id']);
                    $cid= mysqli_fetch_array($query_for_cid);
                    $cid1=$cid['cid'];
                    $query_for_cresult= mysqli_query($dbcon, "insert into cresult(sid,cid,alp) values($data[0],$cid1,' ')");
                    
                           } 
                             
                     }
                    }
                     fclose($file);
                     echo "<script type='text/javascript'>window.location.href = 'GradeTable.php';</script>"; exit;

                   }  
              
                   
        }       
               