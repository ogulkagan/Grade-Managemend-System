<?php
    include_once '../connection.php';
    session_start();
        
   
     if($_POST['dogcat']=="cat")  
     {
         $catid = $_POST['id'];
         $querycheck = "Select eMail From cat WHERE Id=".$catid;
            $drcheck=mysqli_query($dbcon, $querycheck);
             while($drche=mysqli_fetch_array($drcheck))
             {
                 if($drche['eMail']==$_SESSION["uName"])
                 {
                        $query = "select aid From attendance WHERE Id=".$catid;
            $dr1=mysqli_query($dbcon, $query);
           while($dr=mysqli_fetch_array($dr1))
           {
             $aid=$dr['aid'];
            $queryatr = "DELETE FROM atresult WHERE aid='".$aid. "'";
            mysqli_query($dbcon, $queryatr);
            
            
            }
            $queryat = "DELETE FROM attendance WHERE Id=".$catid;
            mysqli_query($dbcon, $queryat);
            
            $querycat = "DELETE FROM cat WHERE Id=".$catid;
            mysqli_query($dbcon, $querycat);
                 }
             }       
                 
         
     }
     
     else  {
         
         $dogid = $_POST['id'];
            $querycheck = "Select eMail From dog WHERE Id=".$dogid;
            $drcheck=mysqli_query($dbcon, $querycheck);
             while($drche=mysqli_fetch_array($drcheck))
             {
                  if($drche['eMail']==$_SESSION["uName"])
                 {
            $query = "select gid From grade WHERE Id=".$dogid;
            $dr3=mysqli_query($dbcon, $query);
           while($dr2=mysqli_fetch_array($dr3))
           {
             $gid=$dr2['aid'];
            $querygrr = "DELETE FROM gresult WHERE gid='".$gid. "'";
            mysqli_query($dbcon, $querygrr);
            
            
            }
            
             $query5 = "select gid From grade WHERE Id=".$dogid;
            $dr5=mysqli_query($dbcon, $query5);
            $gid1=mysqli_fetch_array($dr5);
            $gid=$gid1['gid'];
            $query6 = "select sid From gresult WHERE gid='".$gid."'";
            $dr6=mysqli_query($dbcon, $query6);
               $query8 = "select cid From dog WHERE Id=".$dogid;
            $dr8=mysqli_query($dbcon, $query8);
            $cid1=mysqli_fetch_array($dr8);
            $cid=$cid1['cid'];
              while($dr7=mysqli_fetch_array($dr6))
           {
             $sid=$dr7['sid'];
            $query9 = "DELETE FROM cresult WHERE sid=".$sid. " and cid=".$cid;
            mysqli_query($dbcon, $query9);
            
            
            }
            
            
            $querygr = "DELETE FROM grade WHERE Id=".$dogid;
            mysqli_query($dbcon, $querygr);
            
            $querydog = "DELETE FROM dog WHERE Id=".$dogid;
            mysqli_query($dbcon, $querydog);
         
             }
             }
     }
            
          
        

        
