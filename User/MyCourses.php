<?php
    session_start();
    include_once '../connection.php';
    include 'User_control.php';
    if(isset($_SESSION['catordog_id'])){
        unset($_SESSION['catordog_id']);
    }
    if(isset($_SESSION['stdid1'])){
        unset($_SESSION['stdid1']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".course h3").click(function(){
                    var field1 =  $(this).attr('class');
                    $.post("MyCourse.php",{cd:field1} ,function(){
                        window.location.href = 'Section.php';
                     });
                });  
           });    
       </script>
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
            .first{
                margin-left:15%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
            }
               ul.course {
                list-style-type: none;
                margin: auto;
                padding: 0%;
                overflow: hidden;
                background-color: rgba(247,239,239,0);
                }
               ul.course li.name{float:left; }
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
             
              .info{
                width:70%;
                margin:5%;
                margin-left:5%;
                
              }
              
              h3{
                color:#313940;
                margin:0;
                padding-bottom:20px;
                font-size:36px;
                font-weight:100;
                border-bottom:3px solid darkblue;
                cursor:pointer;
              }
              h1{
                  cursor:pointer;
                color:#313940;
                margin-left: 37.5%;
                margin-right: 37.5%;
                padding-top:1%;
                font-size:36px;
                font-weight:100;
              
               
              }
             li{
                 cursor:pointer;
             }
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>My Courses</title>
</head>
<body>
     <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "Change_Password.php";
            $class = "first";
            echo "<a href=$href id = $class>WELCOME " .strtoupper($ad['uName']);
            ?>
                <a class="first"  href="UserPage.php">Home</a>
                <a href="AddCourse.php">Add Course</a>
                <a href="MyCourses.php"  id = "active">My Courses</a>
                <a href="../index.php" class="logout">Log Out</a>
        </div>
    </div>

<div class="Content">
         <div class="bas">
             
               <?php
                    echo  "<h1>My Courses</h1>";
                   $ul_class="course";
            echo "<ul class=$ul_class>";
            
             $get_semester_query=mysqli_query($dbcon, "Select * from semester where sCurrent=1");
                $get_semester=mysqli_fetch_array($get_semester_query);
            $query2="Select DISTINCT cid From cat where Email='".$umail."'";
            $responce2=mysqli_query($dbcon, $query2);     
            $list_i = "listitem";
            $info="info";
            $proPic = "proPic";
            $src = "../images/man1.png"; 
           while($mycid=mysqli_fetch_array($responce2))
           {
                $mycources=mysqli_query($dbcon, "Select * from course where cid=".$mycid['cid']." and semesterid=".$get_semester['Id']);
                if(mysqli_num_rows($mycources)>0){
                $row2 = mysqli_fetch_array($mycources);
                
                $mysection=mysqli_query($dbcon,"Select * from cat where cid=".$row2['cid']);
                
                $row3=mysqli_fetch_array($mysection);
                    $cd = $row2['cid']; 
                    echo "<li class=$list_i>";
                    echo "<div class = $info>";
                   
                   
                    echo "<h3 class=$cd>".$row2['cName']." - ".$row2['ccode']."</h3>";
                    echo "</div></li>";
                  }
             }
             
             
             $flag=1;
            
             $querydog="Select DISTINCT cid From dog where Email='".$umail."'";
            $responcedog=mysqli_query($dbcon, $querydog);
             
             while($mycid_dog=mysqli_fetch_array($responcedog)){
                 $mycourcesdog=mysqli_query($dbcon, "Select * from course where cid=".$mycid_dog['cid']." and semesterid=".$get_semester['Id']);
                 if(mysqli_num_rows($mycourcesdog)>0){$rowdog = mysqli_fetch_array($mycourcesdog); $flag=1;
                 
                 
                  $query3="Select DISTINCT cid From cat where Email='".$umail."'";
            $responce3=mysqli_query($dbcon, $query3);
                 
                 while($mycid_cat=mysqli_fetch_array($responce3)){
                     
                     $mycourcescat=mysqli_query($dbcon, "Select * from course where cid=".$mycid_cat['cid']." and semesterid=".$get_semester['Id']);
                     
                  
                     if(mysqli_num_rows($mycourcescat)>0){
                $rowcat = mysqli_fetch_array($mycourcescat);
                
                if($rowcat['cid']==$rowdog['cid']){
                    
                    $flag*=0;
                }
               
                  }
                  
                 
                  
              }
              
               if($flag==1){
                   
                   $mysection=mysqli_query($dbcon,"Select * from dog where cid=".$mycid_dog['cid']);
                
                $row3=mysqli_fetch_array($mysection);
                    $cd = $rowdog['cid']; 
                    echo "<li class=$list_i>";
                    echo "<div class = $info>";
                   
                   
                    echo "<h3 class=$cd>".$rowdog['cName']." - ".$rowdog['ccode']."</h3>";
                    echo "</div></li>";
               }   
                }       
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