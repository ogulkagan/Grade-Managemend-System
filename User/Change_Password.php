<?php
    session_start();
    include_once '../connection.php';
    include_once 'User_control.php';
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Change Password</title>
    <style>
            .first {
              color: white;
              position:static; 
              margin-left:5%;
            }
            .active{
                background-color: #313940;
            }
            .pas_form{
                margin-bottom:20px;
            }
            
     </style>
            <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1" /> 
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
                <a class="first"href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href="../index.php" class="logout">Log Out</a>
        </div>
    </div>
<div class="Content">
    <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
        <legend><span class="number">1</span>Change Your Password</legend>
        <input type="text" name="field3" placeholder="Password *" maxlength="30">
        </fieldset>
            <input type="submit" value="Change Password" />
        </form>
        
        <?php 
        
        if($_POST){
             if ( empty($_POST["field3"])) {
                echo " PLEASE TRY AGAİN !";
              } 
              else {
                if(strlen($_POST["field3"]) < 8 )
                {
                    echo "<legend>The new password is too short.</legend>";
                }
                else{
                    $password = $_POST["field3"];
                    $query =  mysqli_query($dbcon,"Update user Set Password='".$password."' Where EMail='".$_SESSION['uName']."'");
                    echo "Successfully Changed.";

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
