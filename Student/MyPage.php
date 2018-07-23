<?php
    session_start();
    include_once '../connection.php';
    include 'Student_Control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
        
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script>
        $(document).ready(function() {
            $(".Content h3").click(function(){
                 var cid = $(this).attr('data-cid');
                 //alert(cid);
                 $.post("cid_session.php",{cd:cid},function(){
                                                window.location.href = 'MyCourse.php';});
             });  
       });        
       </script>
       
       <style>
            .first {
              background-color: rgb(49,57,64);
              color: white;
              position:static; 
              margin-left:17%;
            }
            h3{
                border-bottom:3px solid #313940;
                cursor: pointer;
                font-family: times, Times New Roman, times-roman, georgia, serif;
                color: #444;
                margin-bottom: 8px;
                padding: 0px 0px 9px 0px;
                font-size: 45px;
                line-height: 44px;
                letter-spacing: -2px;
                font-weight: bold;
              }
              h2{
                color:#313940;
                margin:0;
                padding-top:5px;
                font-size:16px;
                font-weight:100;
                cursor: pointer;
              }
              /*Lİst*/
              .wrapper{
                width:80%;
                margin:0px auto;
              }

              .menu ul{
                margin:0px;
                padding:0px;
                list-style:none;
              }
              .menu li{
                  padding:20px;
                  margin-bottom:7px;
              }
              .proPic,img{
                display:inline-block;
                width:80px;
                height:80px;
              }
              .info{
                width:75%;
                margin:0;
                margin-left:5%;
                display:inline-block;
              }
              
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    
    <title>My Page</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
       <?php
            $id = $_SESSION["sid"];
            $query = mysqli_query($dbcon, "Select * From student Where Sid=".$id.";");
            $row = mysqli_fetch_array($query);
            $class = "first";
            echo "<a id = $class>WELCOME " .strtoupper($row['sName'])."</a>";
       ?>
      <a href="MyPage.php" class="first">My Courses</a>
      <a href="EditStudent.php">My Settings</a>
       <a href="../index.php" class="logout">Log Out</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
     
    </div>
    </div>

    

    <div class="Content">
        <?php
        /*Current Semester*/
        $query_semester = mysqli_query($dbcon, "Select * From semester Where sCurrent = 1");
        $result_semester = mysqli_fetch_array($query_semester);
        $_SESSION['semester_id'] = $result_semester['Id'];
        echo "<h1>".$result_semester['Mevsim']."  ".$result_semester['sYear']."</h1>";
        /*Bu dönemki dersler listelenecek*/
        $query1 = mysqli_query($dbcon, "Select * From cresult Where sid = ".$_SESSION['sid']);
        if(mysqli_num_rows($query1) !=0)
        {
            echo "<legend>MY Courses</legend>";
            echo "<ul class = 'menu'>";
            while($row = mysqli_fetch_array($query1)){
                /*Course Informations*/
                $query_course = mysqli_query($dbcon, "Select * From course Where cid = ".$row['cid']." AND semesterid = ".$_SESSION['semester_id']);
                if(mysqli_num_rows($query_course) !=0)
                {   
                   $list_i = "listitem";
                   $proPic = "proPic";
                   $info = "info";
                   $src = "../images/man1.png"; 
                    $result_course = mysqli_fetch_array($query_course);
                    $course_name = $result_course['cName'];
                    $course_lecturer = $result_course['admin_mail'];
                    $query_for_lecturer = mysqli_query($dbcon , "Select * From user where eMail = '".$course_lecturer."';");
                    $row_name = mysqli_fetch_array($query_for_lecturer);
                    
                    $course_id = $row['cid'];
                    echo "<li class=$list_i><div class=$proPic><img src=$src></div>";
                    echo "<div class = $info>";
                    echo "<h3 class='listitem' data-cid = $course_id>".$course_name."</h3>";
                    echo "Given By :".$row_name['uName']." ".$row_name['uSurname'];
                    echo "</div></li>";
                    }
                    else{
                        echo "There is no course information for this semester for you.";
                    }
                
            }
            echo "</ul>";
        }
        else{
            echo "<h1>You Don't Have Any Course For This Semester.</h1>";
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
