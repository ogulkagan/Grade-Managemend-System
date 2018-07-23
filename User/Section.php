<?php
    session_start();
    include_once '../connection.php';
    include'/User_control.php';
?>
<!DOCTYPE html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $(".bas h2").click(function(){
                    
                    var type = $(this).attr("data-type");
                    var id = $(this).attr("class");
                    //alert("Cat or dog "+id);
                    if(type === "dog")
                    {
                       $.post("Course_Section.php",{ID:id} ,function(){
                            window.location.href = 'GradeTable.php';
                       }); 
                    }
                    if(type === "cat"){
                        $.post("Course_Section.php",{ID:id} ,function(){
                             window.location.href = 'At_Table.php';});
                    }
                    
                    
                });  
                $("#addsection").click(function(){
                  var selected = document.getElementById('selected_item').value;
                   
                 $.post("AddSection.php",{section:selected} ,function(){
                      window.location.href = 'Section.php';});
                    
                });
                
                 
                $(".course button").click(function(){
                    var field1 =  $(this).attr('class');
                    var field2 = $(this).attr('data-id');
                    
                    $.post("DeleteSection.php",{id:field1,dogcat:field2},function(){
                      window.location.href = 'Section.php';});
                    
              }); 
               $("#deletecourse").click(function(){
                  
                   $.post("DeleteCourse.php",function(data){
                       if(data==2){
                           window.location.href = 'MyCourses.php';
                       }
                       
                   });
               });  
                  
           });    
        </script> 
     
     
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
 <style>
             
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
            
              h3{
                color:#313940;
                margin:0;
                padding-bottom:20px;
                font-size:36px;
                font-weight:100;
                border-bottom:3px solid #313940;
              }
              h2{
                color:#313940;
                margin:0;
                padding-top:5px;
                font-size:16px;
                font-weight:100;
                /*font-style:oblique;*/
              }
              #css{
                    background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                    margin-left:10%;
                    cursor: pointer;
              }
              #addsection{
                  background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                 
                    cursor: pointer;
              }
              #deletecourse{
                  background-color: rgba(191, 45, 58,0.8); 
                    display:inline-block;
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 16px;
                 
                    cursor: pointer;  
              }
              .li{
                  display:inline-block;
                  color:red;
                  cursor: pointer; 
              }
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
            }
            li{
                color:#313940;
                margin:2%;
                padding:20px;
                cursor: pointer; 
                
                font-size:36px;
                font-weight:100;
               list-style:none;
               border-style: ridge;
               border-color:rgba(191, 45, 58,0.5);
  
              }
              
               h2{
                color:#313940;
                font-size:36px;
                font-weight:100;
               float:left;
                  
              }
             
              
            
              #cname{
                  margin:auto;
                  padding-top:1%;
                  padding-left:30%;
                  color:#bf2d3a;
                  
              }
              #atgr{
                margin:auto;
                  padding-top:1%;
                  padding-left:5%;
                  text-shadow:  3px 4px rgba(181, 49, 49, 0.4);
                    color: #08084A;
                    
              }
             
                  select{
                  margin-top: 1%;
                  margin-left:40%;
                 border: none;
                    color: rgba(191, 45, 58,0.8);
                    padding: 10px 15px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 10px;
                   
                    cursor: pointer;
                   
              }
              .Content{
                  padding-bottom:5%;
              }
        </style>
    <title>Section</title>
</head>
<body>
     <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "MyCourses.php";
            $class = "first";
            echo "<a href=$href id = $class>Return</a>";
              if(isset($_SESSION['stdid1'])){
                  unset($_SESSION['stdid1']);
              }
            ?>
                <a class="first" href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href = "../index.php" class="logout">Log Out</a
        </div>
    </div>

    <div class="Content">
         <div class="bas">
         <?php
            $cid=$_SESSION['cid'];
            $query_course="Select * From course where cid=".(integer)($cid);
            $response_course= mysqli_query($dbcon, $query_course);
            $course= mysqli_fetch_array($response_course);
            $cname="cname";
            echo "<h1 id=$cname>".$course['ccode']."   ".$course['cName']."</h1>";
             
          ?>
         
          
          <div class="wrapper">
              <h1 id="atgr">Attendance</h1>
         
         
          <ul class="course">
            <?php
            
            $query_cat="Select * From cat where cid=".(integer)($cid)." Order By section ASC";
           
            $responce_cat=mysqli_query($dbcon, $query_cat);
            
            while($rowcat = mysqli_fetch_array($responce_cat)){
                $query_nasu="Select * From user where EMail='".$rowcat['eMail']."'";
                $responce_nasu=mysqli_query($dbcon, $query_nasu);
                $rownasu = mysqli_fetch_array($responce_nasu);
                $type = "cat";
                $course_id=$rowcat['Id'];
                $section=$rowcat['section'];
               echo "<li> <h2 data-type=$type class=$course_id data-section=$section>Section-" .$rowcat['section']. "  ".$rownasu['uName'] ."  ".$rownasu['uSurname']."</h2>";
                $delete="Delete Section";
                $id= "css";
                echo "<button class= $course_id data-id=$type id=$id>Delete</button>";
                echo "</li>";
            }    
            ?>
             </ul>  
              <br>
           <h1 id="atgr">Grade</h1>
             <ul class="course">
            <?php
            $query_dog="Select * From dog where cid=".(integer)($cid)." Order By section ASC";
            $responce_dog=mysqli_query($dbcon, $query_dog);
            
            while($rowdog = mysqli_fetch_array($responce_dog)){
                $query_nasu="Select * From user where EMail='".$rowdog['eMail']."'";
                $responce_nasu=mysqli_query($dbcon, $query_nasu);
                $rownasu = mysqli_fetch_array($responce_nasu);
                $type = "dog";
                $dog_id=$rowdog['Id'];
                $section=$rowdog['section'];
                
                
             echo "<li> <h2 data-type=$type class=$dog_id data-section=$section>Section-".$rowdog['section']. "  ".$rownasu['uName'] ."  ".$rownasu['uSurname']."</h2>" ;
                $id= "css";
                echo "<button class= $dog_id data-id=$type id=$id>Delete</button>";
                echo "</li>";
                
           
                
            }    
            ?>
             </ul> 
          
          </div>
             <div>
                <select name="section" id="selected_item">
                       <?php
                        
                       for($i=1;$i<21;$i++)
                    { 
                        
                          echo "<option  value=$i>".$i."</option>";
                          
                    }
                     ?>
                </select>
             <button id="addsection"> ADD Section </button>  
              <button id="deletecourse" class="Delete Course"> Delete Course </button>  
            </div>
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
