<?php
session_start();
include 'User_control.php';
include 'Section_control.php';
include 'student_control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
            
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       
         <script>
            $(document).ready(function() {
                $("#student_delete_button").click(function(){
                     $.post("DeleteStudent.php",function(){window.location.href = 'GradeTable.php';}); 
                });
                
                $("#student_button").click(function(){
                 $("#merhaba tr").each(function(){
                    var dnam=$(this).find("td:eq(0)").text(); // get current row 1st TD value
                    var dnum=$(this).find("td:eq(1)").text(); // get current row 2nd TD
                
                   $.post("ChangeStudentforat.php",{dname:dnam,dnumber:dnum});
                   });
                   alert("Successfull .");
                });
           });

        </script>
        <link href="../CSS/GeneralSettings.css" rel="stylesheet" type="text/css"/>
        <style>
              .Content{
                width:75%;
                height:800px;
                display:block;
                margin:auto;
                background-color: rgba(247,239,239,0.8);
                z-index:-1;
                background-image: url("../images/editgau.png");
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: 20%;
              }
            .first {
              color: white;
              position:static; 
              margin-left:25%;
            }
            .active{
                background-color: #313940;
            }
            .submit_button{
                
                background-color: #2F383F; 
                border: none;
                color: white;
                padding: 15px 32px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 16px;
                margin:5px 45%;
                cursor: pointer;
              
              }
              h4{
                  color:red;
                  margin-bottom:8px;
                  font-size:28px;
                  width: 100%;
                  text-align: center;
              }
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    
    
    <title>Student's Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
             include '../connection.php';
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "GradeTable.php";
            $class = "first";
            $asd = "<<Return";
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
                    include '../connection.php';
                    echo "<div class = 'bas'>";
                    echo "<h4>Student Details</h4>";
                    $stdid = $_SESSION['stdid1'];
                    $query_student = "select * from student where sid=".$stdid;
                    $responce_student = mysqli_query($dbcon, $query_student) or die(mysqli_error());
                    $student= mysqli_fetch_array($responce_student);
                    
                    $tableclass="merhaba";
                    echo "<table id=$tableclass>";

                    echo "<tr>";
                    echo "<td>Id</td><td class = '$stdid'>".$student['Sid']."</td>";
                    echo "</tr>";
                    
                    echo "<tr>";
                    echo "<td>Name</td>"."<td  contenteditable='true'>".$student['sName']."</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Surname</td>"."<td  contenteditable='true'>".$student['sSurname']."</td>";
                    echo "</tr>";
                    
                    echo "</table>";
                    $class_name2 = "student_button";
                    $class_name3 = "student_delete_button";
                    echo "<button id= $class_name2 class = 'submit_button'>Save It.</button>";
                    echo "<button id= $class_name3 class = 'submit_button'>Delete It.</button>";
                    echo "</div>";
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
