<?php
    include_once 'connection.php';
    session_start();
    include_once 'User_control.php';
    
    if($_SESSION['uName'] != 'admin@admin'){
        header("Location: AdminPage.php");
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
            
             $(".delete_grade").click(function(){
                  var selected = document.getElementById('selected_item').value;
                   
                 $.post("DeleteScala.php",{grade:selected} ,function(){
                     
                      window.location.href = 'Add_Info.php';});
                    
                }); 
                $("#asd th").focusout(function(){
                    var result = $(this).text();
                   var type1="grade";
                 var field =  $(this).attr('class'); 
                $.post('Edit_Settings.php',{Field:field,Name:result,type:type1});
                });

                $("#asd td").focusout(function(){
                    var result = $(this).text();
                    var type1="res";
                    var field =  $(this).attr('class'); 
                    $.post('Edit_Settings.php',{Field:field,Name:result,type:type1});
                  }); 
                  
                  $(".submit_semester").click(function(){
                    var semester = $('#semesters').val();
                    $.post('Change_semester.php',{Semester:semester},function(){
                             window.location.href = 'Add_Info.php';
                        }); 
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
            .submit_semester{
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
            .delete_grade{
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
  #selected_item{
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
            .semester_parag{
                margin: auto;
                border:none;
                font-family: Georgia, "Times New Roman", Times, serif;
                font-size: 18px;
                color:red;
            }
            .Save{
                    background-color: #2F383F; 
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
     </style>
    <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
    <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css" />
    
    <title>General Settings</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
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
       <a href="AddLecturer.php">Add Lecturer</a>
       <a href="Add_Info.php" class = "active">General Settings</a>
       <a href="DeleteLecturer.php">Delete Lecturer</a>
       <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
       <a href = "../index.php" class="logout">Log Out</a>
     </div>
    </div>

    <div class="Content">
         <div class="form-style-5">
           <?php
            $query_for_semester = mysqli_query($dbcon , "Select * from semester where sCurrent = 1");
            $fetch = mysqli_fetch_array($query_for_semester);
            echo "<legend>Current Semester :".$fetch['Mevsim']."<br>".$fetch['sYear']."</legend><br><br></legend>";
           ?>  
        <legend><span class="number">1</span>Change Current Semester</legend>
        <label>Semesters:</label>
        <select id="semesters" name="field9">
            <?php
            
            $query1 = mysqli_query($dbcon,"Select * From semester");
             while($row_semester = mysqli_fetch_array($query1)){
                 $v1 = $row_semester['sYear'].":".$row_semester['Mevsim'];
                 $value = $v1;
                 echo "<option value=$value>$value</option>";
             }
            ?>
        </select>  
        <input type="button" class ="submit_semester" value="Change" />
        
        <form method="POST" action="?">
        <fieldset>
        <legend><span class="number">2</span>Create A New Semester</legend>
        <label>Year Information</label>
        <?php
         $st = "2017/2018";
         $f1 = "field1";
         $t3 = "text";
         echo "<input type=$t3 name=$f1 placeholder=$st>";
        ?>
        <label>Semester</label>
        <select id="semester" name="field3">
          <option value="FALL">FALL</option>
          <option value="SPRING">SPRING</option>
          <option value="SUMMER">SUMMER</option>
        </select>   
        
        </fieldset>
             <input type="submit" value="Submit" />
        </form>
            <?php
                 if(isset($_POST['field1'])){
                     if (empty($_POST["field1"]) || empty($_POST["field3"])) {
                         echo " TRY AGAİN !";
                     }
                     else{
                         $year1 = $_POST["field1"];
                         $sem = $_POST["field3"];
                         
                         $flag = false;
                         $first_search =  "Select sYear,Mevsim,sCurrent From semester;";
                         if (!mysqli_query($dbcon,$first_search))
                         {
                               echo("Error description: " . mysqli_error($first_search));
                         }
                         $real = mysqli_query($dbcon, $first_search);
                         
                         $first_search1 =  mysqli_query($dbcon,"Select COUNT(Id) as 'con' From semester;");
                         $fet = mysqli_fetch_array($first_search1);
                         $count = $fet['con'];
                         for($i=0 ;$i<$count; $i++)
                         {
                             $row = mysqli_fetch_array($real);
                             if(strcmp($row['sYear'],$year1) == 0 && strcmp($row['Mevsim'],$sem) == 0)
                             {
                                 $flag=true;
                             }
                             
                         }
                         
                         if(!$flag)
                         {
                            $current_clear = "UPDATE semester SET sCurrent= 0;";
                            if (!mysqli_query($dbcon,$current_clear))
                            {
                               echo("Error description: " . mysqli_error($con));
                            }

                            $query =  "INSERT INTO semester(sYear, Mevsim, sCurrent) VALUES('".$year1."','".$sem."', 1);";
                            if (!mysqli_query($dbcon,$query))
                            {
                               echo("Error description: " . mysqli_error($con));
                            }

                               
                      }
                      else{
                          echo "You have already have this Semester Information. <br>Please Try Again !";
                      } 
                         
               }
                 
        }
            ?>
             <br>
             <br>
             <br>
            <legend id="Scale"><span class="number">3</span>Scale Settings</legend>
        </div>
 <div class="bas">
  <table id="asd">
      <thead>
        <?php
                $query = "Select * FROM scale where ScaleId = 'Def'";
                $responce = mysqli_query($dbcon, $query);
                $row = mysqli_fetch_array($responce);
                echo "<thead>";
                echo "<tr>";
                $j=1;
                $flag=1;
                 while($row['grade'.$j]!=-1){
                     $i="grade".$j;
                      echo "<th contenteditable='true' class=$i>" .$row['grade'.$j]."</th>";
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
                 while($row['grade'.$j]!=-1){
                     $i="res".$j;
                      echo "<td contenteditable='true' class=$i>" .$row['res'.$j]."</td>";
                      $j++;
                 }
                 $i="NG";
                 echo "<td contenteditable='true' class=$i>" .$row[$i]."</td>";
                 $i="fcondition";
                 echo "<td contenteditable='true' class=$i>" .$row[$i]."</td>";
                 echo "</tr>";     
           
                     ?>   
                  <form  action="?" method="POST" > 
                  
          <?php
              if($_POST){
                  echo "<thead>";
                  $qwe="qwe";
                  echo "<tr id=$qwe>";
                  $i="grade".$flag;
                  echo "<th contenteditable='true' class=$i>" .$row['grade'.$flag]."</th>";
                  echo "</tr>"; 
                  echo "</thead>";
                  echo "<tr>";
                  $i="res".$flag;
                  echo "<td contenteditable='true' class=$i>" .$row['res'.$flag]."</td>";
                  echo "</tr>";
              }
          ?>
      </table>
      
<select name="grades" id="selected_item">

     <?php
             $query_change = "Select * FROM scale where ScaleId = 'Def'";
                $responce_change = mysqli_query($dbcon, $query_change);
                $row_change = mysqli_fetch_array($responce_change);
               
                $jj=1;
                
                 while($row_change['grade'.$jj]!=-1){
                     
                    echo " <option value=$jj>".$row['grade'.$jj]."</option>";

                      
                      $jj++;
                 }
     ?>
         </select>
            <button class="delete_grade">Delete</button>
      <button type="submit" class = "Save" name="Add Column">Add Column For Scale</button> 
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
