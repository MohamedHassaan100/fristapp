<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Manage Payment';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

           if ($do == 'Manage') {
           	 
           	          //Select All User Expect Admin

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

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Manage Payment</h1>   
 
           <div class="container">


              <div class="col-sm-8" style="margin-bottom: 20px;">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                       <i class="fa fa-tag"></i> Manage Classes
                    </div>
                    <div class="card-footer">
                     <ul class="list-unstyled latest-users">
                       <span class="form-control" style="background-color: #3Babc3;padding: 13px;"><a  style="text-decoration: none;position: absolute;top: 2.5px;cursor: pointer;color: white;">Manage Payment </a> </span>
                        <span class="form-control" style="background-color: white;padding: 13px; margin-top: 10px;"><a href="manageStudentPayment.php" style="text-decoration: none;position: absolute;top: 2.5px;color: black;">Manage Student Payment</a></span>
                     </ul>
                    </div>
                </div>
              </div>








            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Payment Name</td>
                   <td>Start Date</td>
                   <td>End Date</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Payment_ID'] . "</td>";
                      echo "<td>" . $row['Payment_Name'] . "</td>";
                      echo "<td>" . $row['Start_Date'] . "</td>";
                      echo "<td>" . $row['End_Date'] . "</td>";
                      echo "<td>
                              <a href='managePayment.php?do=Edit&payid=" .$row['Payment_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='managePayment.php?do=Delete&payid=" .$row['Payment_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
           </div>


            
        

  <?php  


      }elseif($do == 'Edit'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $payid= isset($_GET['payid']) && is_numeric($_GET['payid']) ? intval($_GET['payid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM student_payment WHERE Payment_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($payid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Payment</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="payid" value="<?php echo $payid ?>"/>
               
               <!-- Start Class Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Class Name :</label>
                    <div class="col-md-10">
                       <select name="classname" class="form-control">
                      
                         <?php
                          $stmt= $con->prepare("SELECT * FROM manage_class");
                          $stmt->execute();
                          $cls =$stmt->fetchAll();
                          foreach ($cls as $cl) {
                            echo "<option value='" .$cl['ID'] . "'" ;
                             if($row['Class_Name'] == $cl['ID']){ echo 'selected';}
                            echo ">" . $cl['ClassName'] . "</option>";
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
                         
                         <?php
                          $stmt= $con->prepare("SELECT * FROM manage_section");
                          $stmt->execute();
                          $secs =$stmt->fetchAll();
                          foreach ($secs as $sec) {
                            echo "<option value='" . $sec['Sec_ID'] . "'";
                            if($row['Section_Name'] == $sec['Sec_ID']){ echo 'selected';}
                            echo ">" . $sec['Sec_Name'] . "</option>";
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
                          
                        <?php
                          $stmt= $con->prepare("SELECT * FROM student");
                          $stmt->execute();
                          $stds =$stmt->fetchAll();
                          foreach ($stds as $std) {
                            echo "<option value='" . $std['Student_ID'] . "'";
                            if($row['Student_Name'] == $std['Student_ID']){ echo 'selected';}
                            echo ">" . $std['Name'] ."</option>";
                          }

                        ?>

                       </select>
                    </div>
                 </div>
                <!-- End Student Field -->
                 


                 <div class="form-group">
                  <label class="col-md-2 control-label">Payment Name<span style="color: red;font-size: 22px;margin-left: 4px;">*</span> :</label>
                    <div class="col-md-10">
                    <input type="text" name="paymentname"  value="<?php echo $row['Payment_Name']; ?>" class="form-control" autocomplete="off" placeholder="Payment Name Of The Student">
                    </div>
                 </div>

 

                 <div class="form-group">
                  <label class="col-md-2 control-label">Start Date :</label>
                    <div class="col-md-10">
                    <input type="date" name="startdate" value="<?php echo $row['Start_Date']; ?>" class="form-control" placeholder="Enter The Start Date">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">End Date :</label>
                    <div class="col-md-10">
                    <input type="date" name="enddate" value="<?php echo $row['End_Date']; ?>" class="form-control" placeholder="Enter The End Date">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Amount<span style="color: red;font-size: 22px;margin-left: 4px;">*</span> :</label>
                    <div class="col-md-10">
                    <input type="text" name="totalamount" value="<?php echo $row['Total_Amount']; ?>"  class="form-control" autocomplete="off" placeholder="Enter Amount Of Payment">
                    </div>
                 </div>
                 

                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Save" class="btn btn-primary btn-lg">
                   
                    </div>
                 </div>

               </form>
            </div>

           <?php   

            
         }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger">Theres  No Such Id</div>';

          redirectHome($theMsg);

          echo "</div>";

         }

     }elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Update Payment</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
          $id             =$_POST['payid'];
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

          //Update The DataBase
          $stmt=$con->prepare("UPDATE student_payment SET Class_Name=? , Section_Name=? , Student_Name=? , Payment_Name=? , Start_Date= ? , End_Date= ? , Total_Amount= ?   WHERE Payment_ID=?");
            $stmt->execute(array($classname , $sectionname , $studentname , $paymentname , $startdate , $enddate , $totalamount , $id));

          //Success Message

          $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Payment Updated </div>";

          redirectHome($theMsg , 'back');

           }

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";
    }


        include $tpl . 'footer.php';

        }else{
          
          header('Location: index.php');
          
          exit();
        }