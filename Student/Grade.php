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
    <title>My Grades</title>
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
                if($_SESSION){
                    $at_section = $_SESSION['catordog'];
                    $query = "Select * From grade where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysql_error());
                    $fetch=mysqli_fetch_array($responce_attendace);
                    $aid = $fetch['gid'];
                    $query1 = "Select * From gresult where gid = '".$aid."'";
                    $responce_null = mysqli_query($dbcon, $query1) or die(mysqli_error());
                    //echo $at_section;
                    if(mysqli_num_rows($responce_null) >= 1)
                    { 
                    
                    $table_id = "asd";
                    $cell = "1";
                    echo "<table id=$table_id cellspacing=$cell><caption>My Grade Table</caption><thead>";

                    $query_id = "select Id from dog where Id = ".$_SESSION['catordog'].";";
                    $responce_id = mysqli_query($dbcon, $query_id) or die(mysql_error());
                    $id = mysqli_fetch_array($responce_id);

                    $query_gid = "select * from grade where id= ".$_SESSION['catordog'];
                    $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                    $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                    echo "<th>Student ID</th>";
                    if($responce_gid){
                       $empty_rows = 0;
                       while($exam = mysqli_fetch_array($responce_gid)){
                           $clas = $exam['gid'];
                           if($exam['Visible'] == 1){
                                echo "<th class=$clas>".$exam['gName']."</th>";
                                $empty_rows++; 
                           }  
                        }
                        echo "<th>Result</th>";
                     }
                     else{
                         echo "You cannot see";
                     }
                     echo "</thead>";

                    $exam1 = mysqli_fetch_array($responce_gid1);
                    $st_query = "select * from gresult where gid = '".$exam1['gid']."'";
                    $responce_student = mysqli_query($dbcon, $st_query) or die(mysql_error());

                   while($st_result = mysqli_fetch_array($responce_student)){
                        echo "<tr>";
                        $st_id = $st_result['sid'];
                        if($st_id == $_SESSION['sid']){
                            echo "<td class=$st_id data-id=$st_id>".$st_id."</td>";
                            $query_gid = "select * from grade where id= ".$id['Id'];
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select result from gresult where gid='". $exam2['gid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['gid'];
                                 if($exam2['Visible'] == 1){
                                    echo "<td  class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>"; 
                                 }
                                
                             }
                             $query_cid = "select cid from dog where Id = ".$_SESSION['catordog'].";";
                                $responce_cid = mysqli_query($dbcon, $query_cid) or die(mysql_error());
                                $cid=mysqli_fetch_array($responce_cid);
                                $query_result = "select * from cresult where sid=".$st_id." and cid=".$cid['cid'];
                                $responce_result= mysqli_query($dbcon, $query_result) or die(mysql_error());
                                $result=mysqli_fetch_array($responce_result);
                                echo "<td>".$result['alp']."</td>";
                            
                            echo "</tr>"; 
                           
                        }
                          

                     }

                  }
                  echo "</table>";
                           
           }
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
