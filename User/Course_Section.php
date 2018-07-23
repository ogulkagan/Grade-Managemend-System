<?php

session_start();
       if($_POST){
           $_SESSION['catordog_id'] = $_POST['ID'];
       }