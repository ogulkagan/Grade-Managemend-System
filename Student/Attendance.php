<?php
    session_start();
    include_once '../connection.php';
    include 'Student_Control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <style>
            .first {
              color: white;
              position:static; 
              margin-left:19%;
            }
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    
    <title>My Attendance Table</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
       <a href="MyCourse.php">Return</a>;
      <a href="MyPage.php" class="first">My Courses</a>
      <a href="EditStudent.php">My Settings</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      <a href="../index.php" class="logout">Log Out</a>
    </div>
    </div>
    <div class="Content">
        <div class="bas">
        <?php
               
                    $at_section = $_SESSION['catordog'];
                    $query = "Select * From attendance where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                    $fetch=mysqli_fetch_array($responce_attendace);
                    $aid = $fetch['aid'];
                    $query1 = "Select * From atresult where aid = '".$aid."'";
                    $responce_null = mysqli_query($dbcon, $query1) or die(mysqli_error());
                    //echo $at_section;
                   
                    $table_id = "asd";
                    $cell = "1";
                    echo "<table id=$table_id cellspacing=$cell><caption>Attendance Table</caption><thead>";

                    $query_id = "select Id from cat where Id = ".$_SESSION['catordog'].";";
                    $responce_id = mysqli_query($dbcon, $query_id) or die(mysql_error());
                    $id = mysqli_fetch_array($responce_id);

                    $query_gid = "select * from attendance where Id= ".$_SESSION['catordog']." Order By atDate ASC";
                    $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                    $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                    echo "<th>Student ID</th>";
                    if($responce_gid){
                       $empty_rows = 0;
                       while($exam = mysqli_fetch_array($responce_gid)){
                             $clas = $exam['aid'];
                             if($exam['Visible'] == 1){
                                 echo "<th class=$clas>".$exam['atDate']."</th>";
                                 $empty_rows++;
                             }  
                        }
                     }
                     else{
                         echo "We have a problem !";
                     }
                     echo "</thead>";

                    $exam1 = mysqli_fetch_array($responce_gid1);
                    $st_query = "select * from atresult where aid = '".$exam1['aid']."'";
                    $responce_student = mysqli_query($dbcon, $st_query) or die(mysql_error());

                   while($st_result = mysqli_fetch_array($responce_student)){
                       if($st_result['sid'] == $_SESSION['sid']){ 
                        echo "<tr>";
                        $st_id = $st_result['sid'];
                        echo "<td class=$st_id>".$st_id."</td>";
                        $query_gid = "select * from attendance where Id= ".$id['Id']." Order By atDate ASC";
                        $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                        while($exam2 = mysqli_fetch_array($responce_gid2)){
                             $query_result= mysqli_query($dbcon,"Select Result from atresult where aid='". $exam2['aid']."' and sid=".$st_result['sid']);
                             $grade= mysqli_fetch_array($query_result);
                             $asd=$st_result['sid'];
                             $bcd=$grade['Result'];
                             $student_id = $st_result['sid'];
                             $exam_id = $exam2['aid'];
                             if($exam2['Visible'] == 1){
                                 if($bcd==0)
                                    {

                                    echo "<td class=$asd data-id = $student_id data-exam = $exam_id>N</td>";
                                    }
                                    else
                                    {
                                      echo "<td class=$asd data-id = $student_id data-exam = $exam_id>Y</td>";   
                                    }
                             }
                         }
                        echo "</tr>";   

                          } 
                      }
                       echo "</table>";
                   
                       
               
                       
           
          ?>
      </div>
    </div>
        
    <div class="Footer">
        <div class="social">
          <a href="#" class="support">Contact Us</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
</body>
</html>

