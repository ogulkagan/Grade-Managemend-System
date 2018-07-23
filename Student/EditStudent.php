<?php
    session_start();
    include_once '../connection.php';
    include 'Student_Control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>Change Information</title>
    <style>
            .first {
              color: white;
              position:static; 
              margin-left:15%;
            }
            .active{
                background-color: #313940;
            }
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
</head>

<body>
   <div class="nav"> 
        <div class="topnav" id="myTopnav">
       <?php
            $id = $_SESSION["sid"];
            $query = mysqli_query($dbcon, "Select * From student Where Sid=".$id.";");
            $row = mysqli_fetch_array($query);
            $class = "first";
            echo "<a id = $class>WELCOME " .strtoupper($row['sName']). " ".strtoupper($row['sSurname'])."</a>";
       ?>
      <a href="MyPage.php" class="first">My Courses</a>
      <a href="EditStudent.php" class = "active">My Settings</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      <a href="../index.php" class="logout">Log Out</a>
    </div>
    </div>

<div class="Content">
    <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
            
        <legend><span class="number">1</span>Change Your Informations</legend>  
        <input type="text" name="field2" placeholder="Password*">
            
        <input type="text" name="field3" placeholder="Name *">
            
        <input type="text" name="field4" placeholder="Surname *">
        </fieldset>
        <input type="submit" value="Change Informations" />
        </form>
    <?php 
        
        if($_POST){
             if ( empty($_POST["field2"]) ||empty($_POST["field3"]) || empty($_POST["field4"])) {
                echo "Please Fill All Of The Fields!";
              } 
              else {
                $password = $_POST["field2"];
                $name = $_POST["field3"];
                $surname = $_POST["field4"];
                $sid = $_SESSION['sid'];
                $query =  mysqli_query($dbcon,"UPDATE `student` SET `sName`='$name',`sSurname`='$surname',`password`='$password' WHERE sid = ".$_SESSION['sid']);
                
                header("Location: MyPage.php");
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
