<?php
    session_start();
    include 'User_control.php';
    include_once '../connection.php';
    if($_POST){
        $_SESSION['dog_idpast'] = $_POST['ID'];
    }
   if(!isset($_SESSION['cat_idpast'])){
     header("Location: MyCoursepast.php");
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
                $(".export_button").click(function(){
                    window.location.href = 'export_grade_table_with_data_past.php';
                }); 
           });

        </script>
                  
       
        <style>
            /*Table*/
            .bas table{
                max-width: 960px;
                margin: 0px auto;
                border: none;
                color:#FFF;
              }
              .bas caption {
                font-size: 1.6em;
                font-weight: 400;
                color:#bf2d3a;
                margin-top:30px;
                margin-bottom:20px;
              }
              #asd tr{
                  border-bottom: 1px solid red;
              }
              .bas thead th {
                background-color: #bf2d3a;
                color: #FFF;
              }
              .bas td{
                  background-color: #2C353C;
                  max-width: 29px;
                  max-height: 20px;
                   text-align: center;
                padding: 12px 17px;
                max-width: 23px;
                max-height: 5px;
                overflow: hidden;
                font-size:10px;
              }
              .bas th {
                text-align: center;
                padding: 12px 17px;
                max-width: 23px;
                max-height: 5px;
                overflow: hidden;
                font-size:10px;
              }
              .bas table.fixed { table-layout:fixed; }
              .bas table.fixed td { overflow: hidden; }
         
            .g_detail{
                position: fixed;
              
                left:0px;
                top:30%;
                width:10%;
                height:40%;
                background-color: rgba(191,45,58,0.8);

            }
           .g_detail table{
                              
                
                margin: 0px auto;
                border: none;
                color:#FFF;
                border-collapse:collapse;
                min-width: 90%;
                min-height: 50%;
                max-height: 60%;
                max-width: 100%;
              }
           
            .g_detail td{
                  background-color: #2C353C;
                  
                  text-align: center;
              
                overflow: hidden;
                font-size:10px;
              }
            .g_detail tr {
                text-align: center;
              
               
                overflow: hidden;
                font-size:10px;
              }
            
             
            h4{
                padding-top:10px;
                padding-left:9%;
                color:white;
                font-family:cursive;
                font-size: 14px;
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
            
            
             
               
            .s_detail{
                 
              position: fixed;
              
                right:0px;
                top:30%;
                width:10%;
                height:40%;
                background-color: rgba(191,45,58,0.8);

            }
           .s_detail table{
                              
                
                margin: 0px auto;
                border: none;
                color:#FFF;
                border-collapse:collapse;
                min-width: 90%;
                min-height: 50%;
                max-height: 60%;
                max-width: 100%;
              }
           
            .s_detail td{
                  background-color: #2C353C;
                  
                  text-align: center;
              
                overflow: hidden;
                font-size:10px;
              }
            .s_detail tr {
                text-align: center;
              
               
                overflow: hidden;
                font-size:10px;
              }
              
              .first{
                margin-left:25%;
                background-color: #bf2d3a;

            }
            #active{
                background-color: rgb(49,57,64);
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
           </style>
           <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
            <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
            
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
            <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>Grade</title>
</head>
<body>
    <div class="nav"> 
        <div class="topnav" id="myTopnav">
            <?php
            $umail = $_SESSION["uName"];
            $adquery = "Select uName , uSurname from user where Email='".$umail."'";
            $responce = mysqli_query($dbcon, $adquery);
            $ad= mysqli_fetch_array($responce);
            $href = "MyCoursepast.php";
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
                    $at_section = $_SESSION['dog_idpast'];
                    $query = "Select * From grade where Id=".$at_section;
                    $responce_attendace = mysqli_query($dbcon, $query) or die(mysqli_error());
                   
                        $at_section = $_SESSION['dog_idpast'];
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
                        
                        $query_id = "select * from dog where Id = ".$_SESSION['dog_idpast'].";";
                        $responce_id = mysqli_query($dbcon, $query_id) or die(mysqli_error());
                        $id = mysqli_fetch_array($responce_id);
                        
                        $query_gid = "select * from grade where Id= ".$_SESSION['dog_idpast'];
                        $responce_gid = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        $responce_gid1 = mysqli_query($dbcon, $query_gid) or die(mysqli_error());
                        echo "<th>Student ID</th>";
                        if($responce_gid){
                           $empty_rows = 0;
                           while($exam = mysqli_fetch_array($responce_gid)){
                                 $clas = $exam['gid'];
                                 echo "<th class=$clas>".$exam['gName']."</th>";
                                 $empty_rows++;
                            }
                          echo "<th>Result</th>";
                         }
                         else{
                             echo "We have a problem !";
                         }
                         echo "</thead>";

                        $exam1 = mysqli_fetch_array($responce_gid1);
                        $st_query = "select * from gresult where gid = '".$exam1['gid']."'";
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
                                 echo "<td  class=$asd data-id = $student_id data-exam = $exam_id>$bcd</td>";
                             }
                             $cid=$id['cid'];
                             $query_cresult= mysqli_query($dbcon,"Select * from cresult where cid=".$cid." and sid=".$st_result['sid']);
                             $cresult= mysqli_fetch_array($query_cresult);
                             echo "<td>".$cresult['alp']."</td>";
                            echo "</tr>";   
                            
                         }
                        
                       echo "</table>";
                           
                      $form_name = "Calculate_Table.php";
                      $method = "POST";
                      echo "<form action=$form_name method=$method>";
                  
                      
                      echo "</form>";
                      }
                        
                    $class_name1 = "export_button";
                    echo "<button class= $class_name1>Export Table</button>";    
               
                       
           }
          ?>
            
       </table>
     </div>  
                
    </div>

       
        
   <div class="Footer">
        <div class="social">
          
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>

</body>
</html>

