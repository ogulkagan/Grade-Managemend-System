<?php
    session_start();
    include_once '../connection.php';
    include 'User_control.php';
    include 'Section_control.php';
    if(isset($_SESSION['stdid1'])){
        unset($_SESSION['stdid1']);
    }
    /*Lecturer Check*/
    $query_for_lecturer = mysqli_query($dbcon , "Select * from dog where Id = ".$_SESSION['catordog_id']);
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
                $(".submit_button").click(function(){
                    var id = [];
                    var text = [];
                    var exam_id = [];
                    var flag = 0;
                    var i=0;
                    var st_number=0;
                       $("tr").each(function(){
                                   i = 0;
                                   text[st_number] = [];
                                   exam_id[st_number] = [];
                                   if($("tr").index(this) !== 1){
                                       flag = 1;
                                       $(this).find('td').each (function() {
                                            if($(this).index() !== 0){
                                                 text[st_number][i] = $(this).text();
                                                 exam_id[st_number][i] = $(this).attr("data-exam");
                                                 id[st_number] = $(this).attr("data-id");
                                                 i++;
                                              }
                                        });
                                        st_number++;
                                     }
                                   else{
                                       $(this).find('td').each (function() {
                                         if($(this).index() !== 0){
                                            var id1 = $(this).attr('class');
                                            var text1 = $(this).text();
                                            $.post("Change_Percentage.php",{gid:id1,percentage:text1});
                                         }

                                        });
                                       
                                       } 
                                   
                     });
                    $.post("ChangeGrades.php",{stu_id:id,ex_id:exam_id,grade:text});
                   
                   
     		});
     		$(".bas2 td").focusout(function(){
               var stdid1 = $(this).text();
               if(Math.floor(stdid1) == stdid1 && $.isNumeric(stdid1))
               {
                   if(stdid1 < 0 || stdid1 > 100){
                        $(this).html('0');
                   } 
               }
               else{
                   $(this).html('0');
               }
            });
               $("#asd th").on('click', function()  {
                var status =  $(this).text();
                var aid =  $(this).attr('class');
                $.post("Change_Visibility.php",{Aid:aid,Status:status,Type:'dog'},function(){window.location.href = 'GradeTable.php';});
            });
            
            $("#grade_submit").click(function(){
                $("#selam tr").each(function(){
           
                    var dnam=$(this).find("td:eq(0)").text(); // get current row 1st TD value
                    var dnum=$(this).find("td:eq(1)").text(); // get current row 2nd TD
                
                   $.post("ChangeDetails.php",{dname:dnam,dnumber:dnum},function(){
                     window.location.href = 'GradeTable.php';
                     
                            });
                      });
                }); 
        
            $("#grade_button").click(function(){
               $.post("DeleteGname.php",function(){window.location.href = 'GradeTable.php';});  
            });   
            
            
              
            $(".bas td").click(function(){
                var row =$(this).parent().parent().children().index($(this).parent());
                if($(this).index() === 0 && row !== 0){
                    var stdid1 = $(this).text();
                   $.post("StudentDetails.php",{stdid:stdid1},function(){
                       window.location.href = 'StudentDetailsforGrade.php';
                   });
                }
               
            });
            
            $(".bas td").focusout(function(){
               var stdid1 = $(this).text();
               if(Math.floor(stdid1) == stdid1 && $.isNumeric(stdid1))
               {
                   if(stdid1 < 0 || stdid1 > 100){
                        $(this).html('0');
                   } 
               }
               else{
                   $(this).html('0');
               }
            });
            
             $("#asd2 td").focusout(function(){
                var result = $(this).text();
                    var field =  $(this).attr('class');
                   
              $.post('EditScala.php',{Field:field,Name:result},function(){
                  window.location.href = 'GradeTable.php';});
            }); 
                
            $(".add_Manual").click(function(){
                var sID = $("#ID").val();
                var sName = $("#Name").val();
                var sSurname = $("#Surname").val();
                var type = "dog";
                if($.isNumeric( sID ) && !$.isNumeric( sName ) && !$.isNumeric( sSurname )){
                    $.post("StudentAddManual.php",{ID:sID,Name:sName,Surname:sSurname,Type:type}, function(){
                     window.location.href = 'GradeTable.php';
                   });
                }
                else{
                    alert("Wrong Input Please Try Again.");
                }
                    
            });
            
           $body = $("body");
            $(document).on({
                ajaxStart: function() { $body.addClass("loading");    },
                 ajaxStop: function() { $body.removeClass("loading"); }    
              }); 
              
           $(".export_button").click(function(){
                    window.location.href = 'export_grade_table_with_data.php';
                });   
              
              
         });   
        </script>
        <link href="../CSS/GeneralSettings.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <style>
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
             .bas2 table{
                max-width: 100%;
                margin: 0px auto;
                border: none;
                color:#FFF;
                overflow:visible;
                table-layout: fixed;  
              }
              .bas2 caption {
                font-size: 1.6em;
                font-weight: 400;
                color:#bf2d3a;
                margin-top:30px;
                margin-bottom:20px;
              }
              #asd2{
                  overflow:scroll;
              }
              #asd2 tr{
                  border-bottom: 1px solid red;
              }
              .bas2 thead th {
                background-color: #bf2d3a;
                color: #FFF;
                cursor:pointer;
              }
              .bas2 td{
                  background-color: #2C353C;
                  max-width: 50px;
                  max-height: 60px;
                  overflow:visible;
                  cursor:pointer;
              }
              .bas2 th, td{
                text-align: center;
                padding: 17px 25px;
                max-width: 20px;
                max-height: 15px;
                overflow:hidden;
                font-size:10px;
              }
              .bas2 table.fixed { table-layout:fixed; }
              .bas2 table.fixed td { overflow: visible; }
              button.submit_button {
                margin: 10px auto;
                display: block;
                background-color: #2F383F;
              
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
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
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
              h1{
                 color:#313940;
                margin-left:40%;
                padding-top:5px;
                font-size:35px;
                font-weight:100;
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
                #headcourse{
                    margin-left:35%;
                    padding-top:1%;
                    padding-left:5%;
                    color: #BF2D3A;
                  }
           </style>
    <title>Grade Table</title>
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
           
            ?>
                <a class="first"  href="UserPage.php">Home</a>
                <a href="AddCourse.php" >Add Course</a>
                <a href="MyCourses.php" id = "active">My Courses</a>
                <a href = "../index.php" class="logout">Log Out</a
        </div>
    </div>
     <div class="Content">
        
        <div class="bas"> 
           <?php
                if($_SESSION){
                    $at_section = $_SESSION['catordog_id'];
                    $query = "Select * From grade where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                    if(mysqli_num_rows($responce_attendace) < 1){
                         echo "<h1>Please Add Column</h1>";
                    }
                    else{
                    	$query_cid = mysqli_query(($dbcon), "Select * From dog where Id = ".$_SESSION['catordog_id']);
                        $fetch_co = mysqli_fetch_array($query_cid);
                        $query_for_course = mysqli_query($dbcon, "Select * From course where cid = ".$fetch_co['cid']);
                        $fetch_course = mysqli_fetch_array($query_for_course);
                        echo "<h2 id='headcourse'>".$fetch_course['ccode']." " .$fetch_course['cName']."</h2>";
                    
                    
                        $at_section = $_SESSION['catordog_id'];
                        $query = "Select * From grade where Id=".$at_section;
                        $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                        $fetch=mysqli_fetch_array($responce_attendace);
                        $aid = $fetch['gid'];
                        $query1 = "Select * From gresult where gid = '".$aid."'";
                        $responce_null = mysqli_query($dbcon, $query1) or die(mysqli_error());
                        //echo $at_section;
                        if(mysqli_num_rows($responce_null) >= 1)
                        { 
                        //echo $_SESSION['catordog_id'];
                        $table_id = "asd";
                        $cell = "1";
                        echo "<table id=$table_id cellspacing=$cell><caption>Grade Table</caption><thead>";
                        
                        $query_id = "select * from dog where Id = ".$_SESSION['catordog_id'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                        $id = mysqli_fetch_array($responce_id);
                        
                        $query_gid = "select * from grade where Id= ".$_SESSION['catordog_id'];
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_for_percentage = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['gid'];
                                 $visibleornot = $exam['Visible'];
                                 if($visibleornot == 1){
                                     $visibleornot = 'V';
                                 }
                                 else{
                                     $visibleornot = 'NV';
                                 }
                                 echo "<th class=$clas>".$exam['gName']."<br>".">".$visibleornot."</th>";
                                 $empty_rows++;
                            }
                         }
                         else{
                             echo "We have a problem !";
                         }
                         echo "</thead>";
                        
                        /*Percentage*/
                         echo "<tr>";
                         echo "<td>Percentage</td>";
                         if($responce_for_percentage){
                           while($exam = mysqli_fetch_array($responce_for_percentage)){
                                 $clas = $exam['gid'];
                                 echo "<td contenteditable='true' class=$clas>".$exam['Percentage']."%"."</td>";
                                 
                            }
                         }
                         echo "</tr>";
                        
                        
                        $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from gresult where gid = '".$exam1['gid']."' Order By sid ASC";
                        $responce_student = mysqli_query($dbcon, $st_query) or die(mysqli_error());
                        
                       while($st_result = mysqli_fetch_array($responce_student)){
                            echo "<tr>";
                            $st_id = $st_result['sid'];
                            
                            echo "<td class=$st_id data-id=$st_id>".$st_id."</td>";
                            $query_gid = "select * from grade where Id= ".$id['Id'];
                            $responce_gid2 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                            while($exam2 = mysqli_fetch_array($responce_gid2)){
                                 $query_result= mysqli_query($dbcon,"Select * from gresult where gid='". $exam2['gid']."' and sid=".$st_result['sid']);
                                 $grade= mysqli_fetch_array($query_result);
                                 $asd=$st_result['sid'];
                                 $bcd=$grade['Result'];
                                 $student_id = $st_result['sid'];
                                 $exam_id = $exam2['gid'];
                                 echo "<td contenteditable='true' class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>";
                             }
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                            $class_name = "submit_button";
                      echo "<button class= $class_name>Save It.</button>"; 
                      $form_name = "Calculate_Table.php";
                      $method = "POST";
                      echo "<form action=$form_name method=$method>";
                      $calculate = "calculate";
                      $ttpp = "submit";
                      echo "<button type=$ttpp class= $class_name>Calculate</button>"; 
                      echo "</form>";  
                      
                      
                       $class_name1 = "export_button";
                      echo "<button class= $class_name1>Export Table</button>";
                      }
                       
               }
                       
           }
          ?>
            
       </table>
     </div>  
                <?php
                    $grade_section = $_SESSION['catordog_id'];
                    $query1 = "Select * From grade where Id = ".$grade_section;
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
                        echo "<input type=$type name=$name1 placeholder=$space_holder_student1 id=$names maxlength='20'>";
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

                        $actions = "EnterStudents_forGrade.php";
                        $encript = "multipart/form-data";
                        
                        echo "<form action=$actions method=$form_method enctype=$encript>";
                        $size = "1024";
                        echo "<input type='file' name='file' id='file' class='inputfile' size=$size/>";
                        echo "<label for='file'>Choose a file</label>";
                        $tttt = "submit";
                        $vvv = "Read Contents";
                        echo "<input type=$tttt value=$vvv/>";
                        
                        echo "</form>";
                        echo "</div>";
                    }
                   else {

                   }

                ?>
          
        <div class="bas2">
  <table id="asd2">
      <thead>
        <?php
         $query_for_mail=mysqli_query($dbcon,"select * from course where cid=".$_SESSION['cid']);
            $mail= mysqli_fetch_array($query_for_mail);
            if($mail['admin_mail']!=$_SESSION["uName"]){
        
                $query = "Select * FROM scale where ScaleId ='".$_SESSION['cid']."'";
                $responce = mysqli_query($dbcon, $query);
                $row = mysqli_fetch_array($responce);
                
                echo "<tr>";
                $j=1;
                $flag=1;
                 while($row['grade'.$j]!=-1){
                     $i="grade".$j;
                      echo "<th  class=$i>" .$row['grade'.$j]."</th>";
                      $j++;
                      $flag++;
                 }
                 
                  echo "<th>".'NG'."</th>";
                   echo "<th>".'FCondition'."</th>";
                echo "</tr>";  
                ?>
              </thead>
              <?php
              $qwe="qwe";
                echo "<tr id=$qwe>";
               $j=1;
                 while($row['res'.$j]!=-1){
                     $i="res".$j;
                      echo "<td  class=$i>" .$row['res'.$j]."</td>";
                      $j++;
                 }
                 $i="NG";
                 echo "<td  class=$i>" .$row[$i]."</td>";
                 $i="fcondition";
                 echo "<td  class=$i>".$row[$i]."</td>";
                echo "</tr>";     
            }
            else{
                $query = "Select * FROM scale where ScaleId ='".$_SESSION['cid']."'";
                $responce = mysqli_query($dbcon, $query);
                $row = mysqli_fetch_array($responce);
                
                echo "<tr>";
                $j=1;
                $flag=1;
                 while($row['grade'.$j]!=-1){
                     $i="grade".$j;
                      echo "<th class=$i>" .$row['grade'.$j]."</th>";
                      $j++;
                      $flag++;
                 }
                 
                  echo "<th>" .'NG'."</th>";
                   echo "<th>" .'FCondition'."</th>";
                echo "</tr>";  
                ?>
              </thead>
              <?php
              $qwe="qwe";
                echo "<tr id=$qwe>";
               $j=1;
                 while($row['res'.$j]!=-1){
                     $i="res".$j;
                      echo "<td contenteditable='true' class=$i>" .$row['res'.$j]."</td>";
                      $j++;
                 }
                 $i="NG";
                 echo "<td contenteditable='true' class=$i>" .$row[$i]."</td>";
                 $i="fcondition";
                 echo "<td contenteditable='true' class=$i>" .$row[$i]."</td>";
                echo "</tr>";     
           }
                     ?>   
              
             
              
                    
            
                     
            
      </table>
     
    </div>
    </div>

   
   <div class="Footer">
        <div class="social">
          <a href="Add_exam.php" class="support">Add/Delete Column</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
<div class="modal"></div>
</body>
</html>

