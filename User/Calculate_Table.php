<?php
    session_start();
    include_once '../connection.php';
    include 'User_control.php';
    include 'Section_control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        
        <script>
        $(document).ready(function() {
             $("#forms").submit(function(){
                     $('.genel').hide();   
             });
             
              $(".Save").click(function(){
               $("#asd tr:not(:first)").each(function(){
                  var id = $(this).find("td:eq(0)").text();
                  var sid1 = $(this).find("td:last").text();
                  
                  $.post("Cresult.php",{grade:id,sid:sid1} , function(){
                            alert("Successfully Saved.");
                        });
                     });
               });      
             
        });
        </script>
        
        <meta charset="UTF-8">
        <style>
            
           .first {
              background-color: rgb(49,57,64);
              color: white;
              position:static; 
             margin-left:15%;
            }
            .modal {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 ) 
                        url('http://i.stack.imgur.com/FhHRx.gif') 
                        50% 50% 
                        no-repeat;
            }
            .submit_button{
                    background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    margin-left:31.5%;
                    cursor: pointer;
              }
             .Save{
                    background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    margin-left:46.5%;
                    cursor: pointer;
                    
              }
            
            /* When the body has the loading class, we turn
               the scrollbar off with overflow:hidden */
            body.loading {
                overflow: hidden;   
            }
            
            /* Anytime the body has the loading class, our
               modal element will be visible */
            body.loading .modal {
                display: block;
            }
        </style>
       <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
       <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
       <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
       <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
       <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
       <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title></title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "GradeTable.php";
            $class = "first";
            $asd = "Return";
            echo "<a href=$href id = $class>".$asd."</a>";
           
            ?>
                <a class="first"  href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href = "../index.php" class="logout">Log Out</a
        </div>
    </div>

     <div class="Content">
        <?php
                        $genel ="genel";
                        echo "<div class = $genel>";
                        $div_class = "form-style-5";         
                        echo "<div class=$div_class>";
                        $form_method = "POST";
                        $form_action = "?";
                        $id = "forms";
                        echo "<form action = $form_action method = $form_method id = $id>";
                        echo "<fieldset>";
                        $cc = "number";
                        echo "<legend><span class=$cc>1</span>Properties</legend>";
                        echo "</fieldset>";
                        
                        $at_option = "field1";
                        $at_id = "is_Attendance";
                        $v1 = "1";
                        $v2 = "0";
                        echo "<legend>Attendance ?</legend>";
                        echo "<select id=$at_id name=$at_option>";
                        echo"<option value=$v1>YES</option>";
                        echo "<option value=$v2>NO</option>
                        </select>"; 
                        
                        
                        $name1 = "field2";
                        $space_holder_student1 = "0-100";
                        $names = "Name";
                        $type1 = "text";
                        echo "<legend>What is The Percentage Of Attendance</legend>";
                        echo "<input type=$type1 name=$name1 placeholder=$space_holder_student1 id=$names>";
                        
                        
                        $at_option1 = "type";
                        $v3 = "100";
                        $v4 = "Current";
                        $st3 = "field3";
                        echo "<legend>Calculate Percentage</legend>";
                        echo "<select id=$at_option1 name=$st3>";
                        echo"<option value=$v3>100%</option>";
                        echo "<option value=$v4>Current</option>
                        </select>"; 
                        
                        
                        echo "<legend>Please Pick Final Column</legend>";
                        echo "<select id='type' name='field4'>";
                        $query_for_final_selection = mysqli_query($dbcon , "Select * From grade where Id =".$_SESSION['catordog_id']);
                        while($row = mysqli_fetch_array($query_for_final_selection)){
                            $row_gid = $row['gid'];
                            $row_gname = $row['gName'];
                            
                            $is_final_def = mysqli_query($dbcon, "Update grade set is_final = 0 where gid = '".$row_gid."';");
                            
                            echo"<option value=$row_gid>$row_gname</option>";
                        }
                        echo"</select>"; 
                        
                        
                        $ttpp = "submit";
                        $class_name = "submit_button";
                        $name3 = "Calculate";
                        echo "<button type=$ttpp class= $class_name name =$name3>Calculate</button>"; 
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
        ?>
        <?php
            if($_POST){
                $is_attendance = $_POST["field1"];
                
                $attendance_percentage = $_POST["field2"];
                $calculation_percentage = $_POST["field3"];
                
                $is_final_column = $_POST["field4"];
                
                $query_for_final_column = mysqli_query($dbcon,"Update grade set is_final = 1 where gid = '".$is_final_column."';");
                
                
                
                if($is_attendance == 0){
                    $is_final=0;
                        $div_id = "bas";
                        echo "<div class = $div_id>";
                        $table_id = "asd";
                        $cell = "1";
                        echo "<table id=$table_id cellspacing=$cell><caption>Grade Table</caption><thead>";
                        
                        $query_id = "select * from dog where Id = ".$_SESSION['catordog_id'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                        $id = mysqli_fetch_array($responce_id);
                        
                        $query_gid = "select * from grade where Id= ".$_SESSION['catordog_id'];
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['gid'];
                                 echo "<th class=$clas>".$exam['gName']."\n".$exam['Percentage']."</th>";
                                 $empty_rows++;
                            }
                            echo "<th>Result</th>";
                         }
                         else{
                             echo "We have a problem !";
                         }
                         echo "</thead>";

                        $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from gresult where gid = '".$exam1['gid']."'";
                        $responce_student = mysqli_query($dbcon, $st_query) or die(mysqli_error());
                        
                       while($st_result = mysqli_fetch_array($responce_student)){
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                            $total = 0;
                            echo "<td class=$st_id data-id=$st_id>".$st_id."</td>";
                            $query_gid = "select * from grade where Id= ".$id['Id'];
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                            $query_gid3 = "select * from grade where Id= ".$id['Id'];
                            $responce_gid3 = mysqli_query($dbcon, $query_gid3) or die(mysqli_error());
                            $percentage=0;
                             if($calculation_percentage=="Current"){$percentage=100;}
                             else{
                            while($exam3 = mysqli_fetch_array($responce_gid3)){
                                $percentage+=(int)$exam3['Percentage'];
                                }
                             }
                            
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select * from gresult where gid='". $exam2['gid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['gid'];
                                 try{
                                   if($exam2['is_final']){
                                      $is_final+=$grade['Result']; 
                                   }  
                                     
                                 /*Grade Calculation*/
                                 $query_for_percentage = "Select * From grade Where gid = '".$exam2['gid']."';";
                                 $result_for_percentage = mysqli_query($dbcon,$query_for_percentage);
                                 $row_result_percentage = mysqli_fetch_array($result_for_percentage);
                                     
                                 
                                 $total += ($bcd*$row_result_percentage['Percentage'])/$percentage;
                                 } catch (Exception $ex) {
                                     echo $ex;
                                 }
                                 
                                 echo "<td class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>";
                             }
                             $total1 = round($total);
                             /*Scala Bilgisini çekicez*/
                             $query_scala = "Select * From scale where ScaleId=".$id['cid'];
                             $result_scale = mysqli_query($dbcon , $query_scala);
                             $row_scale = mysqli_fetch_array($result_scale);
                             $flag = 1;
              
                             
                             
                while($row_scale['grade'.$flag]!=-1){
                $flag++;
                 }
                 $gradess="";
                 $min=1000;
                 $loc=1;
                 $j=1;
                 $min_final=1000;
                 $loc_final=0;
                             for($i=1;$i<$flag;$i++){
                                 
                                if( $is_final<$row_scale['fcondition']){
                                       while($row_scale['grade'.$j]!=-1){
                                     if($row_scale['res'.$j]<$min_final){
                                         $loc_final*=0;
                                         $min_final=$row_scale['res'.$j];
                                         $loc_final+=$j;
                                     
                                     }  
                                    $j++;
                                   
                                     $loc*=0;
                                       
                                        $loc+=$loc_final;
                                     }
                                }
                                 else{
                                 $rs="res".$i;
                                
                                
                                $first = $row_scale[$rs];
                                
                                $ssss = "grade".$i;
                                $gradess = $row_scale[$ssss];
                                if($total1 >=$row_scale[$rs]){
                                    if($row_scale[$rs]-$total==0){
                                     $loc+=$i;
                                        $i=$flag;
                                    }
                                    elseif((($row_scale[$rs]-$total1)*-1)<$min ){
                                        $loc*=0;
                                        $min=($total1-$row_scale[$rs])*-1;
                                        $loc+=$i;
                                    }     
                                }
                             }
                             } 
                             $gradess = $row_scale["grade".$loc];
                                echo "<td>$gradess</td>";
                                   
                                  

                             
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                     
                               $button_id="Save";
                     echo "<button class=$button_id>Save</button>"; 
                    echo "</div>";
                    
                    
                }
                
                //with attendance
                else{
                    $is_final=0;
                    if($attendance_percentage <0 || $attendance_percentage>100 || $attendance_percentage==null){
                        echo "Wrong Percentage !\nPlease Try Again !";
                    }
                    else {
                        $div_id = "bas";
                        echo "<div class = $div_id>";
                        $table_id = "asd";
                        $cell = "1";
                        echo "<table id=$table_id cellspacing=$cell><caption>Grade Table</caption><thead>";
                        
                        $query_id = "select * from dog where Id = ".$_SESSION['catordog_id'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                        $id = mysqli_fetch_array($responce_id);
                         $query_gid3 = "select * from grade where Id= ".$id['Id'];
                            $responce_gid3 = mysqli_query($dbcon, $query_gid3) or die(mysqli_error());
                            $percentage=0;
                          if($calculation_percentage=="Current"){$percentage=100;}
                             else{
                            while($exam3 = mysqli_fetch_array($responce_gid3)){
                                $percentage+=(int)$exam3['Percentage'];
                            }
                            $percentage+=$attendance_percentage;
                             }
                        
                        $query_gid = "select * from grade where Id= ".$_SESSION['catordog_id'];
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['gid'];
                                 echo "<th class=$clas>".$exam['gName']."<br>".$exam['Percentage']."%</th>";
                                 $empty_rows++;
                            }
                            echo "<th>Attent<br>$attendance_percentage%</th>";
                            echo "<th>Result</th>";
                         }
                         else{
                             echo "We have a problem !";
                         }
                         echo "</thead>";

                        $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from gresult where gid = '".$exam1['gid']."'";
                        $responce_student = mysqli_query($dbcon, $st_query) or die(mysqli_error());
                        
                       while($st_result = mysqli_fetch_array($responce_student)){
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                            $total = 0;
                            echo "<td class=$st_id data-id=$st_id>".$st_id."</td>";
                            $query_gid = "select * from grade where Id= ".$id['Id'];
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                
                                 $query_result= mysqli_query($dbcon,"Select * from gresult where gid='". $exam2['gid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['gid'];
                                  if($exam2['is_final']){
                                      $is_final+=$grade['Result']; 
                                      
                                   }  
                                  echo "<td class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>";
                                  
                                  
                                 
                                 
                                 try{
                                 $query_for_percentage = "Select * From grade Where gid = '".$exam2['gid']."';";
                                 $result_for_percentage = mysqli_query($dbcon,$query_for_percentage);
                                 $row_result_percentage = mysqli_fetch_array($result_for_percentage);
                                 $total += ($bcd*$row_result_percentage['Percentage'])/$percentage;
                                 } catch (Exception $ex) {
                                     echo $ex;
                                 }
                                 
                                 
                             }
                                 try{  
                                 $st_id1 = $st_result['sid'];
                                 $query_for_course = mysqli_query($dbcon,"Select cid From dog Where Id = ".$_SESSION['catordog_id']);
                                 $result_for_course = mysqli_fetch_array($query_for_course);
                                 
                                 
                                 $search_for_attendance_section = mysqli_query($dbcon,"Select Id From cat where cid =".$result_for_course['cid']);
                                 while($row_for_cat = mysqli_fetch_array($search_for_attendance_section)){
                                     $flag1 = 0;
                                     $query_for_attendance = mysqli_query($dbcon,"Select aid From attendance where Id = ".$row_for_cat['Id']);
                                     $result_aid = mysqli_fetch_array($query_for_attendance);
                                     $number_of_comes = 0;
                                     $attendance_result=0;
                                     $query_for_atresult = mysqli_query($dbcon , "Select * From atresult where aid = '".$result_aid['aid']."' AND sid=".$st_id1);
                                     if(mysqli_num_rows($query_for_atresult)>0){
                                         $flag1 = 1;
                                         $total_at = 0;
                                         $query__attendance = mysqli_query($dbcon,"Select aid From attendance where Id = ".$row_for_cat['Id']);
                                         while($all_aid = mysqli_fetch_array($query__attendance)){
                                             $query_result_at = mysqli_query($dbcon, "Select * From atresult where sid=".$st_id1." AND aid='".$all_aid['aid']."'");
                                             $row_result = mysqli_fetch_array($query_result_at);
                                             if($row_result['Result'] == 1 || $row_result['Result'] == true){
                                                 $number_of_comes++;
                                             }
                                             $total_at++;
                                         }
                                         $attendance_result = ($number_of_comes/$total_at)*100;
                                         echo "<td>$attendance_result</td>";
                                         break;
                                     }
                                     
                                 }
                                 if($flag1 == 0){
                                     echo "<td>0</td>";
                                  }
                                 } 
                                 catch (Exception $ex) {
                                     echo $ex;
                                 }
                                 $query_sc = "Select * From scale where ScaleId =".$id['cid'];
                                 $result_sc = mysqli_query($dbcon , $query_sc);
                                 $row_sc = mysqli_fetch_array($result_sc);
                                  $total += ($attendance_percentage * $attendance_result)/$percentage; 
                                 $total1 = round($total);
                                
                                 $total2 = round($total1);
                             
                                 if($attendance_result < (int)$row_sc['NG']){
                                 echo "<td>NG</td>"; 
                             }
                             else{
                                    
                                    $query_scala = "Select * From scale where ScaleId =".$id['cid'];
                                    $result_scale = mysqli_query($dbcon , $query_scala);
                                    $row_scale = mysqli_fetch_array($result_scale);
                                    $flag = 1;
                                    while($row_scale['grade'.$flag]!=-1){
                                             $flag++;
                                              }
                                              $gradess="";
                                              $min=1000;
                                              $loc=1;
                                              $j=1;
                                              $min_final=1000;
                                              $loc_final=0;
                             for($i=1;$i<$flag;$i++){
                                 
                                if( $is_final<$row_scale['fcondition']){
                                  
                                    while($row_scale['grade'.$j]!=-1){
                                     if($row_scale['res'.$j]<$min_final){
                                         $loc_final*=0;
                                         $min_final=$row_scale['res'.$j];
                                         $loc_final+=$j;
                                     
                                     }  
                                    $j++;
                                    $gradess=$row_scale['grade'.$loc_final];
                                     $loc*=0;
                                       
                                        $loc+=$loc_final;
                                     }
                                   
                                    $i=$flag;
                                }
                                 else{
                                 $rs="res".$i;
                                
                                $first = $row_scale[$rs];
                                
                                $ssss = "grade".$i;
                                $gradess = $row_scale[$ssss];
                                if($total1 >=$row_scale[$rs]){
                                    if($row_scale[$rs]-$total==0){
                                     $loc+=$i;
                                        $i=$flag;
                                    }
                                    elseif((($row_scale[$rs]-$total1)*-1)<$min ){
                                        $loc*=0;
                                        $min=($total1-$row_scale[$rs])*-1;
                                        $loc+=$i;
                                    }     
                                }
                             }
                             } 
                                $gradess = $row_scale["grade".$loc];
                                echo "<td>$gradess</td>";
                             

                             }
                             
                            echo "</tr>"; 
                         }
                        
                       echo "</table>";
                        
                      $class_name = "submit_button";
                      echo "<button class= $class_name>Save It.</button>"; 
                      
                    echo "</div>";
              }
                    
                    
                    
        }
                
                
 }
        ?>
        
    </div> 


    <div class="Footer">
        <div class="social">
          <a href="#" class="support">Contact Us</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
</body>
</html>
