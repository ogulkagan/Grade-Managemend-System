<?php
    session_start();
    include_once 'connection.php';
    
    if(isset($_SESSION['uName'])){
        unset($_SESSION['uName']);
    }
    if(isset($_SESSION['sid'])){
       unset($_SESSION['sid']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" /> 
        <title>Log-In Page</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Lato');
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
            .kayit_user{
                width: 460px;
                height: 400px;
                text-align: center;
                background-color: rgba(191,45,58,0.3);
                border-radius: 4px;
                border-radius: 14px;
                margin: 9% 33%;
                float:left;
                display:inline-block;
            }
            .kayit_user img{
               height:120px;
               width: 120px;
               margin-top:-30px;
               margin-bottom:5px;
               border-radius:125px;
            }
            input[type="text"],input[type="password"]{
                height: 45px;
                width:300px;
                font-size: 18px;
                margin-bottom:20px;
                margin-left:26%;
                color:white;
                font-family: times new roman;
                border:none;
                border-bottom: 1px solid #fff;
                background-color: transparent;
                outline:none;
            }
            input[type="submit"]{
                padding:11px 40px;
                cursor:pointer;
                color:white;
                border-radius: 5px;
                border:none;
                background-color: #2BCC71;
                border-bottom: 3px solid #27AE60;
                margin-bottom:6px;
                margin-left:48%;
            }
            
            input[type="submit"]:hover {
                background-color: rgb(153,153,153);
               }

            input[type="submit"]:active {
              background-color: #0DFF92;
              box-shadow: 0 5px #666;
              transform: translateY(4px);
            }
            a{
                text-decoration: none;
                color: #fff;
            }
            a:hover{
                color: red;
            }
            ::placeholder {
                    color: white;
                    opacity: 1;
                    padding-left:5px;
              }  
              p{
                  color:red;
              }
        </style>
    </head>
<body>
    
<div class="kayit_user">
    <img src="images/man.png" alt="Picture" id="imgname"></img>
    <form action="?" method="POST">
        <table>
            <tr>
                <td></td><td><input type="text" name="uname" placeholder="User Name*" maxlength='25'></input></td>
            </tr>
            <tr>
                <td></td><td><input type="password" name="pass" placeholder="Password*" maxlength='30'></input></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" id="but" value="LOG-IN"></input></td>
            </tr>
        </table>
<?php
    if(isset($_POST["uname"])){
    $kadi = $_POST['uname'];
    $pas = $_POST['pass'];

    if($kadi == "" || $pas == ""){
        echo "Please Enter Your E-Mail And Password.";
        }
     else {
         if(is_numeric($kadi)){
             $logi = mysqli_query($dbcon,"Select * From student Where sid = ".$kadi." AND password = '".$pas."'");
         
                if(mysqli_num_rows($logi) > 0){
                    $name = mysqli_fetch_array($logi);
                    $_SESSION['sid'] = $kadi; 
                    $query = mysqli_query($dbcon,"Select * From student Where sid = ".$_SESSION['sid']);
                    $result = mysqli_fetch_array($query);
                    $address = "Student/MyPage.php";
                    echo("<script>window.location.href = '$address';</script>");
                }
                else{
                    echo "<br><p>Wrong User Name Or Password.<br>Please Try Again.</p>";
                }
         }
         else{
             $logi = mysqli_query($dbcon,"Select * From user Where EMail = '".$kadi."' AND Password = '".$pas."'");
         
                if(mysqli_num_rows($logi) > 0){
                    $name = mysqli_fetch_array($logi);
                    $_SESSION['uName'] = $kadi; 
                    $query = mysqli_query($dbcon,"Select * From user Where EMail = '".$_SESSION['uName']."'");

                    $result = mysqli_fetch_array($query);
                    $_SESSION['Name'] = $result['uName'];
                    $_SESSION['sName'] = $result['uSurname'];
                    if((int)($result['IsAdmin']) == 1)
                    {
                        $_SESSION['isAdmin'] = 1;
                        echo "<script type='text/javascript'>window.location.href = 'Admin/AdminPage.php';</script>"; exit;

                    }
                    else
                    {
                        $_SESSION['isAdmin'] = 0;
                        echo "<script type='text/javascript'>window.location.href = 'User/UserPage.php';</script>"; exit;

                    }
                }
                else{
                    echo "<br><p>Wrong User Name Or Password.<br>Please Try Again.</p>";
                   }
            }
         
         
      }
  }
?>
       </form>
    <br><a href="www.google.com">Forget Your Password ?</a>
    

</div>

<!--<div class="kayit_stu">
    <img src="images/student.png" alt="Picture" id="imgname"></img>
    <form action="?" method="POST">
        <table>
            <tr>
                <td></td><td><input type="text" name="stuname" placeholder="Student ID*" maxlength='10'></input></td>
            </tr>
            <tr>
                <td></td><td><input type="password" name="pass1" placeholder="Password*" maxlength='30'></input></td>
            </tr>
            <tr>
                <td></td><td><input type="submit" id="but" value="LOG-IN"></input></td>
            </tr>
        </table> 
<?php
    
   /* if(isset($_POST["stuname"])){
    $kadi = $_POST['stuname'];
    $pas = $_POST['pass1'];

    if($kadi == "" || $pas == ""){
        echo "Please Enter Your Student ID And Password.";
        }
     else {
         $logi = mysqli_query($dbcon,"Select * From student Where sid = ".$kadi." AND password = '".$pas."'");
         
         if(mysqli_num_rows($logi) > 0){
             $name = mysqli_fetch_array($logi);
             $_SESSION['sid'] = $kadi; 
             $query = mysqli_query($dbcon,"Select * From student Where sid = ".$_SESSION['sid']);
             $result = mysqli_fetch_array($query);
             $address = "../Student/MyPage.php";
             echo("<script>window.location.href = '$address';</script>");
         }
         else{
             echo "<br>Wrong User Name Or Password.<br>Please Try Again.";
         }
     }
    }
    */
?>
       </form>
    <br><a href="www.google.com">Forget Your Password ?</a>
    

</div>-->
</body>
</html>
