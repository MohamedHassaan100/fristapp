<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Add Bulk Student';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

         //Start manage page

          if($do == 'Manage'){ //Manage Members Page 

          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT student.* , 
                                       manage_class.ClassName  ,
                                       manage_section.Sec_Name 
                                From 
                                       student
                                INNER JOIN 
                                       manage_class 
                                ON 
                                       manage_class.ID = student.Class_ID
                                INNER JOIN 
                                       manage_section
                                ON  
                                       manage_section.Sec_ID = student.Section_ID;");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Add Bulk Students</h1>   
            
            <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">First Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="firstname"  class="form-control" autocomplete="off" required="required" placeholder="FirstName Of The Student">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Last Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="lastname"  class="form-control" autocomplete="off" required="required" placeholder="LastName Of The Student">
                    </div>
                 </div>


                <!-- Start Member Field -->
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
                <!-- End Member Field -->

                <!-- Start Member Field -->
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
                <!-- End Member Field -->


                 <div class="form-group">
                  <hr style="font-size: 100px;margin-top: 40px;margin-bottom: 40px;">
                 </div>

                           
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">First Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="firstn"  class="form-control" autocomplete="off" required="required" placeholder="FirstName Of The Student">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Last Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="lastn"  class="form-control" autocomplete="off" required="required" placeholder="LastName Of The Student">
                    </div>
                 </div>


                <!-- Start Member Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Class Name :</label>
                    <div class="col-md-10">
                       <select name="classn" class="form-control">
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
                <!-- End Member Field -->

                <!-- Start Member Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Section Name :</label>
                    <div class="col-md-10">
                       <select name="sectionn" class="form-control">
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
                <!-- End Member Field -->


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Students" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>
             

  <?php  }elseif ($do == 'Insert') {

              // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $firstname  =$_POST['firstname'];
          $lastname   =$_POST['lastname'];
          $classname  =$_POST['classname'];
          $sectionname    =$_POST['sectionname'];



          $firstn  =$_POST['firstn'];
          $lastn   =$_POST['lastn'];
          $classn  =$_POST['classn'];
          $sectionn    =$_POST['sectionn'];

          



          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

            //Insert The DataBase
            
            $stmt = $con->prepare("INSERT INTO 
                                    student(First_Name , Last_Name , Register_Date , Class_ID , Section_ID  )
                                    VALUES(:zfirstname, :zlastname , now() ,:zclassname , :zsectionname )");
            $stmt->execute(array(

                'zfirstname' => $firstname,
                'zlastname' => $lastname,
                'zclassname' => $classname,
                'zsectionname' => $sectionname,

                
                
              ));



            $stmt = $con->prepare("INSERT INTO 
                                    student(First_Name , Last_Name , Register_Date , Class_ID , Section_ID  )
                                    VALUES(:zfirstn, :zlastn, now() ,:zclassn , :zsectionn )");
            $stmt->execute(array(

                'zfirstn' => $firstn,
                'zlastn' => $lastn,
                'zclassn' => $classn,
                'zsectionn' => $sectionn,

                
                
              ));


            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';

            $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Student Inserted </div>";

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