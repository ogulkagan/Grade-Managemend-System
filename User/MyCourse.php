<?php
       /**/
       session_start();
       if($_POST){
           $_SESSION['cid'] = $_POST['cd'];
           echo $_SESSION['cid'];
           header("Location: Section.php");
            die();
       }


