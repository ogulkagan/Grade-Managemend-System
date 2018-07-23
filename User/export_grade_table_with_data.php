<?php
    include_once '../connection.php';
    session_start();
    include 'User_control.php';
    include 'Section_control.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <link href="../CSS/bootstrap.min_1.css" rel="stylesheet" type="text/css"/>
        <link href="../CSS/tableexport.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <style>
            .first{
                margin-left:25%;
            }
            .export{
                  margin:120px auto;
                  margin-left:30%;
              }
              .Content{
                  width:100%;
                  min-height: 600px;
                  height: 100%;
              }
            .bas table{
                max-width: 960px;
                margin: 0px auto;
                border: none;
                color:#FFF;
              }
              .bas caption {
                font-size: 1.6em;
                font-weight: 400;
                color:#bf2d3a;;
                margin-top:30px;
                margin-bottom:20px;
              }
              #asd tr{
                  border-bottom: 5px solid red;
              }
              .bas thead th {
                font-weight: 400;
                background-color: #bf2d3a;
                color: #FFF;
              }
              .bas td{
                  background-color: #2C353C;
                  max-width: 100px;
                  max-height: 50px;
              }
              .bas th, td {
                text-align: center;
                padding: 20px 25px;
                font-weight: 300;
                max-width: 80px;
                max-height: 40px;
                overflow: auto;
              }
              .bas table.fixed { table-layout:fixed; }
              .bas table.fixed td { overflow: hidden; }
        </style>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Export Table</title>
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
<div class ="Content">
    <div class="bas"> 
    <?php
        
                    $p = "print";
                    echo "<div class=$p>";
                    $at_section = $_SESSION['catordog_id'];
                    $query = "Select * From attendance where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysql_error());
                    $fetch=mysqli_fetch_array($responce_attendace);
                    $aid = $fetch['aid'];
                    $query1 = "Select * From atresult where aid = '".$aid."'";
                    $responce_null = mysqli_query($dbcon, $query1) or die(mysql_error());
                   
                    $border = "1";
                    $table_id = "result2";
                    $class_table = "table table-bordered";
                    $cell = "0";
                    echo "<table class = $class_table id=$table_id border=$border><caption></caption><thead>";

                   $query_id = "select * from dog where Id = ".$_SESSION['catordog_id'].";";
                    $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                    $id = mysqli_fetch_array($responce_id);

                    $query_gid = "select * from grade where Id= ".$_SESSION['catordog_id'];
                    $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                    $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                    echo "<th>Student ID</th>";
                    echo "<th>Name</th>";
                    echo "<th>Surname</th>";
                   
                   while($exam = mysqli_fetch_array($responce_gid)){
                         $clas = $exam['gid'];
                         echo "<th class=$clas>".$exam['gName']."</th>";
                    }
                   echo "</thead>";

                     $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from gresult where gid = '".$exam1['gid']."'";
                        $responce_student = mysqli_query($dbcon, $st_query) or die(mysqli_error());
                        
                       while($st_result = mysqli_fetch_array($responce_student)){
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                            echo "<td class=$st_id data-id=$st_id>".$st_id."</td>";
                            $query_for_name = mysqli_query($dbcon , "Select * from student where sid =".$st_id);
                            $name = mysqli_fetch_array($query_for_name);
                            echo "<td>".$name['sName']."</td>";
                            echo "<td>".$name['sSurname']."</td>";
                            $query_gid = "select * from grade where Id= ".$id['Id'];
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select * from gresult where gid='". $exam2['gid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['gid'];
                                 echo "<td contenteditable='true' class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>";
                             }
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                  
            
            echo "</div>"
         ?>
        <div class="export">
            <script src="../JS/FileSaver.min.js" type="text/javascript"></script>
            <script src="../JS/bootstrap.min_1.js" type="text/javascript"></script>
            <script src="../JS/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="../JS/jquery.base64.js" type="text/javascript"></script>
            <script src="../JS/tableexport.min.js" type="text/javascript"></script>
            <script>
                    $('#result2').tableExport();
            </script>
        </div>
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
