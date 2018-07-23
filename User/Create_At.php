<?php
        include_once '../connection.php';
        session_start();
        
        $insertdate = date("Y-m-d", strtotime($_POST['At_date']));
        
        $c_id = $_SESSION['catordog_id'];
        $id = $insertdate."/".$c_id;
        $sql = "INSERT INTO attendance VALUES ('$insertdate',0, $c_id,'$id')";
        mysqli_query($dbcon, $sql)or die(mysqli_error($this->db_link)); 
        
        $insertdate1 = date("Y-m-d", strtotime("$insertdate +7 day"));
        $c_id1 = $_SESSION['catordog_id'];
        $id1 = $insertdate1."/".$c_id1;
        $sqlrest = "INSERT INTO attendance VALUES ('$insertdate1',0, $c_id1,'$id1')";
        mysqli_query($dbcon, $sqlrest)or die(mysqli_error($this->db_link)); 
        
        $insertdate2 = date("Y-m-d", strtotime("$insertdate1 +7 day"));
        $c_id2 = $_SESSION['catordog_id'];
        $id2 = $insertdate2."/".$c_id2;
        $sqlrest2 = "INSERT INTO attendance VALUES ('$insertdate2',0, $c_id2,'$id2')";
        mysqli_query($dbcon, $sqlrest2)or die(mysqli_error($this->db_link)); 
        
        $insertdate3 = date("Y-m-d", strtotime("$insertdate2 +7 day"));
        $c_id3 = $_SESSION['catordog_id'];
        $id3 = $insertdate3."/".$c_id3;
        $sqlrest3 = "INSERT INTO attendance VALUES ('$insertdate3',0, $c_id3,'$id3')";
        mysqli_query($dbcon, $sqlrest3)or die(mysqli_error($this->db_link)); 
        
        $insertdate4 = date("Y-m-d", strtotime("$insertdate3 +7 day"));
        $c_id4 = $_SESSION['catordog_id'];
        $id4 = $insertdate4."/".$c_id4;
        $sqlrest4 = "INSERT INTO attendance VALUES ('$insertdate4',0, $c_id4,'$id4')";
        mysqli_query($dbcon, $sqlrest4)or die(mysqli_error($this->db_link)); 
        
        $insertdate5 = date("Y-m-d", strtotime("$insertdate4 +7 day"));
        $c_id5 = $_SESSION['catordog_id'];
        $id5 = $insertdate5."/".$c_id5;
        $sqlrest5 = "INSERT INTO attendance VALUES ('$insertdate5',0, $c_id5,'$id5')";
        mysqli_query($dbcon, $sqlrest5)or die(mysqli_error($this->db_link)); 
        
        $insertdate6 = date("Y-m-d", strtotime("$insertdate5 +7 day"));
        $c_id6 = $_SESSION['catordog_id'];
        $id6 = $insertdate6."/".$c_id6;
        $sqlrest6 = "INSERT INTO attendance VALUES ('$insertdate6',0, $c_id6,'$id6')";
        mysqli_query($dbcon, $sqlrest6)or die(mysqli_error($this->db_link)); 
        
        $insertdate7 = date("Y-m-d", strtotime("$insertdate6 +7 day"));
        $c_id7 = $_SESSION['catordog_id'];
        $id7 = $insertdate7."/".$c_id7;
        $sqlrest7 = "INSERT INTO attendance VALUES ('$insertdate7',0, $c_id7,'$id7')";
        mysqli_query($dbcon, $sqlrest7)or die(mysqli_error($this->db_link)); 
        
        $insertdate8 = date("Y-m-d", strtotime("$insertdate7 +7 day"));
        $c_id8 = $_SESSION['catordog_id'];
        $id8 = $insertdate8."/".$c_id8;
        $sqlrest8 = "INSERT INTO attendance VALUES ('$insertdate8',0, $c_id8,'$id8')";
        mysqli_query($dbcon, $sqlrest8)or die(mysqli_error($this->db_link)); 
        
        $insertdate9 = date("Y-m-d", strtotime("$insertdate8 +7 day"));
        $c_id9 = $_SESSION['catordog_id'];
        $id9 = $insertdate9."/".$c_id9;
        $sqlrest9 = "INSERT INTO attendance VALUES ('$insertdate9',0, $c_id9,'$id9')";
        mysqli_query($dbcon, $sqlrest9)or die(mysqli_error($this->db_link)); 
        
        $insertdate10 = date("Y-m-d", strtotime("$insertdate9 +7 day"));
        $c_id10 = $_SESSION['catordog_id'];
        $id10 = $insertdate10."/".$c_id10;
        $sqlrest10 = "INSERT INTO attendance VALUES ('$insertdate10',0, $c_id10,'$id10')";
        mysqli_query($dbcon, $sqlrest10)or die(mysqli_error($this->db_link)); 
        
        $insertdate11 = date("Y-m-d", strtotime("$insertdate10 +7 day"));
        $c_id11 = $_SESSION['catordog_id'];
        $id11 = $insertdate11."/".$c_id11;
        $sqlrest11 = "INSERT INTO attendance VALUES ('$insertdate11',0, $c_id11,'$id11')";
        mysqli_query($dbcon, $sqlrest11)or die(mysqli_error($this->db_link)); 
        
        $insertdate12 = date("Y-m-d", strtotime("$insertdate11 +7 day"));
        $c_id12 = $_SESSION['catordog_id'];
        $id12 = $insertdate12."/".$c_id1;
        $sqlrest12 = "INSERT INTO attendance VALUES ('$insertdate12',0, $c_id12,'$id12')";
        mysqli_query($dbcon, $sqlrest12)or die(mysqli_error($this->db_link)); 
        
        $insertdate13 = date("Y-m-d", strtotime("$insertdate12 +7 day"));
        $c_id13 = $_SESSION['catordog_id'];
        $id13 = $insertdate13."/".$c_id13;
        $sqlrest13 = "INSERT INTO attendance VALUES ('$insertdate13',0, $c_id13,'$id13')";
        mysqli_query($dbcon, $sqlrest13)or die(mysqli_error($this->db_link)); 
        
        $insertdate14 = date("Y-m-d", strtotime("$insertdate13 +7 day"));
        $c_id14 = $_SESSION['catordog_id'];
        $id14 = $insertdate14."/".$c_id14;
        $sqlrest14 = "INSERT INTO attendance VALUES ('$insertdate14',0, $c_id14,'$id14')";
        mysqli_query($dbcon, $sqlrest14)or die(mysqli_error($this->db_link)); 
        
        $insertdate15 = date("Y-m-d", strtotime("$insertdate14 +7 day"));
        $c_id15 = $_SESSION['catordog_id'];
        $id15 = $insertdate15."/".$c_id1;
        $sqlrest15 = "INSERT INTO attendance VALUES ('$insertdate15',0, $c_id15,'$id15')";
        mysqli_query($dbcon, $sqlrest15)or die(mysqli_error($this->db_link)); 
        
        $insertdate16 = date("Y-m-d", strtotime("$insertdate15 +7 day"));
        $c_id16 = $_SESSION['catordog_id'];
        $id16 = $insertdate16."/".$c_id16;
        $sqlrest16 = "INSERT INTO attendance VALUES ('$insertdate16',0, $c_id16,'$id16')";
        mysqli_query($dbcon, $sqlrest16)or die(mysqli_error($this->db_link)); 
        
        $insertdate17 = date("Y-m-d", strtotime("$insertdate16 +7 day"));
        $c_id17 = $_SESSION['catordog_id'];
        $id17 = $insertdate17."/".$c_id17;
        $sqlrest17 = "INSERT INTO attendance VALUES ('$insertdate17',0, $c_id17,'$id17')";
        mysqli_query($dbcon, $sqlrest17)or die(mysqli_error($this->db_link)); 
        
        $insertdate18 = date("Y-m-d", strtotime("$insertdate17 +7 day"));
        $c_id18 = $_SESSION['catordog_id'];
        $id18 = $insertdate18."/".$c_id18;
        $sqlrest18 = "INSERT INTO attendance VALUES ('$insertdate18',0, $c_id18,'$id18')";
        mysqli_query($dbcon, $sqlrest18)or die(mysqli_error($this->db_link)); 
        
        $insertdate19 = date("Y-m-d", strtotime("$insertdate18 +7 day"));
        $c_id19 = $_SESSION['catordog_id'];
        $id19 = $insertdate19."/".$c_id19;
        $sqlrest19 = "INSERT INTO attendance VALUES ('$insertdate19',0, $c_id19,'$id19')";
        mysqli_query($dbcon, $sqlrest19)or die(mysqli_error($this->db_link)); 
        
        header("Location: At_Table.php");