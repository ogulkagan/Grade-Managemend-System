<?php
    session_start();
    include_once 'User_control.php';
    include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script>
        $(document).ready(function() {
             $(".mission_button").click(function(){
                    var lecturer1 = $( "#lecturer1" ).val();;
                    var lecturer2 =  $( "#lecturer2" ).val();;
                    if(lecturer1 === lecturer2){
                        alert("Please Select Different Lecturers.");
                    }
                    else{
                        $.post('ChangeCourses.php',{first:lecturer1,second:lecturer2}, function(data){alert(data);});
                     
                    }
                    
                 });
       });
                  
       </script>
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
            h3{
                position:relative;
                display:block;
                margin:0px auto;
                color:yellow;
                font-size:28px;
            }
     </style>
            <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>Delete A Lecturer</title>
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
           <a href="AddLecturer.php" >Add Lecturer</a>
           <a href="Add_Info.php" >General Settings</a>
           <a href="DeleteLecturer.php" class = "active">Delete Lecturer</a>
           <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
           <a href = "../index.php" class="logout">Log Out</a>
       </div>
    </div>

    <div class="Content">
        <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
        <legend><span class="number">1</span>Select Lecturer For Delete</legend>
        <select id="lecturer" name="field1">
            <?php 
                if($_SESSION['uName'] != 'admin@admin'){
                     $query = "Select * From user where EMail !='admin@admin' AND IsAdmin = 0";
                     $result = mysqli_query($dbcon, $query);
                     while($row = mysqli_fetch_array($result)){
                        $value = $row['EMail'];
                         if($value != $_SESSION['uName']){
                              echo "<option value=$value>$value</option>";
                           }  
                         }
                }
                else{
                    $query = "Select * From user where EMail !='admin@admin'";
                    $result = mysqli_query($dbcon, $query);
                    while($row = mysqli_fetch_array($result)){
                        $value = $row['EMail'];
                         if($value != $_SESSION['uName']){
                              echo "<option value=$value>$value</option>";
                         }  
                    }
                }
            
                
            ?>
        </select>
        <input type="submit" value="Delete" class="pas_form"/>
        </form>
            
            
         <?php 
            if($_POST){
                $email = $_POST['field1'];
                $query = "Select * From course";
                $result_course = mysqli_query($dbcon, $query);
                $flag = 0;
                while($row = mysqli_fetch_array($result_course)){
                    $course_id = $row['cid'];
                    /*For Attendance*/
                    $query_for_course_attendance = "Select * From cat where cid=".$course_id;
                    $responce_cat = mysqli_query($dbcon, $query_for_course_attendance);
                    while($row_cat = mysqli_fetch_array($responce_cat)){
                        if($row_cat['eMail'] == $email){
                            $flag = 1;
                        }
                    }
                    /*For Grade*/
                    $query_for_course_grade = "Select * From dog where cid=".$course_id;
                    $responce_d = mysqli_query($dbcon, $query_for_course_grade);
                    while($row_d = mysqli_fetch_array($responce_d)){
                        if($row_d['eMail'] == $email){
                            $flag = 1;
                        }
                    }
                    
                }
                if($flag == 0){
                    $query_delete = "DELETE FROM user WHERE EMail='".$email."'";
                    $result_delete = mysqli_query($dbcon, $query_delete);
                    if($result_delete){
                        echo "<h3>Succesfully Deleted</h3>";
                    }
                    else{
                        echo "<h3>Please Try Again.</h3>";
                    }
                }
                else{
                    echo "<h3>He/She has given a course. You must clear these courses first.</h3>";
                }
                
            }
        ?>   
          <br><br>
        <form method="POST" action="?">
        <fieldset>
        <legend><span class="number">2</span>Pass Courses Between Lecturers</legend>
         <?php echo "<legend>FROM--</legend>"; ?>
        <select id="lecturer1" name="field1">
            <?php 
                $query = "Select * From user where EMail !='admin@admin' And IsAdmin = 0";
                $result = mysqli_query($dbcon, $query);
                while($row = mysqli_fetch_array($result)){
                    $value = $row['EMail'];
                    if($value != $_SESSION['uName'] && row['IsAdmin'] != 1){
                        echo "<option value=$value>$value</option>";
                    }  
                }
                
            ?>
        </select>
        <?php echo "<legend>To---</legend>"; ?>
        <select id="lecturer2" name="field2">
            <?php 
                $query = "Select * From user where EMail !='admin@admin' And IsAdmin = 0";
                $result = mysqli_query($dbcon, $query);
                while($row = mysqli_fetch_array($result)){
                    $value = $row['EMail'];
                    if($value != $_SESSION['uName'] && row['IsAdmin'] != 1){
                        echo "<option value=$value>$value</option>";
                    }  
                }
                
            ?>
        </select>
        <input type="button" value="Pass It." class="mission_button"/>
        
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
