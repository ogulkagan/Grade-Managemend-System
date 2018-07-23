<?php
       session_start();
       if($_POST){
           $_SESSION['stdid1'] = $_POST['stdid'];
       }