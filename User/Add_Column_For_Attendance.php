<?php
                include_once '../connection.php';
                session_start();
                
                 if($_POST){
                        $insertdate = date("Y-m-d", strtotime($_POST['At_date']));
                        $c_id = $_SESSION['catordog_id'];
                        $id = $insertdate."/".$c_id;
                        try{
                            $query_check = "Select * From attendance where aid='".$id."'";
                             $result_check = mysqli_query($dbcon, $query_check);
                        if(mysqli_num_rows($result_check) == 0){
                            $query = "Select aid from attendance where Id = ".$c_id;
                            $asd = mysqli_query($dbcon, $query);
                            $result = mysqli_fetch_array($asd);

                            $sql = "INSERT INTO attendance VALUES ('$insertdate',0, $c_id,'$id')";
                            mysqli_query($dbcon, $sql)or die(mysqli_error($this->db_link)); 

                            $query1 = "Select sid from atresult where aid='".$result['aid']."';";
                            $students = mysqli_query($dbcon, $query1);
                            while($row = mysqli_fetch_array($students)){
                                $ll = $row['sid'];
                                $query5 = "Insert Into atresult Values($ll,'$id',0)";
                                mysqli_query($dbcon, $query5);
                            }
                            echo "Successfully Added .";
                        }else{
                            echo "Your can't pick this date. This date is already exist in your table.";
                            }
                        } catch (Exception $ex) {
                                echo "Please Try Again Later.";
                        }
                        
                        
                        
                    }
               
           
      
