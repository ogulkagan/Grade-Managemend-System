<?php
    session_start();
    include_once 'connection.php';
    include_once 'User_control.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../CSS/Navigator.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Footer.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Table.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/Form.css" />
        <link rel="stylesheet" type="text/css" href="../CSS/GeneralSettings.css"/>
        
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
            $("#asd tr").focusout(function(){
                var E_Mail = $(this).find('td:eq(0)').text();
                var u_Name = $(this).find('td:eq(1)').text();
                var u_Surname = $(this).find('td:eq(2)').text();
                var office = $(this).find('td:eq(4)').text();
                var title = $(this).find('td:eq(3)').text();
                var isadmin = $(this).find('td:eq(5)').text();
                $.post("ChangeUser.php",{EMail:E_Mail,Name: u_Name,Surname:u_Surname,Office:office,Title:title,isAdmin:isadmin});
            });
            $body = $("body");

            $(document).on({
                ajaxStart: function() { $body.addClass("loading");    },
                 ajaxStop: function() { $body.removeClass("loading"); }    
            });
            
            $(".sifir").click(function(){
                var email = $(this).attr("id");
                $.post("password_lecturer.php",{EMail:email} , function(data){alert(data);});
            });
            
            $(".sifirla").click(function(){
                var email = $(this).attr("id");
                $.post("password_student.php",{EMail:email} , function(data){alert(data);});
            });
            
            
       });        
       </script>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <style>
            
            .first {
              background-color: rgb(49,57,64);
              color: white;
              position:static; 
             margin-left:5%;
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
            form.example input[type=text] {
                padding: 10px;
                font-size: 17px;
                border: none;
                float: left;
                width: 25%;
                background: #f1f1f1;
                margin-left:30%;
                margin-top:5%;
            }

            form.example button {
                float: left;
                width: 10%;
                padding: 10px;
                background: #BF2D3A;
                color: white;
                font-size: 17px;
                border: none;
                cursor: pointer;
                margin-top:5%;
            }

            form.example button:hover {
                background: #252A30;
            }

            form.example::after {
                content: "";
                clear: both;
                display: table;
            }
            p{
                margin-left:23%;
                padding:10px;
                color:yellow;
                font-size:22px;
            }
            td{
                cursor:pointer;
            }
     </style>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 
    <title>AdminPage</title>
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
      <a href="Add_Info.php">General Settings</a>
      <a href="DeleteLecturer.php">Delete Lecturer</a>
      <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      <a href = "../index.php" class="logout">Log Out</a>
    </div>
    </div>

    

    <div class="Content">
         <?php
                $query = "Select * FROM user";
                $responce = mysqli_query($dbcon, $query);
         ?>
        <span class="bas"> 
           <table id="asd">
                <caption>Lecturers</caption>
                <thead>
                  <tr>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Title</th>
                    <th scope="col">Office</th>
                    <th scope="col">Admin ?</th>
                    <th scope="col">Reset Password</th>
                  </tr>
                </thead>
                <?php
                while($row = mysqli_fetch_array($responce)){
                    if($row['EMail'] != 'admin@admin'){
                        
                        
                    if($row['EMail'] != $_SESSION['uName']){
                        
                        
                            $i = $row['EMail'];
                            echo "<tr id=$i>";
                            echo "<td>" .$row['EMail']."</td>";
                            echo "<td contenteditable='true'>".$row['uName']."</td>";
                            echo "<td contenteditable='true'>".$row['uSurname']."</td>";
                            echo "<td contenteditable='true'>".$row['Title']."</td>";
                            echo "<td contenteditable='true'>".$row['Office']."</td>";
                            if($row['IsAdmin'])
                            {
                                echo "<td>Yes"."</td>";
                            }
                            else{
                                echo "<td>No"."</td>";
                            }
                            $sifir = "sifir";
                            $id_email = $row['EMail'];
                            echo "<td class=$sifir id=$id_email>Reset Password</td>";
                            echo "</tr>";
                      }
                    
                    else{
                        $_SESSION['uName'] = $row['EMail'];
                       }
                  }
                }    
                ?>
         </table>
       </span>  
        
        <span class="bas"> 
        <form class="example" action="?" method="POST">
          <input type="text" placeholder="Search For Students.." name="search" maxlength="10">
          <button type="submit"><i class="fa fa-search" ></i></button>
        </form>
           <table id="asd">
               <caption>Students</caption>
                <thead>
                  <tr>
                    <th scope="col">Student Id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Reset Password</th>
                  </tr>
                </thead>
                <?php
                if($_POST){
                    $st_id = $_POST['search'];
                    $query1 = mysqli_query($dbcon,"Select * From student where sid=".$st_id);
                    if(mysqli_num_rows($query1)>0){
                        while($row = mysqli_fetch_array($query1)){
                    $i = $row['Sid'];
                    echo "<tr id=$i>";
                    echo "<td>" .$row['Sid']."</td>";
                    echo "<td contenteditable='true'>".$row['sName']."</td>";
                    echo "<td contenteditable='true'>".$row['sSurname']."</td>";
                    $sifir = "sifirla";
                    $sid_email = $row['Sid'];
                    echo "<td class=$sifir id=$sid_email>Reset Password</td>";
                    echo "</tr>";
                       }
                    }
                    else{
                            echo "<p>We Don't Have Any Student With This Student Id.</p>";    
                        }
                    
                    } 
                
                  
                ?>
         </table>
       </span>  
     
                 
  </div>

    <div class="Footer">
        <div class="social">
          <a href="#" class="support">Contact Us</a>
          
          <a  class="right">&copy 2017 - Graduation Project</a>
        </div>
    </div>
<div class="modal"></div>
</body>
</html>
