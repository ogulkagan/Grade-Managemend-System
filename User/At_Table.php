<?php
    session_start();
    include_once '../connection.php';
    include 'User_control.php';
    include 'Section_control.php';
    if(isset($_SESSION['stdid1'])){
        unset($_SESSION['stdid1']);
    }
    /*Lecturer Check*/
    $query_for_lecturer = mysqli_query($dbcon , "Select * from cat where Id = ".$_SESSION['catordog_id']);
    $fetch_lecturer = mysqli_fetch_array($query_for_lecturer);
    if($_SESSION['uName'] != $fetch_lecturer['eMail']){
        $address = "Section.php";
         echo("<script>window.location.href = '$address';</script>");
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
                    $(".bas td").focusout(function(){
                        var text = $(this).text();
                        if(text === "Y" || text === "y" || text === "n"|| text === "N")
                            {
                               
                            }
                            else{
                                this.innerHTML = 'N';
                            }
                    });
                   $(".submit_button").click(function(){
                        var id = [];
                        var text = [];
                        var exam_id = [];
                        var i=0;
                        var st_number=0;
                        
                        $("tr").each(function(){
                                    i = 0;
                                    text[st_number] = [];
                                    exam_id[st_number] = [];
                                
                                         $(this).find('td').each (function() {
                                             
                                             if($(this).index() !== 0){
                                                  text[st_number][i] = $(this).text();
                                                  exam_id[st_number][i] = $(this).attr("data-exam");
                                                  id[st_number] = $(this).attr("data-id");
                                                  i++;
                                               }
                                               
                                       }); 
                                    
                                    //alert(id[st_number] + " " + exam_id[st_number][2] + " " + text[st_number][2]);
                                    st_number++; 
                                 
                              });
                                 
                            $.post("ChangeAttendance.php",{stu_id:id,ex_id:exam_id,grade:text},function(){window.location.href = 'At_Table.php';});
                       });
                   
                   
                   
                  $(".submit_date").click(function(){
                        var date = document.getElementById("s_Date").value;
                        $.post("Create_At.php",{At_date:date},function(){
                            window.location.href = 'At_Table.php';
                        });
                        
                  });
                  $(".support").click(function(){
                        var date = document.getElementById("s_Date").value;
                        $.post("Create_At.php",{At_date:date}, function(){
                        });
                        
                  });
                  $(".add_Manual").click(function(){
                        var sID = $("#ID").val();
                        var sName = $("#Name").val();
                        var sSurname = $("#Surname").val();
                        var type = "cat";
                        
                        if($.isNumeric( sID ) && !$.isNumeric( sName ) && !$.isNumeric( sSurname )){
                            $.post("StudentAddManual.php",{ID:sID,Name:sName,Surname:sSurname,Type:type}, function(){
                             window.location.href = 'At_Table.php';
                        });
                           
                        }
                        else{
                            alert("Wrong Input Please Try Again.");
                        }
                        
                            
                  });
                  $(".file_button").click(function(){
                        window.location.href = 'At_Table.php'; 
                  });
                    
            $(".bas td").click(function(){
               var attendance = $(this).text(); 
                if($(this).index() !== 0){
                    if(attendance === 'Y')
                    {
                        $(this).html('N');
                    }
                    else
                    {
                        $(this).html('Y');
                    }
                }
                else{
                   var stdid1 = $(this).text();
                   $.post("StudentDetails.php",{stdid:stdid1}, function(){
                             window.location.href = 'StudentDetailsforAtt.php';
                        });
                   
                }
                
            });
             $(".bas td").keypress(function(e) {
                var key = e.which;
                if(key === 13){
                    var attendance = $(this).text();
                    if(attendance === 'Y')
                    {
                        $(this).html('N');
                    }
                    else
                    {
                        $(this).html('Y');
                    }
                }
            });
                
            $(".export_button").click(function(){
                    window.location.href = 'export_at_table.php';
                }); 
                  
            $(".export_button1").click(function(){
                    window.location.href = 'export_attendance_table_with_data.php';
                }); 
                
            $body = $("body");
            $(document).on({
                ajaxStart: function() { $body.addClass("loading");    },
                 ajaxStop: function() { $body.removeClass("loading"); }    
            });
            
           
            
            $("#asd th").on('click', function()  {
                var status =  $(this).text();
                var aid =  $(this).attr('class');
                $.post("Change_Visibility.php",{Aid:aid,Status:status,Type:'cat'},function(){window.location.href = 'At_Table.php';});
            });
            
            
        });
        </script>
     
        <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        
        <style>
              /*Table*/
            .bas table{
                max-width: 100%;
                margin: 0px auto;
                border: none;
                color:#FFF;
                overflow:visible;
                table-layout: fixed;  
              }
              .bas caption {
                font-size: 1.6em;
                font-weight: 400;
                color:#bf2d3a;
                margin-top:30px;
                margin-bottom:20px;
              }
              #asd{
                  overflow:scroll;
              }
              #asd tr{
                  border-bottom: 1px solid red;
              }
              .bas thead th {
                background-color: #bf2d3a;
                color: #FFF;
                cursor:pointer;
              }
              .bas td{
                  background-color: #2C353C;
                  max-width: 50px;
                  max-height: 60px;
                  overflow:visible;
                  cursor:pointer;
              }
              .bas th, td {
                text-align: center;
                padding: 14px 15px;
                max-width: 20px;
                max-height: 15px;
                overflow:hidden;
                font-size:10px;
              }
              .bas table.fixed { table-layout:fixed; }
              .bas table.fixed td { overflow: visible; }
              .submit_button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 2px;
                    cursor: pointer;
              }
              .save_but{
                  background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 2px;
                    cursor: pointer;
              }
              button.submit_button {
                margin: 10px auto;
                display: block;
                background-color: #2F383F;
              }
               
                #file{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 2px;
                    cursor: pointer;
                }
                /*Date Seçici*/
                  [type="date"] {
                    background:#bf2d3a url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
                    color:white;
                    font-size: 18px;
                  }
                  [type="date"]::-webkit-inner-spin-button {
                    display: none;
                  }
                  [type="date"]::-webkit-calendar-picker-indicator {
                    opacity: 0;
                  }
                  label {
                    display: block;
                  }
                  .s_Date{
                    font-size: 1.6em;
                    font-weight: 400;
                    color:#bf2d3a;
                    padding-top:20px;
                    margin-bottom:20px;
                  }
                  .date{
                      max-width: 40%;
                      margin: 0px auto;
                      border: none;
                      color:#FFF;
                      min-height: 80px;
                  }
                  .submit_date{
                    background-color: #bf2d3a; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: block;
                    font-size: 16px;
                    margin: 18px auto;
                    cursor: pointer;
                  }
                  .export_button{
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 45%;
                    cursor: pointer;
                    }
                    .export_button1{
                        background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    margin: 18px 45%;
                    cursor: pointer;
                    }
                  input[type=file] {
                    background-color: #2F383F; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: inline-block;
                    font-size: 16px;
                    cursor: pointer;
                    width: 83%;
                  }
                  h2{
                      color:#BF2D3A;
                      padding-left:30px;
                  }
              .export{
                  margin:0px auto;
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
                background-repeat: repeat;
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
		min-height:800px;
                width:100%;
                display:block;
                margin:auto;
                padding-bottom:40px;
                background-color: rgba(247,239,239,0.8);
               
                background-image: url("../images/llow Coast.png");
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: 20%;
              }
              .modal {
                        display:    none;
                        position:   fixed;
                        z-index:    1000;
                        top:        0;
                        left:       0;
                        height:     100%;
                        width:      100%;
                        background: rgba( 0, 0, 0, .6 ) 
                                    url('../images/editgau.png') 
                                    50% 50% 
                                    no-repeat;
                         background-size: 300px;
            }
            body.loading {
                overflow: hidden;   
            }
            
            body.loading .modal {
                display: block;
            }
             [type="date"] {
                    background:#bf2d3a url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
                    color:white;
                    font-size: 18px;
                  }
                  [type="date"]::-webkit-inner-spin-button {
                    display: none;
                  }
                  [type="date"]::-webkit-calendar-picker-indicator {
                    opacity: 0;
                  }
                  label {
                    display: block;
                  }
                  input{
                    border: 1px solid #c4c4c4;
                    border-radius: 5px;
                    background-color: #2C353C;
                    padding: 3px 5px;
                    box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
                    width: 100%;
                    min-height: 40px;
                  }
                  .s_Date{
                    font-size: 1.6em;
                    font-weight: 400;
                    color:#bf2d3a;
                    padding-top:20px;
                    margin-bottom:20px;
                  }
                  .date{
                      max-width: 40%;
                      margin: 0px auto;
                      border: none;
                      color:#FFF;
                      min-height: 80px;
                  }
                  .submit_date{
                    background-color: #bf2d3a; 
                    border: none;
                    color: white;
                    padding: 15px 32px;
                    text-align: center;
                    text-decoration: none;
                    display: block;
                    font-size: 16px;
                    margin: 18px auto;
                    cursor: pointer;
                  }
                  #headcourse{
                    margin-left:35%;
                    padding-top:1%;
                    padding-left:5%;
                    color: #BF2D3A;
                  }
            	.inputfile {
                    width: 0.1px;
                    height: 0.1px;
                    opacity: 0;
                    overflow: hidden;
                    position: absolute;
                    z-index: -1;
                }
                .inputfile + label {
                     position: relative;
                     display: block;
                     padding: 19px 39px 18px 39px;
                     color: #FFF;
                     margin: 0 auto;
                     background-color: #bf2d3a;
                     font-size: 18px;
                     text-align: center;
                     font-style: normal;
                     width: 78%;
                     border-bottom: 2px solid #2A333A;
                     border-width: 1px 1px 3px;
                     margin-bottom: 10px;
                }

                .inputfile:focus + label,
                .inputfile + label:hover {
                    background:#2A333A;
                }
                .inputfile + label {
                        cursor: pointer; /* "hand" cursor */
                }
           </style>
           
    <title>Attendance</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "Section.php";
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
        <div style="overflow-x:auto;">
        <div class="bas"> 
           <?php
                if($_SESSION){
                    $at_section = $_SESSION['catordog_id'];
                    $query = "Select * From attendance where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                    if(mysqli_num_rows($responce_attendace) < 1){
                        $isim = "s_Date";
                        $type = "date";
                        $value = "13-01-2017";
                        echo "<div class=$type>";
                        echo "<label for=$isim class=$isim>Pick A Start Date For Attendance: </label><input id=$isim type=$type value=$value/>";
                        $class_name = "submit_date";
                        echo "<button class= $class_name>Save It.</button>";
                        echo "<h2>We'll create twenty weeks automatically.</h2>";
                        echo "</div>";
                    }
                    else{
                        $query_cid = mysqli_query(($dbcon), "Select * From cat where Id = ".$_SESSION['catordog_id']);
                        $fetch_co = mysqli_fetch_array($query_cid);
                        $query_for_course = mysqli_query($dbcon, "Select * From course where cid = ".$fetch_co['cid']);
                        $fetch_course = mysqli_fetch_array($query_for_course);
                        echo "<h2 id='headcourse'>".$fetch_course['ccode']." " .$fetch_course['cName']."</h2>";
                        
                        $at_section = $_SESSION['catordog_id'];
                        $query = "Select * From attendance where Id=".$at_section;
                        $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                        $fetch=mysqli_fetch_array($responce_attendace);
                        $aid = $fetch['aid'];
                        $query1 = "Select * From atresult where aid = '".$aid."'";
                        $responce_null = mysqli_query($dbcon, $query1) or die(mysqli_error());
                        
                        if(mysqli_num_rows($responce_null) >= 1)
                        { 
                        $table_id = "asd";
                        $cell = "1";
                        echo "<table id=$table_id cellspacing=$cell><caption>Attendance Table</caption><thead>";
                        
                        $query_id = "select * from cat where Id = ".$_SESSION['catordog_id'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                        $id = mysqli_fetch_array($responce_id);
                        
                        $query_gid = "select * from attendance where Id= ".$_SESSION['catordog_id']." Order By atDate ASC";
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['aid'];
                                 $visibleornot = $exam['Visible'];
                                 if($visibleornot == 1){
                                     $visibleornot = 'V';
                                 }
                                 else{
                                     $visibleornot = 'NV';
                                 }
                                 $dat = date('d/m', strtotime($exam['atDate']));
                                 echo "<th class=$clas>".$dat."<br>>$visibleornot"."</th>";
                                 $empty_rows++;
                            }
                         }
                         else{
                             echo "We have a problem !";
                         }
                         echo "</thead>";

                        $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from atresult where aid = '".$exam1['aid']."' order by sid";
                        $responce_student = mysqli_query($dbcon, $st_query) or die(mysqli_error());
                        
                       while($st_result = mysqli_fetch_array($responce_student)){
                           $counter = 1;
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                             
                            echo "<td data-id=$st_id >".$st_id."</td>";
                            $query_gid = "select * from attendance where Id= ".$id['Id']." Order By atDate ASC";
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select * from atresult where aid='". $exam2['aid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['aid'];
                                 $counter++;
                                 if($bcd==0)
                                 {
                                 echo "<td contenteditable='true' tabindex='$counter' class=$asd data-id = $student_id data-exam = $exam_id>N</td>";
                                 }
                                 else
                                 {
                                   echo "<td contenteditable='true' tabindex='$counter' class=$asd data-id = $student_id data-exam = $exam_id>Y</td>";   
                                 }
                             }
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                      $class_name = "submit_button";
                      echo "<button class= $class_name>Save It.</button>"; 
                      
                      
                      $class_name1 = "export_button";
                      echo "<button class= $class_name1>Export Table</button>";
                      
                      $class_name2 = "export_button1";
                      echo "<button class= $class_name2>Export Table(DATA)</button>";
                      }
                        
                       
               }
                       
           }
          ?>
       
       
     </div>  
        
     <?php
            $at_section = $_SESSION['catordog_id'];
            $query1 = "Select * From attendance where Id = ".$at_section;
            $responce_null = mysqli_query($dbcon, $query1) or die(mysqli_error());
            if(mysqli_num_rows($responce_null) > 0)
            {
            $div_class = "form-style-5";         
            echo "<div class=$div_class>";
            $form_method = "POST";
            $form_action = "StudentAddManual.php";
            
            echo "<fieldset>";
            $cc = "number";
            $type = "text";
            $name = "field1";
            
            echo "<legend><span class=$cc>1</span>Add Student</legend>";
            $stu1 = "ID*";
            $ids = "ID";
            echo "<input type=$type name=$name placeholder=$stu1 id=$ids maxlength='10'>";
            $name1 = "field2";
            $space_holder_student1 = "Name*";
            $names = "Name";
            echo "<input type=$type name=$name1 placeholder=$space_holder_student1 id=$names  maxlength='20'>";
            $name2 = "field3";
            $surnames = "Surname";
            $space_holder_student2 = "Surname*";
            echo "<input type=$type name=$name2 placeholder = $space_holder_student2 id = $surnames maxlength='20'>";
            $type3 = "button";
            $value1 = "AddStudent";
            $idd = "add_Manual";
            echo "<input type=$type3 value=$value1 class=$idd>";
            
            $class_file = "number";
            echo "<legend><span class=$class_file>2</span>Add Student From A Text File</legend>";
            
            $actions = "?";
            $encript = "multipart/form-data";
            echo "<form action=$actions method=$form_method enctype=$encript>";
            $size = "1024";
	        echo "<input type='file' name='file' id='file' class='inputfile' size=$size/>";
	        echo "<label for='file'>Choose a file</label>";
                $tttt = "submit";
                $vvv = "Read Contents";
                echo "<input type=$tttt value=$vvv class = $button_name/>";
                echo "<legend>Students will not added if the student has taken same course but already signed different sections.</legend>";
                echo "</form></div>";
            }
           else {
               
           }
            
      ?>  
         <?php
    
                   if($_FILES){
                    if(isset($_FILES["file"]["name"]) && $_FILES['file']['type'] != 'text/plain') {
                      echo "<span>File could not be accepted ! Please upload any '*.txt' file.</span>";
                      exit();
                    } 
                    else {
                        
                     //İsmi ve Yolunu tuttum !
                     $fileName = $_FILES['file']['tmp_name'];
                     //Açamadıysam error
                     $file = fopen($fileName,"r") or exit("Unable to open file!");
                    
                     while (($line = fgets($file)) !== false) {     
                        $pieces = explode(" ", $line);

                        //echo $pieces[0] . $pieces[1]. $pieces[2]."<br>";
                        $data[0] = isset($pieces[0]) ? $pieces[0] : null;
                        $data[1] = isset($pieces[1]) ? $pieces[1] : null;
                        $data[2] = isset($pieces[2]) ? $pieces[2] : null;
                        
                       if(!is_numeric($data[0])){
                            echo "Student Id has to be Numeric";
                       }
                        else{
                        $flag=0;
                        $querycourse= mysqli_query($dbcon, "select cid from cat where id=".$_SESSION['catordog_id']);
                        $resultcourse= mysqli_fetch_array($querycourse);
                        $catquery= mysqli_query($dbcon,"select Id from cat where cid=".$resultcourse['cid']);
                        while($search_for_cat= mysqli_fetch_array($catquery))
                        {
                         $getaid=mysqli_query($dbcon,"select aid from attendance where Id=".$search_for_cat['Id']); 
                         $aidresult= mysqli_fetch_array($getaid);
                         $get_atresult= mysqli_query($dbcon,"Select sid from atresult where aid='".$aidresult['aid']."' and sid=".$data[0]);
                          if(mysqli_num_rows($get_atresult) != 0)
                          {     
                              $flag = 1;
                              break;
                          }

                        }
                        
                        if($flag==0)
                        {
                        $query = "select * from student where Sid = ".$data[0];
                        $result = mysqli_query($dbcon, $query);
                        if($result){

                        if(mysqli_num_rows($result) < 1){
                            $enter_student= "insert into student(sName,sSurname,Sid,password) values('$data[1]', '$data[2]', $data[0], '$data[0]')";
                            mysqli_query($dbcon, $enter_student);

                            $enter_student_attendance="Select aid From attendance where Id=".$_SESSION['catordog_id'];
                            $start_query=mysqli_query($dbcon, $enter_student_attendance);
                            while ($row = mysqli_fetch_array($start_query)) {
                                $row_Aid = $row['aid'];
                                $enter_attendance = "insert into atresult(Sid,aid,Result) values( $data[0],'$row_Aid' , 0)"; 
                                mysqli_query($dbcon, $enter_attendance);
                            }
                        }
                        else{
                            $enter_student_attendance = "Select aid From attendance where id=".$_SESSION['catordog_id'];
                            $start_query = mysqli_query($dbcon, $enter_student_attendance);
                            while ($row = mysqli_fetch_array($start_query)) {
                                $row_Aid = $row['aid'];
                                $enter_attendance = "insert into atresult(Sid,aid,Result) values( $data[0],'$row_Aid' , 0)"; 
                                mysqli_query($dbcon, $enter_attendance);
                            }
                        }

                       } 
                     }
                   }
                        
               }
                $address = "At_Table.php";
                    echo("<script>window.location.href = '$address';</script>");     
         }  
              
                   
    }
?>      
 </div>
      
</div> 



    <div class="Footer">
        <div class="social">
          <a href="AddColumn_For_Attendance_First.php" class="support">Add/Delete Column</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>

<div class="modal"></div>
</body>
</html>

