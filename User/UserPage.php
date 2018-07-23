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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <meta charset="UTF-8">
        <script>
            $(document).ready(function() {
                  $("#details h3").click(function(){
                    var field1 =  $(this).attr('class');
                    $.post("MyCourse.php",{cd:field1} ,function(){
                    window.location.href = 'Section.php';
                   });
                });
                  $("#past h3").click(function(){
                   var field2 =  $(this).attr('class');
                   
                   $.post("MyCoursepast.php",{cd:field2} ,function(){
                       
                     window.location.href = 'MyCoursepast.php';
                   });
                });
            });
        </script>
    
        <style>
            ul.course {
                list-style-type: none;
                margin: auto;
                padding: 0%;
                overflow: hidden;
                background-color: rgba(247,239,239,0);
                
                }
               ul.course li.name{float: left; }
              /*Lİst*/
              .wrapper{
                width:80%;
                margin:0px auto;
              }

              .menu ul{
                margin:0px;
                padding:0px;
                list-style:none;
              }
              .menu li{
                  padding:20px;
                  margin-bottom:7px;
              }
              .proPic,img{
                display:inline-block;
                width:80px;
                height:80px;
              }
              .info{
                width:75%;
                margin:0;
                margin-left:5%;
                display:inline-block;
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
              }
</style>
    <title>UserPage</title>
    
    <style>
            li{
                cursor:pointer;
            }
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
            }
            button{
              background-color: rgba(191, 45, 58,0.8); 
                   margin-top: 1%;
                    border: none;
                    color: white;
                    padding: 10px 15px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 10px;
                   
                    cursor: pointer;
                    
              }
              select{
                    margin-top: 1%;
                    border: none;
                    color: rgba(191, 45, 58,0.8);
                    padding: 10px 15px;
                    text-align: center;
                    text-decoration: none;
                    font-size: 10px;
                    margin:10px auto;
                    cursor: pointer;
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
     
                 <div class="wrapper">
                       <?php 
                        $form_method = "POST";
                        $form_action = "?";
                        $year = "field1";
                        $idform = "forms";
                        echo "<form action = $form_action method = $form_method id = $idform>";
                       
                        echo "<legend></legend>";
                        $id="get_year";
                        echo "<select id=$id name=$year>";
                        $get_year_query=mysqli_query($dbcon, "Select DISTINCT sYear from semester order by sYear asc");
                        $get_year_current=mysqli_query($dbcon, "Select * from semester where sCurrent=1");
                        $get_cur=mysqli_fetch_array($get_year_current);
                        $current_mevsim=$get_cur['Mevsim'];
                        $current_year=$get_cur['sYear'];
                    while($get_year=mysqli_fetch_array($get_year_query))
                    {
                        $v1=$get_year['sYear'];
                        if($current_year==$v1){
                            
                            $selected="selected";
                             echo "<option selected=$selected value=$v1>".$v1."</option>";
                        }
                        else{
                             echo "<option value=$v1>".$v1."</option>";
                        }
                       
                    }
                   echo "</select>";
                   $semester = "field2";
                   $id2="get_semester";
                        echo "<select id=$id2 name=$semester se>";
                        $get_mevsim_query=mysqli_query($dbcon, "Select DISTINCT Mevsim from semester order by Mevsim asc");
                       while($get_mevsim=mysqli_fetch_array($get_mevsim_query))
                    {
                          $value1=$get_mevsim['Mevsim']; 
                          
                          if($current_mevsim==$value1){
                               $selected="selected";
                          echo "<option  selected=$selected; value=$value1>".$value1."</option>";}
                          else{
                            echo "<option value=$value1>".$value1."</option>";}  
                          
                       
                     }
                        echo "</select>";
                        $ttpp = "submit";
                        $class_name = "submit_button";
                        $name3 = "Year/semester";
                        echo "<button type=$ttpp class= $class_name name =$name3>List</button>"; 
                        echo "</form>";
                        
              ?>
                 <ul class="menu">
                 <ul>
                  <?php 
                if($_POST){
                $is_year= $_POST["field1"];
                $is_semester = $_POST["field2"];
                
                $get_semester_query=mysqli_query($dbcon, "Select Id from semester where sYear='".$is_year."' and Mevsim='".$is_semester."'");
                $get_semester=mysqli_fetch_array($get_semester_query);
                
                $get_current_query=mysqli_query($dbcon, "Select * from semester where sCurrent=1");
                $get_current= mysqli_fetch_array($get_current_query); 
                    
                if($get_semester['Id']!=$get_current['Id']){
                    
              
                   $list_i = "listitem";
                   $proPic = "proPic";
                   $info = "info";
                   $src = "../images/man1.png"; 
                   $coursede="CourseDetails.php";
                   
                   $queryc="Select * From course where semesterid=".$get_semester['Id'];
                   $responcec=mysqli_query($dbcon, $queryc);
                   
                    $past="past";
                    if($responcec!=NULL ){
                   while($rowc = mysqli_fetch_array($responcec)){
                    $address = $rowc['cid'];
                    $ccode=$rowc['ccode'];
                    $cname = $rowc['cName'];
                    echo "<li class=$list_i><div class=$proPic><img src=$src></div>";
                    echo "<div class = $info id=$past>";
                    $bosluk = " - ";
                    echo "<h3 class=$address >$ccode$bosluk$cname</h3>";
                    /*Tüm lecturer'leri arıyoruz.*/
                    echo "<h2>Given By: ";
                    /*Loop koy !*/
                    $q_dog = mysqli_query($dbcon, "Select * From dog where cid=".$address.";");
                    $row10 = mysqli_fetch_array($q_dog); 
                    $as = $row10['eMail'];
                    $q_lecturer = "Select * From user where EMail = '".$as."'";
                    $lecturer = mysqli_query($dbcon, $q_lecturer);
                    $lectuter_for_name = mysqli_fetch_array($lecturer);
                    $nam = $lectuter_for_name['uName'];
                    $sur_name = $lectuter_for_name['uSurname'];
                    echo $nam." ".$sur_name.", ";
                    
                    echo "</h2>";
                   
                    
                    
                    echo "</div></li>";
                  }
                   echo "</ul>
                   </ul>";
                  }
                }
                  else{
                        $ul_class="menu";
                      echo "<ul class=$ul_class>";
                  echo "<ul>";
                  $list_i = "listitem";
                   $proPic = "proPic";
                   $info = "info";
                   $src = "../images/man1.png"; 
                   $coursede="CourseDetails.php";
                   $queryc="Select * From course where semesterid=".$get_current['Id'];
                   $responcec=mysqli_query($dbcon, $queryc);
                   $h3id="details";
                   while($rowc = mysqli_fetch_array($responcec)){
                    $address = $rowc['cid'];
                    $ccode=$rowc['ccode'];
                    $cname = $rowc['cName'];
                    echo "<li class=$list_i><div class=$proPic><img src=$src></div>";
                    echo "<div class = $info id=$h3id>";
                    $bosluk = " - ";
                    
                    echo "<h3 class=$address>$ccode$bosluk$cname</h3>";
                    /*Tüm lecturer'leri arıyoruz.*/
                    echo "<h2>Given By: ";
                    /*Loop koy !*/
                    $q_dog = mysqli_query($dbcon, "Select * From dog where cid=".$address.";");
                    $row10 = mysqli_fetch_array($q_dog); 
                    $as = $row10['eMail'];
                    $q_lecturer = "Select * From user where EMail = '".$as."'";
                    $lecturer = mysqli_query($dbcon, $q_lecturer);
                    $lectuter_for_name = mysqli_fetch_array($lecturer);
                    $nam = $lectuter_for_name['uName'];
                    $sur_name = $lectuter_for_name['uSurname'];
                    echo $nam." ".$sur_name.", ";
                    
                    echo "</h2>";
                   
                    
                    
                    echo "</div></li>";
                  }
                   echo "</ul>
                   </ul>";
                  }
                }
                  if(empty($_POST)){
                      $ul_class="menu";
                      echo "<ul class=$ul_class>";
                       $get_current_query=mysqli_query($dbcon, "Select * from semester where sCurrent=1");
                $get_current= mysqli_fetch_array($get_current_query); 
                  echo "<ul>";
                  $list_i = "listitem";
                   $proPic = "proPic";
                   $info = "info";
                   $src = "../images/man1.png"; 
                   $coursede="CourseDetails.php";
                   $queryc="Select * From course where semesterid=".$get_current['Id'];
                   $responcec=mysqli_query($dbcon, $queryc);
                   $h3id="details";
                   while($rowc = mysqli_fetch_array($responcec)){
                    $address = $rowc['cid'];
                    $ccode=$rowc['ccode'];
                    $cname = $rowc['cName'];
                    echo "<li class=$list_i><div class=$proPic><img src=$src></div>";
                    echo "<div class = $info id=$h3id>";
                    $bosluk = " - ";
                     
                   echo "<h3 class=$address>$ccode$bosluk$cname</h3>";
                    /*Tüm lecturer'leri arıyoruz.*/
                    echo "<h2>Given By: ";
                    /*Loop koy !*/
                    $q_dog = mysqli_query($dbcon, "Select * From dog where cid=".$address.";");
                    $row10 = mysqli_fetch_array($q_dog); 
                    $as = $row10['eMail'];
                    $q_lecturer = "Select * From user where EMail = '".$as."'";
                    $lecturer = mysqli_query($dbcon, $q_lecturer);
                    $lectuter_for_name = mysqli_fetch_array($lecturer);
                    $nam = $lectuter_for_name['uName'];
                    $sur_name = $lectuter_for_name['uSurname'];
                    echo $nam." ".$sur_name.", ";
                    
                    echo "</h2>";
                   
                    
                    
                    echo "</div></li>";
                  }
                   echo "</ul>
                   </ul>";
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
