<?php
    session_start();
    include_once 'connection.php';
    include_once 'User_control.php';
    
    if($_SESSION['uName'] == 'admin@admin'){
        echo "<script type='text/javascript'>window.location.href = 'AdminPage.php';</script>"; exit;
    }
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
                 $name = $_SESSION["Name"];
                 $sname = $_SESSION["sName"];
                 $href = "EditAdmin.php";
                 $class = "first";
                 $active = "active";
                 echo "<a href=$href id = $class class = $active>WELCOME " .strtoupper($name)."</a>";
            ?>
           <a href="AdminPage.php" class="first">Home</a>
           <a href="AddLecturer.php" >Add Lecturer</a>
           <a href="Add_Info.php" >General Settings</a>
           <a href="DeleteLecturer.php" >Delete Lecturer</a>
           <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
           <a href = "../index.php" class="logout">Log Out</a>
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
