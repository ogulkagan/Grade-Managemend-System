<?php
    session_start();
    include_once '../connection.php';
    include 'Student_Control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <script>
            function myFunction() {
                var x = document.getElementById("myTopnav");
                if (x.className === "topnav") {
                    x.className += " responsive";
                } else {
                    x.className = "topnav";
                }
            }
        </script>
        
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
       <script>
        $(document).ready(function() {
            $(".Content li").click(function(){
                 var cid = $(this).attr('data-cid');
                 //alert(cid);
                 $.post("cid_session.php",{cd:cid},function(){
                                                window.location.href = 'MyCourse.php';});
             });  
       });        
       </script>
       
       <style>
            .first {
              background-color: rgb(49,57,64);
              color: white;
              position:static; 
              margin-left:17%;
            }
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    
    
    <title>My Page</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <a href="MyPage.php">Return</a>;
      <a href="MyPage.php" class="first">My Courses</a>
      <a href="EditStudent.php">My Settings</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      <a href="../index.php" class="logout">Log Out</a>
    </div>
    </div>

    

    <div class="Content">
        <div class="form-style-5">
            <form method="POST" action="?">
                <label for="job">Select The List</label>
                    <select id="admin" name="field1">
                      <option value="Attendance">Attendance</option>
                      <option value="Grade">Grade</option>
                    </select> 
              <input type="submit" value="Make Selection" />
            </form>
         
        <?php
            if($_POST){
                $selection = $_POST["field1"];
                if($selection == "Grade"){
                    $flag = 0;
                    $query_d = mysqli_query($dbcon , "Select * From dog where cid = ".$_SESSION['cid']);
                    while($result_dog = mysqli_fetch_array($query_d)){
                        /*Search for section*/
                        $dog_id =  $result_dog['Id'];
                        $query_grade = mysqli_query($dbcon, "Select * From grade where Id = ".$dog_id);
                        $result_grade = mysqli_fetch_array($query_grade);
                        /*Search for student*/
                        $query_gresult = mysqli_query($dbcon, "Select * From gresult where gid = '".$result_grade['gid']."'");
                        while($row_student = mysqli_fetch_array($query_gresult)){
                            if($row_student['sid'] == $_SESSION['sid']){
                                $flag = 1;
                                $_SESSION['catordog'] = $dog_id;
                                break;
                            }
                        }
                        
                        if($flag == 1){
                            break;
                        }
                    }
                    if($flag == 0){
                        echo "You Don't have any grade information now.";
                    }
                    else {
                     echo "<script type='text/javascript'>window.location.href = 'Grade.php';</script>"; exit;

                    }
                    
                    
                }
                else {
                    /*Attendance 'ı seçtiyse eğer !*/
                    $flag = 0;
                    $query_a = mysqli_query($dbcon , "Select * From cat where cid = ".$_SESSION['cid']);
                    while($result_at = mysqli_fetch_array($query_a)){
                        /*Search for section*/
                        $cat_id =  $result_at['Id'];
                        $query_at = mysqli_query($dbcon, "Select * From attendance where Id = ".$cat_id);
                        $result_atte = mysqli_fetch_array($query_at);
                        /*Search for student*/
                        $query_aresult = mysqli_query($dbcon, "Select * From atresult where aid = '".$result_atte['aid']."'");
                        while($row_student = mysqli_fetch_array($query_aresult)){
                            if($row_student['sid'] == $_SESSION['sid']){
                                $flag = 1;
                                $_SESSION['catordog'] = $cat_id;
                                break;
                            }
                        }
                        
                        if($flag == 1){
                            break;
                        }
                    }
                    if($flag == 0){
                        echo "You Don't have any grade information now.";
                    }
                    else {
                        echo "<script type='text/javascript'>window.location.href = 'Attendance.php';</script>"; exit;

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
