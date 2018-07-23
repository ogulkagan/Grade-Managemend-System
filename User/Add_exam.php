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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                    $(".delete").click(function(){
                        var Gid = document.getElementById("delete").value;
                        var lenght = $('#delete option').length;
                        if(lenght !== 1){
                            $.post("DeleteGname.php",{gid:Gid},function(){
                            alert("Successfully Deleted.");
                            window.location.href = 'Add_exam.php';
                            });
                        }
                        else{
                            alert("You can't delete last column. Please create another exam and then try to delete it.");
                        }
                        
                  });
           });      
        </script>
        <style>
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
                .Content{
                    min-height:100%;
                    max-height:1000%;
                    width:80%;
                    display:block;
                    margin:auto;
                    background-color: rgba(247,239,239,0.8);
                    z-index:-1;
                    background-image: url("../images/editgau.png");
                    background-attachment: fixed;
                    background-position: center;
                    background-repeat: no-repeat;
                    background-size: 20%;
                  }
        </style>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    <title>Add Exam</title>
</head>
<body>
   <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "GradeTable.php";
            $class = "first";
            $asd = "Return";
            echo "<a href=$href id = $class>".$asd."</a>";
            $_SESSION['stdid']=0;
            $_SESSION['gid']="";
            ?>
                <a class="first"  href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href = "../index.php" class="logout">Log Out</a
        </div>
    </div>

    <div class="Content">
    <div class="form-style-5">
        <form method="POST" action="?">
        <fieldset>
        <legend><span class="number">1</span>Exam Info</legend>
        <input type="text" name="field1" placeholder="Grade Name*">
            
        <input type="text" name="field2" placeholder="Percentage*">
            
       <input type="submit" value="ADD Exam" />
       
        <legend><span class="number">2</span>Delete Exam</legend>
        <?php
            if(isset($_SESSION['catordog_id'])){
                echo "<select id='delete' name='delete'>";
                $query = mysqli_query($dbcon , "Select * From grade where Id = ".$_SESSION['catordog_id']." Order By gName ASC ");
                while($row = mysqli_fetch_array($query)){
                    $gid = $row['gid'];
                    $g_name = $row['gName'];
                    echo "<option value=$gid>$g_name</option>";
                 }
                echo "</select>"; 
            }
        ?>
             <input type="button" class="delete" value="Delete Exam" />
       </form>
        
       <?php
          if($_POST){
                $c_id = $_SESSION['catordog_id'];
                $exam = $_POST['field1'];
                $percentage = $_POST['field2'];
                $id = $exam."".$c_id;
               
                $query_for_valid = mysqli_query($dbcon , "Select * From gresult where gid ='".$id."';");
                if(mysqli_num_rows($query_for_valid) != 0 ){
                    echo "Please Pick Another Exam Name.";
                }
                else{
                    echo "Successfuly Done.";
                $query = "Select gid from grade where Id=".$c_id;
                $asd = mysqli_query($dbcon, $query);
                $row_count = mysqli_num_rows($asd);
                $result = mysqli_fetch_array($asd);
                
                if($row_count === 0)
                {
                     $sql = "INSERT INTO grade VALUES (0,$percentage,$c_id,'$exam','$id',0)";
                     mysqli_query($dbcon, $sql)or die(mysqli_error($this->db_link)); 
                }
                else{
                    $query2 = "Select gid from grade where Id=".$c_id;
                    $asd2 = mysqli_query($dbcon, $query2);
                    $result2 = mysqli_fetch_array($asd2);
                    
                    $sql = "INSERT INTO grade VALUES (0,$percentage,$c_id,'$exam','$id',0)";
                    mysqli_query($dbcon, $sql); 
                    $gid=$result2['gid'];
                    $query1 = "Select sid from gresult where gid='".$gid."'";
                    $students = mysqli_query($dbcon, $query1);
                     while($row = mysqli_fetch_array($students)){
                         $ll = $row['sid'];

                         $query5 = "INSERT INTO gresult Values(0,$ll,'$id')";
                         mysqli_query($dbcon, $query5);
                     }
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

