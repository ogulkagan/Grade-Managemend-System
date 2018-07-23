<?php
session_start();
include 'User_control.php';
?>
<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".bas h3").click(function(){
                    var type = $(this).attr("data-type");
                    var id = $(this).attr("class");
                    if(type === "cat")
                    {
                       $.post("At_Table_Past.php",{ID:id} ,function(){
                             window.location.href = 'At_Table_Past.php';});
                       
                    }
                    else{
                        $.post("GradeTable_Past.php",{ID:id} ,function(){
                             window.location.href = 'GradeTable_Past.php';});
                    }
                    
                    
                });   
                  
           });    
        </script> 
     
     
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
 <style>
             .first {
              background-color: rgb(49,57,64);
              color: white;
              position:static; 
             margin-left:5%;
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
            
            
            h2{
                color:#313940;
                margin:0;
                padding-top:5px;
                font-size:16px;
                font-weight:100;
                /*font-style:oblique;*/
              }
               #css{
                    background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    margin-left:10%;
                    cursor: pointer;
              }
              .li{
                  display:inline-block;
                  color:red;
              }
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
            }
             li{
                color:#313940;
                margin:2%;
                padding:20px;
                
                
                font-size:36px;
                font-weight:100;
               list-style:none;
               border-style: ridge;
               border-color:rgba(191, 45, 58,0.5);
  
              }
             
              
            
              #cname{
                  margin:auto;
                  padding-top:1%;
                  padding-left:30%;
                  color:#bf2d3a;
                  
              }
              #atgr{
                margin:auto;
                  padding-top:1%;
                  padding-left:0%;
                  text-shadow:  3px 4px rgba(181, 49, 49, 0.87);
                    color: #08084A;
                    
              }li{
                  cursor:pointer;
              }
                h3{
                color:#313940;
                font-size:36px;
                font-weight:100;
               
                  
              }
</style>
    <title>Past Course</title>
</head>
<body>
     <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            
    if($_POST){
$_SESSION['ciddpast']=$_POST['cd'];

}
    include_once '../connection.php';
     
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "UserPage.php";
            $class = "first";
            echo "<a href=$href id = $class>Return</a>";
            ?>
                <a class="first"  href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php">My Courses</a>
                <a href="../index.php" class="logout">Log Out</a>
        </div>
    </div>

    <div class="Content">
         <div class="bas">
         <?php
            $cid=$_SESSION['ciddpast'];
            $query_course="Select * From course where cid=".(integer)($cid);
            $response_course= mysqli_query($dbcon, $query_course);
            $course= mysqli_fetch_array($response_course);
            $cname="cname";
            echo "<h1 id=$cname>".$course['ccode']."------".$course['cName']."</h1>";
             
          ?>
         
          
          <div class="wrapper">
          <ul class="menu">
         <h1 id="atgr">Attendance</h1>
          <ul class="course">
            <?php
            
            $query_cat="Select * From cat where cid=".(integer)($cid);
           
            $responce_cat=mysqli_query($dbcon, $query_cat);
            
            while($rowcat = mysqli_fetch_array($responce_cat)){
                $query_nasu="Select * From user where EMail='".$rowcat['eMail']."'";
                $responce_nasu=mysqli_query($dbcon, $query_nasu);
                $rownasu = mysqli_fetch_array($responce_nasu);
                $type = "cat";
                $course_id=$rowcat['Id'];
                $section=$rowcat['section'];
                 echo "<li> <h3 data-type=$type class=$course_id data-section=$section>Section-" .$rowcat['section']. "  ".$rownasu['uName'] ."  ".$rownasu['uSurname']."</h3>";
             
                echo "</li>";
            }    
            ?>
             </ul>  
              <br>
           <h1 id="atgr">Grade</h1>
             <ul class="course">
            <?php
            $query_dog="Select * From dog where cid=".(integer)($cid);
            $responce_dog=mysqli_query($dbcon, $query_dog);
            
            while($rowdog = mysqli_fetch_array($responce_dog)){
                $query_nasu="Select * From user where EMail='".$rowdog['eMail']."'";
                $responce_nasu=mysqli_query($dbcon, $query_nasu);
                $rownasu = mysqli_fetch_array($responce_nasu);
                $type = "dog";
                $dog_id=$rowdog['Id'];
                $section=$rowdog['section'];
                
                
                  echo "<li> <h3 data-type=$type class=$dog_id data-section=$section>Section-".$rowdog['section']. "  ".$rownasu['uName'] ."  ".$rownasu['uSurname']."</h3>" ;
                
                echo "</li>";
                
            }    
            ?>
             </ul> 
          </ul>
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
