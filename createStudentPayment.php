<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Create Student Payment';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Add';

       if ($do == 'Add') { //Add Members Page 



          $stmt =$con->prepare("SELECT student_payment.* , 
                                       manage_class.ClassName  ,
                                       manage_section.Sec_Name ,
                                       student.Name 
                                From 
                                       student_payment
                                INNER JOIN 
                                       manage_class 
                                ON 
                                       manage_class.ID = student_payment.Class_Name
                                INNER JOIN 
                                       manage_section
                                ON  
                                       manage_section.Sec_ID = student_payment.Section_Name
                                INNER JOIN 
                                       student 
                                ON 
                                       Student.Student_ID = student_payment.Student_Name

                                       ;");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();



        ?>

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Create Student Payment</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">

                                 <!-- Start Class Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Class Name :</label>
                    <div class="col-md-10">
                       <select name="classname" class="form-control">
                         <option value="0">..........</option>
                         <?php
                          $stmt= $con->prepare("SELECT * FROM manage_class");
                          $stmt->execute();
                          $cls =$stmt->fetchAll();
                          foreach ($cls as $cl) {
                            echo "<option value='" .$cl['ID'] . "'>" . $cl['ClassName'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                <!-- End Class Field -->

                <!-- Start Section Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Section Name :</label>
                    <div class="col-md-10">
                       <select name="sectionname" class="form-control">
                         <option value="0">..........</option>
                         <?php
                          $stmt= $con->prepare("SELECT * FROM manage_section");
                          $stmt->execute();
                          $secs =$stmt->fetchAll();
                          foreach ($secs as $sec) {
                            echo "<option value='" .$sec['Sec_ID'] . "'>" . $sec['Sec_Name'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                <!-- End Section Field -->

                <!-- Start Student Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Student Name :</label>
                    <div class="col-md-10">
                       <select name="studentname" class="form-control">
                         <option value="0">..........</option>
                         <?php
                          $stmt= $con->prepare("SELECT * FROM student");
                          $stmt->execute();
                          $stds =$stmt->fetchAll();
                          foreach ($stds as $std) {
                            echo "<option value='" .$std['Student_ID'] . "'>" . $std['Name'] ."</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                <!-- End Student Field -->
                 


                 <div class="form-group">
                  <label class="col-md-2 control-label">Payment Name<span style="color: red;font-size: 22px;margin-left: 4px;">*</span> :</label>
                    <div class="col-md-10">
                    <input type="text" name="paymentname"  class="form-control" autocomplete="off" placeholder="Payment Name Of The Student">
                    </div>
                 </div>

 

                 <div class="form-group">
                  <label class="col-md-2 control-label">Start Date :</label>
                    <div class="col-md-10">
                    <input type="date" name="startdate" class="form-control" placeholder="Enter The Start Date">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">End Date :</label>
                    <div class="col-md-10">
                    <input type="date" name="enddate" class="form-control" placeholder="Enter The End Date">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Amount<span style="color: red;font-size: 22px;margin-left: 4px;">*</span> :</label>
                    <div class="col-md-10">
                    <input type="text" name="totalamount"  class="form-control" autocomplete="off" placeholder="Enter Amount Of Payment">
                    </div>
                 </div>




                 <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Create" class="btn btn-primary btn-lg" style="letter-spacing: 1.5px;">
                    </div>
                 </div>

               </form>
            </div>

           

    <?php 
    }elseif ($do == 'Insert'){

          // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Payment</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $classname      =$_POST['classname'];
          $sectionname    =$_POST['sectionname'];
          $studentname    =$_POST['studentname'];
          $paymentname    =$_POST['paymentname'];
          $startdate      =$_POST['startdate'];
          $enddate        =$_POST['enddate'];
          $totalamount    =$_POST['totalamount'];
     
          //validate Form
           $formErrors =array();
           if($classname == 0){
              $formErrors[]= 'Class Name Cant Be Empty';
           }

           if($studentname == 0){
              $formErrors[]= 'Student Name Cant Be Empty';
           }
           if(empty($totalamount)){
              $formErrors[]= 'Total Amount Cant Be Empty';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }

          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

            //Insert The DataBase
            
            $stmt = $con->prepare("INSERT INTO 
                                    student_payment(Class_Name , Section_Name , Student_Name , Payment_Name , Start_Date , End_Date , Total_Amount)
                                    VALUES(:zclassname, :zsectionname ,:zstudentname, :zpaymentname, :zstartdate, :zenddate, :ztotalamount)");
            $stmt->execute(array(

                'zclassname' => $classname,
                'zsectionname' => $sectionname,
                'zstudentname' => $studentname,
                'zpaymentname' => $paymentname,
                'zstartdate' => $startdate,
                'zenddate' => $enddate,
                'ztotalamount' => $totalamount,            
              ));

            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';

            $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Student Payment Inserted </div>";

            redirectHome($theMsg , 'back');
          }

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg , 'back');

          echo "</div>";
        }

        echo "</div>";



    }
             include $tpl . 'footer.php';

     }else{
          
          header('Location: index.php');
          
          exit();
        }