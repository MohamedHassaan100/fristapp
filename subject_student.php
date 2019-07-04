<?php   

/*
=======================================
Items Page
=======================================
*/


   ob_start();

   session_start();

   $pageTitle = 'Manage Subject';

   if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

     if($do == 'Manage'){


          $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;


          $tatu =$con->prepare("SELECT Subject_ID
                                FROM register_subject WHERE Std_ID='$studentid' ;");
          $tatu->execute(array($studentid));

          //ASSIGN TO VARIABLE

          $rows=$tatu->fetchAll();

       
       #print_r($rows);

/////////////Check Semester for new Student//////////////////////

          $er=$_SESSION['Username'];
          $stmt =$con->prepare("SELECT Semester
                                FROM student WHERE User_Name='$er' ;");
          $stmt->execute(array($er));

          //ASSIGN TO VARIABLE

          $rts=$stmt->fetchAll();

#print_r($rts);
foreach ($rts as $rt ) {
  # code...
}
#echo $rt[0];


          //Check the subject that student register

          $sumu =$con->prepare("SELECT Subject_ID
                                FROM register_subject WHERE Std_ID='$studentid' ;");
          $sumu->execute(array($er));

          //ASSIGN TO VARIABLE

          $tows=$sumu->fetchAll();

          $count = $sumu->rowCount();

          #print_r($tows);
         # echo $count;




if ($rt[0] == '1st') {



          $stmt =$con->prepare("SELECT manage_subject_one.* 
                                       
                                From 
                                       manage_subject_one
                                ");
                              
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $subjects=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="margin-bottom: 30px;color:#888;font-size: 55px;font-weight: bold">Manage Subject</h1>   
           
           <p style="color: #26ad45;font-size: 20px;margin-bottom: 20px;font-family: monospace;margin-right: 30px;margin-left: 30px;background-color: antiquewhite;    border-radius: 18px;">Keep In Your Mind The Minimum Number Of Hours For Registration Must Be <span style="color: #f7061d">9 Hours</span> And The Maximum Number Of Hour For Registration Must Be <span style="color: #f7061d">18 Hours</span>.</p>

                     


<form>

           <div class="container">

            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>#ID</td>
                   <td>Subject Name</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td><input class="btn btn-info" type="submit"  name="submit" value="submit"> </td>
                </tr>
                <?php
                 foreach ($subjects as $subj) {
                    echo "<tr>";
                      echo "<td>" . $subj['Subj_One_ID'] . "</td>";
                      echo "<td>" . $subj['Subj_Name'] . "</td>";
                      echo "<td>" . $subj['Subj_Hour'] . " " ."</td>";
                      echo "<td>" . $subj['Subj_Mark'] . " " ."</td>";
                      ?>
                     <td> <input type="checkbox" name="chk[]" value="<?php echo $subj["Subj_Hour"] . ' ' . $subj["Subj_One_ID"] ?>"> </td>
                     <?php 
                    echo "</tr>";
                 }


                ?>
              
              </table>

  </form>     


<?php

 


 if(isset($_REQUEST["submit"])){

  
  $chk=$_REQUEST["chk"];
  
  $chk2="";  


  $a = implode("",$chk);
  $b = explode( '3 ', $a);

  

  if (array_sum($chk) >= 9 && array_sum($chk) <= 18) {


    $co = array_sum($chk)/3;

   $stmt =$con->prepare("SELECT Student_ID
                                FROM student WHERE User_Name='$er' ;");
 
          //Execute The Statment

          $stmt->execute(array($er));

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


            foreach ($rows as $r ) {
              #echo $r[0];
            }
           
       
        for ($i=1; $i <=sizeof($b)-1; $i++) { 
             
           $f =$b[$i];

          $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID , Subject_ID, Subject_ID_2 , Degree )
                                    VALUES('$r[0]', '$f' ,'Empty', '0' )");
          $uio->execute();

           

          //////////////Update Semester to '2st'///////////////


      
          $stmt=$con->prepare("UPDATE student SET Semester=?   WHERE Student_ID='$r[0]'");
            $stmt->execute(array('2st'));

              }
  }

        $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Student Registered </div>";

        redirectHome($theMsg);
}



}elseif ($rt[0] == '2st' ) {


        $studentid= $_GET['studentid'];

                    ////////////////////////////Fetch Subject And Degree///////////////

          $mktr =$con->prepare("SELECT Subject_ID FROM register_subject WHERE Std_ID=? ") ;

          $mktr->execute(array($studentid));

          $koa =$mktr->fetch();

          $count = $mktr->rowCount();

          
         
            $ctyv =$con->prepare("SELECT ID FROM register_subject WHERE Std_ID IN (?) GROUP BY ID") ;

            $ctyv->execute(array($studentid));

            $uip =$ctyv->fetch();

            #print_r($uip);echo "<br>";

            $a = $uip[0];

            #echo $a;echo "<br>";

            $s = "";
         
            for ($i=$a;$i<($count+$a);$i++){
              

               $dft =$con->prepare("SELECT Degree FROM register_subject WHERE ID=? And Degree >= 50 ") ;

               $dft->execute(array($i));

                $mn =$dft->fetch();

                $coun = $dft->rowCount();

                #echo $coun . "<br>";

                $n = (int)$coun;

                $s .=$n;

                #echo $coun . "<br>";

                #echo $s;

                $x = str_split($s);

                #print_r($x);

                #print_r($mn);
                
            }


          #print_r($s);
          #echo "<br>";
          $x = str_split($s);
          
          $su = 0;

          for($j=0 ; $j<count($x) ; $j++){

            if ($x[$j] == 1) {

              $su += $x[$j];
                

            }
          
          }

          #print_r($x) ;
          #echo $su;

    if ($su >=3) {
      
  

              $stmt =$con->prepare("SELECT manage_subject_two.* 
                                                   
                                            From 
                                                   manage_subject_two
                                            ");
                                          
             
                      //Execute The Statment

                      $stmt->execute();

                      //ASSIGN TO VARIABLE

                      $subjects=$stmt->fetchAll();

          /////// //////////////////// ////////////////

            $marsub =$con->prepare("SELECT register_subject.* 
                                                   
                                            From 
                                                   register_subject
                                            ");
                                          
             
                      //Execute The Statment

                      $marsub->execute();

                      //ASSIGN TO VARIABLE

                      $mars=$marsub->fetchAll();
     
?>

        <h1 class="text-center" style="margin-bottom: 30px;color:#888;font-size: 55px;font-weight: bold">Manage Subject</h1>   
           
           <p style="color: #26ad45;font-size: 20px;margin-bottom: 20px;font-family: monospace;margin-right: 30px;margin-left: 30px;background-color: antiquewhite;    border-radius: 18px;">Keep In Your Mind The Minimum Number Of Hours For Registration Must Be <span style="color: #f7061d">9 Hours</span> And The Maximum Number Of Hour For Registration Must Be <span style="color: #f7061d">18 Hours</span>.</p>

                     


<form>

           <div class="container">

            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Subject Name</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td>Register</td>
                </tr>
                <?php
                foreach ($mars as $mar) {
                  # code...
                }
                 foreach ($subjects as $subj) {
                    echo "<tr>";
                      echo "<td>" . $subj['Subj_Two_ID'] . "</td>";
                      echo "<td>" . $subj['Subj_Name'] . "</td>";
                      echo "<td>" . $subj['Subj_Hour'] . " " ."</td>";
                      echo "<td>" . $subj['Subj_Mark'] . " " ."</td>";
                      echo "<td>
                              <a href='subject_student.php?do=Add&subdeg=" .$subj['Subj_Two_ID'] . "&studentid=" .$mar['Std_ID'] . "' class='btn btn-success'><i class='fas fa-download'></i></a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>

  </form> 

  <?php

 }
    
}
     } elseif ($do == 'Add') { ?>
<?php
            
         $subdeg= $_GET['subdeg'];

      //Check If Get Request userid is numeric & GEt The Integer Value Of It
       $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;
      # echo $studentid;



         
         if($subdeg == 'CS132'){

            $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='CS131' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();


     ////////////////////Count Row To Move To Another Page//////////////////

      $opk =$con->prepare("SELECT Subject_ID_2 FROM register_subject WHERE NOT Subject_ID_2 ='Empty' ") ;

      $opk->execute(array());

      $row =$opk->fetch();

      $count = $opk->rowCount();

      print_r($count) ;

   ////////////////////////////////////////////////////         
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in CS131 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

          #echo $subdeg;
          #echo $studentid;

         }elseif ($subdeg == 'IS212') {
            
            $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='IS111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in IS111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'IS343') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='IS111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in IS111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'IS373') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='IS111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in IS111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'IS449') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='IS111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in IS111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'IT181') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='CS110' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in IS111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'MA112') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='MA111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in MA111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }elseif ($subdeg == 'ST190') {
           
           $svmvs =$con->prepare("SELECT Degree FROM register_subject WHERE Std_ID=? AND Subject_ID='MA111' LIMIT 1 ") ;

            $svmvs->execute(array($studentid));

            $svm =$svmvs->fetch();

            #print_r($svm) ;
            #echo $svm[0];

            if ($svm[0] >= 50) {

              #echo "Sucess";
              $uio = $con->prepare("INSERT INTO 
                                    register_subject(Std_ID ,Subject_ID_2 ,Subject_ID , Degree )
                                    VALUES('$studentid', '$subdeg' ,'Empty', '0' )");
             $uio->execute();
             

             echo "<div class='container'>";

             $theMsg ="<br><br><br><div class='alert alert-success'>" . $svmvs->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');

             echo "</div>";

            }else{

             echo "<div class='container'>";

             $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You Must  Register in MA111 Subject And Sucess</div>';

             redirectHome($theMsg , 'back');

             echo "</div>";

            }

         }



      
     }elseif ($do == 'Insert'){

          // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Subject</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $subname     =$_POST['subname'];
          $teachname     =$_POST['teachname'];
          $totmark     =$_POST['totmark'];

          //validate Form
           $formErrors =array();
           if(empty($subname)){
              $formErrors[]= 'Name Can\'t Be<strong> Empty</strong>';
           }
           if($teachname == 0){
              $formErrors[]= 'You Must Choose<strong> Status</strong>';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }

          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

            //Insert The DataBase
            
            $stmt = $con->prepare("INSERT INTO 
                                    manage_subject(Sub_Name , Teach_ID,Total_Mark)
                                    VALUES(:zname, :zteach ,:totmark)");
            $stmt->execute(array(

                'zname'    => $subname,
                'zteach'    => $teachname,
                'totmark'    => $totmark,

              ));

             //Success Message

             //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';

            $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Record Inserted </div>";

            redirectHome($theMsg , 'back');
          

           }

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg , 'back');

          echo "</div>";
        }

        echo "</div>";



     }elseif ($do == 'Edit') {


        //Check If Get Request userid is numeric & GEt The Integer Value Of It

          $subid= isset($_GET['subid']) && is_numeric($_GET['subid']) ? intval($_GET['subid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_subject WHERE Sub_ID=? ") ;
      
      //Execute Query
      
       $stmt->execute(array($subid)); 
      
      //Fetch The Data
      
       $sub =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             
           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Add New Subjects</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="subid" value="<?php echo $subid ?>">
                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subname"  class="form-control"  required="required"  value="<?php echo $sub['Sub_Name']; ?>">
                    </div>
                 </div>
                 <!-- End Name Field -->

                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="totmark"  class="form-control"  required="required"  value="<?php echo $sub['Total_Mark']; ?>">
                    </div>
                 </div>
                 <!-- End Name Field -->

                 <!-- Start Member Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Teacher Name :</label>
                    <div class="col-md-10">
                       <select name="teachname" class="form-control">
                      
                         <?php
                          $stmt= $con->prepare("SELECT * FROM teacher");
                          $stmt->execute();
                          $teachers =$stmt->fetchAll();
                          foreach ($teachers as $teach) {
                            echo "<option value='" .$teach['Teacher_ID'] . "'" ;
                             if($sub['Teach_ID'] == $teach['Teacher_ID']){ echo 'selected';}
                            echo ">" . $teach['First_Name'].' '.$teach['Last_Name'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                 <!-- End Member Field -->

                 <!-- Start Submit Field -->
                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Save Subject" class="btn btn-primary btn-sm">
                    </div>
                 </div>
                 <!-- End Submit Field -->

               </form>
            </div>

           <?php   

         }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger">Theres  No Such Id</div>';

          redirectHome($theMsg);

          echo "</div>";

         }

      
     }  elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Update Subject</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
          $id         =$_POST['subid'];
          $subname    =$_POST['subname'];
          $totmark    =$_POST['totmark'];
          $teachname  =$_POST['teachname'];
   

      


          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

          //Update The DataBase
          $stmt=$con->prepare("UPDATE manage_subject SET Sub_Name=? , Total_Mark=? , Teach_ID=?   WHERE Sub_ID=?");
            $stmt->execute(array($subname , $totmark , $teachname , $id));

          //Success Message

          $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Subject Updated </div>";

          redirectHome($theMsg , 'back');

           }

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";


     }


           ////////////////////////////

?>



<!-- Modify this according to your requirement -->
<div style="border-radius:10px ;margin-bottom: 20px ;margin-top: 50px; padding: 10px;background: rgba(189, 218, 203, 0.2);box-shadow: 10px 10px 5px #add9e0;border:none;">  
<h3 style="color:#08c8e6 ; font-size:30px ; font-style:italic ; font-family:cursive ;  text-align:center;letter-spacing: 3px;">
  Registration end after <span id="countdown">10000</span> Seconds
</h3>
</div>
<!-- JavaScript part -->
<script type="text/javascript">
    
    // Total seconds to wait
    var seconds = 10000;             //day=86400 seconds, 2day=172800 seconds , 3day=259200 seconds ,4days=345600 seconds , 5days=432000 seconds , 6days=518400 seconds ,7days=604800 seconds.
    
    function countdown() {
        seconds = seconds - 1;
        if (seconds < 0) {
            // Chnage your redirection link here
            window.location = "sorry.php"; //https://duckdev.com
        } else {
            // Update remaining seconds
            document.getElementById("countdown").innerHTML = seconds;
            // Count down using javascript
            window.setTimeout("countdown()", 1000);
        }
    }
    
    // Run countdown function
    countdown();
    
</script>


<?php












      /////////////////////

      include $tpl . 'footer.php';
       
   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>