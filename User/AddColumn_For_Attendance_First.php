<?php
    include_once '../connection.php';
    session_start();
   include 'User_control.php';
   include 'Section_control.php';
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
                    $(".submit_button").click(function(){
                        var date = document.getElementById("s_Date").value;
                        alert(date);
                        $.post("Add_Column_For_Attendance.php",{At_date:date},function(data){alert(data);});
                        
                  });
           });      
        </script>
        
        <style>
              .Content{
		min-height:800px;
                position:relative;
                width:100%;
                display:block;
                margin:auto;
                background-color: rgba(247,239,239,0.8);
                background-image: url("../images/llow Coast.png");
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: 20%;
              }
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
            }
            *{
                margin: 0px;
              }
              body{
                font-family: 'Lato', sans-serif;
                background-color:#374049;
                background-repeat:repeat;
              }
 		body::-webkit-scrollbar-track
                {
                        -webkit-box-shadow: inset 0 0 6px rgb(49,57,64);
                        border-radius: 10px;
                        background-color: rgba(49,57,64,0);
                }

                body::-webkit-scrollbar
                {
                        width: 12px;
                        background-color: rgb(49,57,64);
                }

                body::-webkit-scrollbar-thumb
                {
                        border-radius: 10px;
                        -webkit-box-shadow: inset 0 0 6px rgb(49,57,64);
                        background-color: #D62929;
                }
                .delete_button{
                    position: relative;
                    display: block;
                    padding: 19px 39px 18px 39px;
                    color: #FFF;
                    margin: 0 auto;
                    background-color: #bf2d3a;
                    font-size: 18px;
                    text-align: center;
                    font-style: normal;
                    width: 100%;
                    border-bottom: 2px solid #2A333A;
                    border-width: 1px 1px 3px;
                    margin-bottom: 10px;
                }
           </style>
           <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>Add/Delete Column</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "At_Table.php";
            $class = "first";
            echo "<a href=$href id = $class>Return</a>";
            ?>
                <a class="first"href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href="../index.php" class="logout">Log Out</a>
        </div>
    </div>
    <div class="Content">
       <div class="form-style-5">
        <fieldset>
        <legend><span class="number">1</span>Add Column</legend>
        <label for=$isim >Pick A Date For Attendance:</label><input type="date" value="date" id="s_Date">
        <input type="button" value="Add Column" class="submit_button"/>
        
        <legend><span class="number">2</span>Delete Column</legend>
        <label for=$isim >Pick A Date For Delete:</label>
        <form method="POST" action="?"> 
            <?php
                if(isset($_SESSION['catordog_id'])){
                echo "<label for='job'>Date</label>";
                echo "<select id='delete' name='delete'>";
                $query = mysqli_query($dbcon , "Select * From attendance where Id = ".$_SESSION['catordog_id']." Order By atDate ASC ");
                while($row = mysqli_fetch_array($query)){
                    $aid = $row['aid'];
                    $at_date = $row['atDate'];
                     echo "<option value=$aid>$at_date</option>";
                    }
                echo "</select>"; 
             }         
         ?>
            <button type="submit" value="Delete Column" class="delete_button">Delete</button>
        </form>
      </div>  
    </div>
<?php
    if($_POST){
        $date = $_POST['delete'];
        $query_for_check = mysqli_query($dbcon, "Select * from attendance where Id='".$_SESSION['catordog_id']."'");
             $flag=0;
             while(mysqli_fetch_array($query_for_check)){
             $flag++;
             }
        if($flag!=1){
        $query_for_atresult_delete = mysqli_query($dbcon , "Delete From atresult where aid='".$date."';");
        $query_for_attendance_delete = mysqli_query($dbcon , "Delete From attendance where aid='".$date."';");
        $address = "AddColumn_For_Attendance_First.php";
        echo("<script>window.location.href = '$address';</script>");
        }
    }
?>
    <div class="Footer">
        <div class="social">
          <a href="#" class="support">Contact Us</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
</body>
</html>

