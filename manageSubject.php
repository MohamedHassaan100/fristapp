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

          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT manage_subject.* , 
                                       teacher.Name 
                                       
                                From 
                                       manage_subject
                                INNER JOIN 
                                       teacher 
                                ON 
                                       teacher.Teacher_ID = manage_subject.Teach_ID;");
                              
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $subjects=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Manage Subject</h1>   
           


                     




           <div class="container">


            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>#ID</td>
                   <td>Subject Name</td>
                   <td>Teacher Name</td>
                   <td>Total Hour</td>
                   <td>Total Mark</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($subjects as $subj) {
                    echo "<tr>";
                      echo "<td>" . $subj['Sub_ID'] . "</td>";
                      echo "<td>" . $subj['Sub_Name'] . "</td>";
                      echo "<td>" . $subj['Name'] . "</td>";
                      echo "<td>" . $subj['Sub_Hour'] . "</td>";
                      echo "<td>" . $subj['Total_Mark'] . "</td>";
                      echo "<td>
                              <a href='manageSubject.php?do=Edit&subid=" .$subj['Sub_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='manageSubject.php?do=Delete&subid=" .$subj['Sub_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                        echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            <a href="manageSubject.php?do=Add" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add New Subject </a>
           </div>
            
<?php

     } elseif ($do == 'Add') { ?>

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Subjects</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">

                 <!-- Start ID Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Code :</label>
                    <div class="col-md-10">
                    <input type="text" name="subcode"  class="form-control"   placeholder="Code Of The Subject">
                    </div>
                 </div>
                 <!-- End ID Field -->

                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subname"  class="form-control"  required="required" placeholder="Name Of The Item">
                    </div>
                 </div>
                 <!-- End Name Field -->

                 <!-- Start Mark Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="totmark"  class="form-control"  required="required" placeholder="Total Mark Of Subject">
                    </div>
                 </div>
                 <!-- End Mark Field -->

                 <!-- Start Hour Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="tothour"  class="form-control"  required="required" placeholder="Total Hour Of Subject">
                    </div>
                 </div>
                 <!-- End Hour Field -->

                 <!-- Start Member Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Teacher Name :</label>
                    <div class="col-md-10">
                       <select name="teachname" class="form-control">
                         <option value="0">..........</option>
                         <?php
                          $stmt= $con->prepare("SELECT * FROM teacher");
                          $stmt->execute();
                          $teachs =$stmt->fetchAll();
                          foreach ($teachs as $teach) {
                            echo "<option value='" .$teach['Teacher_ID'] . "'>" . $teach['Name'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                 <!-- End Member Field -->
                 <!-- Start Submit Field -->
                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Subject" class="btn btn-primary btn-sm">
                    </div>
                 </div>
                 <!-- End Submit Field -->

               </form>
            </div>


         <?php
      
     }elseif ($do == 'Insert'){

          // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Subject</h1>";
           echo "<div class='container'>";

          //Get Variable From Form       
          $subcode       =$_POST['subcode'];
          $subname       =$_POST['subname'];
          $teachname     =$_POST['teachname'];
          $totmark       =$_POST['totmark'];
          $tothour       =$_POST['tothour'];

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
                                    manage_subject(Sub_ID,Sub_Name , Teach_ID,Total_Mark,Sub_Hour)
                                    VALUES(:zsubcode,:zname, :zteach ,:ztotmark, :ztothour)");
            $stmt->execute(array(
                
                'zsubcode'     => $subcode,
                'zname'       => $subname,
                'zteach'      => $teachname,
                'ztotmark'    => $totmark,
                'ztothour'    => $tothour,

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

                <!-- Start Code Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Code :</label>
                    <div class="col-md-10">
                    <input type="text" name="subcode"  class="form-control"  required="required"  value="<?php echo $sub['Sub_ID']; ?>">
                    </div>
                 </div>
                 <!-- End Code Field -->

                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subname"  class="form-control"  required="required"  value="<?php echo $sub['Sub_Name']; ?>">
                    </div>
                 </div>
                 <!-- End Name Field -->

                 <!-- Start Mark Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="totmark"  class="form-control"  required="required"  value="<?php echo $sub['Total_Mark']; ?>">
                    </div>
                 </div>
                 <!-- End Mark Field -->

                 <!-- Start Hour Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Total Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="totmark"  class="form-control"  required="required"  value="<?php echo $sub['Sub_Hour']; ?>">
                    </div>
                 </div>
                 <!-- End Hour Field -->

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
                            echo ">" . $teach['Name']."</option>";
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

      
     }elseif($do == 'Delete'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Subject</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $subid= $_GET['subid'];


         
      //Select all Data Depend On ID

       $check = checkItem('Sub_ID' , 'manage_subject' , $subid);

        if($check > 0){   
         

         $stmt = $con->prepare("DELETE  FROM manage_subject WHERE Sub_ID=:zuser");

         $stmt->bindParam(":zuser" , $subid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Record Deleted </div>';

           redirectHome($theMsg  , 'back');  

        }else{

          $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

          redirectHome($theMsg);

        }
         
         echo '</div>';
     }    

      include $tpl . 'footer.php';
       
   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>