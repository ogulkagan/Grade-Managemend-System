<?php
session_start();
 if($_POST){
 $_SESSION['cat_idpast']=$_POST['ID'];}
 if(!isset($_SESSION['cat_idpast'])){
     header("Location: MyCoursepast.php");
 }
    include_once '../connection.php';
    include 'User_control.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       
         <script>
            $(document).ready(function() {
                $(".export_button").click(function(){
                    window.location.href = 'export_attendance_table_with_data_past.php';
                }); 
           });

        </script>
        
       <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
            
            <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1" /> 
                    
        
        <style>
              /*Table*/
            .bas table{
                max-width: 100%;
                margin: 0px auto;
                border: none;
                color:#FFF;
                overflow:visible;
                table-layout: fixed;  
              }
              .bas caption {
                font-size: 1.6em;
                font-weight: 400;
                color:#bf2d3a;
                margin-top:30px;
                margin-bottom:20px;
              }
              #asd{
                  overflow:scroll;
              }
              #asd tr{
                  border-bottom: 1px solid red;
              }
              .bas thead th {
                background-color: #bf2d3a;
                color: #FFF;
              }
              .bas td{
                  background-color: #2C353C;
                  max-width: 25px;
                  max-height: 20px;
              }
              .bas th, td {
                text-align: center;
                padding: 12px 13px;
                max-width: 20px;
                max-height: 5px;
                overflow: hidden;
                font-size:10px;
              }
              .bas table.fixed { table-layout:fixed; }
              .bas table.fixed td { overflow: hidden; }
              .submit_button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 2px;
                    cursor: pointer;
              }
              .export_button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 45%;
                    cursor: pointer;
                    }
              button.submit_button {
                margin: 10px auto;
                display: block;
                background-color: #2F383F;
              }
               
                #file{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 2px;
                    cursor: pointer;
                }
                .Content{
                    width: 100%;
                }
                /*Date Seçici*/
                  [type="date"] {
                    background:#bf2d3a url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
                    color:white;
                    font-size: 18px;
                  }
                  [type="date"]::-webkit-inner-spin-button {
                    display: none;
                  }
                  [type="date"]::-webkit-calendar-picker-indicator {
                    opacity: 0;
                  }
                  label {
                    display: block;
                  }
                  /*input{
                    border: 1px solid #c4c4c4;
                    border-radius: 5px;
                    background-color: #2C353C;
                    padding: 3px 5px;
                    box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
                    width: 100%;
                    min-height: 40px;
                  }*/
                  .s_Date{
                    font-size: 1.6em;
                    font-weight: 400;
                    color:#bf2d3a;
                    padding-top:20px;
                    margin-bottom:20px;
                  }
                  .date{
                      max-width: 40%;
                      margin: 0px auto;
                      border: none;
                      color:#FFF;
                      min-height: 80px;
                  }
                  .submit_date{
                    background-color: #bf2d3a; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: block;
                    font-size: 16px;
                    margin: 18px auto;
                    cursor: pointer;
                  }
                  .export_button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 45%;
                    cursor: pointer;
                    }
                  
                  /*Text Seçme Butonu*/
                 /*.file_button{
                    position: relative;
                    overflow: hidden;
                    background-color: black;
                  }*/
                  input[type=file] {
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    cursor: pointer;
                    width: 83%;
                  }
                  /*input[readonly] {
                   border: 1px solid #c4c4c4;
                    border-radius: 5px;
                    background-color: #2C353C;
                    padding: 3px 5px;
                    box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
                    width: 100%;
                    min-height: 40px;
                  }*/
                  
                  
                  
                 
                  
                .attdetail{
                    position: fixed;

                    left:0px;
                    top:30%;
                    width:10%;
                    height:40%;
                    background-color: rgba(191,45,58,0.8);
                 }
                .attdetail table{
                margin: 0px auto;
                border: none;
                color:#FFF;
                border-collapse:collapse;
                min-width: 90%;
                min-height: 50%;
                max-height: 60%;
                max-width: 100%;
              }
           
            .attdetail td{
                  background-color: #2C353C;
                  
                  text-align: center;
              
                overflow: hidden;
                font-size:10px;
              }
            .attdetail tr {
                text-align: center;
              
               
                overflow: hidden;
                font-size:10px;
              }
            
             
            h4{
                padding-top:10px;
                padding-left:9%;
                color:white;
                font-family:cursive;
                font-size: 14px;
            }
             .attdetail button{
                 background-color: #2F383F; 
                  border: none;
                    color: white;
                    padding: 5% 6%;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 8% 20%;
                    cursor: pointer;
                    margin-bottom: 0% ;
                    
              }
              .export{
                  margin:0px auto;
              }
             .s_detail{ 
                position: fixed;
                right:0px;
                top:30%;
                width:10%;
                height:40%;
                background-color: rgba(191,45,58,0.8);

            }
           .s_detail table{
                margin: 0px auto;
                border: none;
                color:#FFF;
                border-collapse:collapse;
                min-width: 90%;
                min-height: 50%;
                max-height: 60%;
                max-width: 100%;
              }
           
            .s_detail td{
                  background-color: #2C353C;
                  
                  text-align: center;
              
                overflow: hidden;
                font-size:10px;
              }
            .s_detail tr {
                text-align: center;
                overflow: hidden;
                font-size:10px;
              }
               .s_detail button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 5% 6%;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 8% 20%;
                    cursor: pointer;
                    margin-bottom: 0% ;
                  
              }
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
            }
            
           </style>
           
    <title>Attendance</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "MyCoursepast.php";
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
        <div style="overflow-x:auto;">
        <div class="bas"> 
           <?php
                if($_SESSION){
                    $at_section = $_SESSION['cat_idpast'];
                
                        $query = "Select * From attendance where Id=".$at_section;
                        $responce_attendace = mysqli_query($dbcon, $query) or die(mysql_error());
                        $fetch=mysqli_fetch_array($responce_attendace);
                        $aid = $fetch['aid'];
                        $query1 = "Select * From atresult where aid = '".$aid."'";
                        $responce_null = mysqli_query($dbcon, $query1) or die(mysql_error());
                        
                       
                        $table_id = "asd";
                        $cell = "1";
                        echo "<table id=$table_id cellspacing=$cell><caption>Attendance Table</caption><thead>";
                        
                        $query_id = "select * from cat where Id = ".$_SESSION['cat_idpast'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysql_error());
                        $id = mysqli_fetch_array($responce_id);
                        
                        $query_gid = "select * from attendance where Id= ".$_SESSION['cat_idpast']." Order By atDate ASC";
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['aid'];
                                 echo "<th class=$clas>".$exam['atDate']."</th>";
                                 $empty_rows++;
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
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                             
                            echo "<td data-id=$st_id >".$st_id."</td>";
                            $query_gid = "select * from attendance where Id= ".$id['Id']." Order By atDate ASC";
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysql_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select * from atresult where aid='". $exam2['aid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['aid'];
                                 if($bcd==0)
                                 {
                                 echo "<td  class=$asd data-id = $student_id data-exam = $exam_id>N</td>";
                                 }
                                 else
                                 {
                                   echo "<td  class=$asd data-id = $student_id data-exam = $exam_id>Y</td>";   
                                 }
                             }
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                     
                      
                    $class_name1 = "export_button";
                    echo "<button class= $class_name1>Export Table</button>";    
                       
               
                       
           }
          ?>
       
       
     </div>  
        
     </div>  
</div> 
    <div class="Footer">
        <div class="social">
          
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
</body>
</html>

