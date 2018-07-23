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
    <title>Add Course</title>
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
            
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
</head>
<title>AddCourse</title>
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
                <a class="first"href="UserPage.php">Home</a>
                <a href="AddCourse.php" id = "active">Add Course</a>
                <a href="MyCourses.php" >My Courses</a>
                <a href="../index.php" class="logout">Log Out</a>
        </div>
    </div>

<div class="Content">
    <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
            
        <legend><span class="number">1</span>Course Info</legend>
        <input type="text" name="field1" placeholder="Course Name*" maxlength="20">
            
        <input type="text" name="field2" placeholder="Course Code*" maxlength="10">
            
        <input type="text" name="field3" placeholder="Section*" maxlength="2">
            <input type="submit" value="ADD Course" />
            <?php 
        
        if($_POST){
             if (empty($_POST["field1"]) || empty($_POST["field2"]) ||empty($_POST["field3"]) || is_numeric($_POST["field1"]) || !is_numeric($_POST["field3"])) {
                echo "Wrong Input Please Try Again!";
              } 
              else {
                  
                  
                  
                $coursename = $_POST["field1"];
                $coursecode = $_POST["field2"];
                $section = $_POST["field3"];
                
                
                
            $umail = $_SESSION["uName"];
            $semesterquery = "Select * from semester where sCurrent=1";
            $responces = mysqli_query($dbcon, $semesterquery);
            $semester= mysqli_fetch_array($responces);
            $checkquery="select * from course where (cName='".$coursename."' or ccode='".$coursecode."')and semesterid=".$semester['Id'] ;
            $check= mysqli_query($dbcon,$checkquery)or die(mysqli_error());
            $flag=0;
             while($rowa = mysqli_fetch_array($check)){
                   $flag=$flag+1;
                    
                }    
            
            if($flag>0)
            {
                echo "We have already have this Course.";
            }
            
            else
            {
            $queryco =  mysqli_query($dbcon,"INSERT INTO course (cName,  semesterid, ccode,admin_mail) VALUES ('".$coursename."',".$semester['Id'].",'".$coursecode."','".$_SESSION["uName"]."')");
            $cid_query=mysqli_query($dbcon,"Select cid from course where cName='".$coursename."' and semesterid=".$semester['Id']);
            $cid= mysqli_fetch_array($cid_query);
            $cat = mysqli_query($dbcon,"INSERT INTO cat (EMail, Cid, Section) VALUES ('".$umail."',".$cid['cid'].",".$section.")");
            $dog = mysqli_query($dbcon,"INSERT INTO dog (EMail, Cid, Section) VALUES ('".$umail."',".$cid['cid'].",".$section.")");  
            
            $scale_query= mysqli_query($dbcon,"Select * from scale where ScaleId='Def'");
            $defscale=mysqli_fetch_array($scale_query);
            
                $scale=mysqli_query($dbcon,"INSERT INTO scale(ScaleId, grade1, res1, grade2, res2, grade3, res3, grade4, res4, grade5, res5, grade6, res6, grade7, res7, grade8, res8, grade9, res9, grade10, res10, grade11, res11, grade12, res12, grade13, res13, grade14, res14, grade15, res15, NG, fcondition) VALUES ('".$cid['cid']."','".$defscale['grade1']."',".$defscale['res1'].",'".$defscale['grade2']."',".$defscale['res2'].",'".$defscale['grade3']."',".$defscale['res3'].",'".$defscale['grade4']."',".$defscale['res4'].",'".$defscale['grade5']."',".$defscale['res5'].",'".$defscale['grade6']."',".$defscale['res6'].",'".$defscale['grade7']."',".$defscale['res7'].",'".$defscale['grade8']."',".$defscale['res8'].",'".$defscale['grade9']."',".$defscale['res9'].",'".$defscale['grade10']."',".$defscale['res10'].",'".$defscale['grade11']."',".$defscale['res11'].",'".$defscale['grade12']."',".$defscale['res12'].",'".$defscale['grade13']."',".$defscale['res13'].",'".$defscale['grade14']."',".$defscale['res14'].",'".$defscale['grade15']."',".$defscale['res15'].",".$defscale['NG'].",".$defscale['fcondition'].")");
           
                   echo "Successfully Added.";
             
            
            }   
             
            


            }
            
        }
       
    ?>
            </form>
       
    
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
