
<?php   

/*
=======================================
Items Page
=======================================
*/


   ob_start();

   session_start();

   $pageTitle = 'Manage Section';

   if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

     if($do == 'Manage'){

          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT manage_section.* , 
                                       teacher.Name ,
                                       manage_class.ClassName
                                       
                                From 
                                       manage_section
                                INNER JOIN 
                                       teacher 
                                ON 
                                       teacher.Teacher_ID = manage_section.Teach_ID
                                INNER JOIN 
                                       manage_class
                                ON  
                                       manage_section.Class_Sec = manage_class.ID;");
                              
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $sections=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Manage Section</h1>   
 
           <div class="container">
            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>#ID</td>
                   <td>Section Name</td>
                   <td>Teacher Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($sections as $section) {
                    echo "<tr>";
                      echo "<td>" . $section['Sec_ID'] . "</td>";
                      echo "<td>" . $section['Sec_Name'] . "</td>";
                      echo "<td>" . $section['Name'] . "</td>";
                      
                      echo "<td>
                              <a href='manageSection.php?do=Edit&secid=" .$section['Sec_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='manageSection.php?do=Delete&secid=" .$section['Sec_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                        echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            <a href="manageSection.php?do=Add" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Add New Section </a>
           </div>
            
<?php

     } elseif ($do == 'Add') { ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Add New Section</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Section Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="secname"  class="form-control"  required="required" placeholder="Name Of The Item">
                    </div>
                 </div>
                 <!-- End Name Field -->

                 <!-- Start Teacher Field -->
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
                            echo "<option value='" .$teach['Teacher_ID'] . "'>" . $teach['Name'] ."</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                 <!-- End Member Field -->
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
                 <!-- Start Submit Field -->
                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Section" class="btn btn-primary btn-sm">
                    </div>
                 </div>
                 <!-- End Submit Field -->

               </form>
            </div>


         <?php
      
     }elseif ($do == 'Insert'){

          // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Section</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $secname     =$_POST['secname'];
          $teachname     =$_POST['teachname'];
          $classname     =$_POST['classname'];

          echo $secname;
          echo '<br>';
          echo $teachname;


          //validate Form
           $formErrors =array();
           if(empty($secname)){
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
                                    manage_section(Sec_Name , Teach_ID , Class_Sec)
                                    VALUES(:zname, :zteach, :zclassname)");
            $stmt->execute(array(

                'zname'    => $secname,
                'zteach'    => $teachname,
                'zclassname'    => $classname,

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

          $secid= isset($_GET['secid']) && is_numeric($_GET['secid']) ? intval($_GET['secid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_section WHERE Sec_ID=? ") ;
      
      //Execute Query
      
       $stmt->execute(array($secid)); 
      
      //Fetch The Data
      
       $sec =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             
           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Add New Subjects</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                <input type="hidden" name="secid" value="<?php echo $secid ?>">
                 <!-- Start Name Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Section Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="secname"  class="form-control"  required="required"  value="<?php echo $sec['Sec_Name']; ?>">
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
                             if($sec['Teach_ID'] == $teach['Teacher_ID']){ echo 'selected';}
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
                    <input type="submit" value="Save Section" class="btn btn-primary btn-sm">
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

      
     } 

      include $tpl . 'footer.php';
       
   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>