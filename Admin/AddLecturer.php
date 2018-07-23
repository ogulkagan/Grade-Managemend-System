<?php
    include_once 'connection.php';
    session_start();
    include_once 'User_control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <title>ADD A LECTURER</title>
    <style>
            .first {
              color: white;
              position:static; 
              margin-left:5%;
            }
            .active{
                background-color: #313940;
            }
            p{
                font-size:20px;
                color:yellow;
                padding:10px;
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
                 $name = $_SESSION["Name"];
                 $sname = $_SESSION["sName"];
                 $href = "EditAdmin.php";
                 $class = "first";
                 echo "<a href=$href id = $class>WELCOME " .strtoupper($name)."</a>";
            ?>
           <a href="AdminPage.php" class="first">Home</a>
           <a href="AddLecturer.php" class = "active">Add Lecturer</a>
           <a href="Add_Info.php" >General Settings</a>
           <a href="DeleteLecturer.php">Delete Lecturer</a>
           <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
           <a href = "../index.php" class="logout">Log Out</a>
       </div>
    </div>

<div class="Content">
    <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
            
        <legend><span class="number">1</span>Lecturer Info</legend>
        <input type="email" name="field1" placeholder="E-Mail Adress *" maxlength="30">
            
       
            
        <input type="text" name="field3" placeholder="Name *" maxlength="30">
            
        <input type="text" name="field4" placeholder="Surname *" maxlength="30">
         <?php
                if($_SESSION['uName'] == "admin@admin"){
                echo "<label for='job'>Admin Autohorization ?</label>";
                echo "<select id='admin' name='field5'>
                <option value='1'>YES</option>
                <option value='0'>NO</option>
                </select>"; 
                }         
         ?>
            
        
        </fieldset>
            
        <fieldset>
        <legend><span class="number">2</span> Additional Informations</legend>
        <input type="text" name="field6" placeholder="Title" maxlength="30">
        <input type="text" name="field7" placeholder="Office No" maxlength="30">
        </fieldset>
        <input type="submit" value="ADD LECTURER" />
        </form>
    
    <?php 
        
        if($_POST){
             if (empty($_POST["field1"]) ||empty($_POST["field3"]) || empty($_POST["field4"])) {
                echo " TRY AGAİN !";
              } 
              else {
                $mail = $_POST["field1"];
                $password = $mail;
                $name = $_POST["field3"];
                $surname = $_POST["field4"];
                if(isset($_POST["field5"]))
                {
                    $isadmin = $_POST["field5"] ;
                }
                else{
                    $isadmin = 0;
                }
                $title = $_POST["field6"];
                $office = $_POST["field7"];
                
                if(!(is_numeric($mail))){
                    $query = mysqli_query($dbcon,"Select * From user");
                    $flag = 0;
                    while($row = mysqli_fetch_array($query)){
                        if($row['EMail'] == $mail){
                            $flag = 1;
                        }
                    }
                    if($flag == 0){
                        if($isadmin)
                        {
                         $query =  mysqli_query($dbcon,"INSERT INTO user (EMail, uName, uSurname, Office, IsAdmin,Password,Title) VALUES ('".$mail."','".$name."','".$surname."','".$office."' , 1 ,'".$password."','".$title."')");
                        }
                        else
                        {
                           $query =  mysqli_query($dbcon,"INSERT INTO user (EMail, uName, uSurname, Office, IsAdmin,Password,Title) VALUES ('".$mail."','".$name."','".$surname."','".$office."' , 0 , '".$password."','".$title."')");

                        }
                        echo "<p>Successfully Added.</p>";
                    }
                    else{
                        echo "<p>This E-Mail is using by some other user.</p>";
                    }
                }
                else{
                    echo "<p>Wrong İnput. Please Try Again !</p>";
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