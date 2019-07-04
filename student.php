<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Student';
        $flag=0;

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

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Manage Students</h1>   
 
           <div class="container">
            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Name</td>
                   <td>Age</td>
                   <td>Contact</td>
                   <td>Email</td>
                   <td>Class Name</td>
                   <td>Section Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Student_ID'] . "</td>";
                      echo "<td>" . $row['Name'] . "</td>";
                      echo "<td>" . $row['Age'] . "</td>";
                      echo "<td>" . $row['Contact'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>" . $row['ClassName'] . "</td>";
                      echo "<td>" . $row['Sec_Name'] . "</td>";
                      echo "<td>
                              <a href='student.php?do=Edit&studentid=" .$row['Student_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='student.php?do=Delete&studentid=" .$row['Student_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            <a href="student.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Student </a>
           </div>


            
        

  <?php  }elseif ($do == 'Add') { //Add Members Page  ?>

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Student</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Name Student :</label>
                    <div class="col-md-10">
                    <input type="text" name="namestd"  class="form-control" autocomplete="off" required="required" placeholder="Name Of The Student">
                    </div>
                 </div>

                  <div class="form-group">
                  <label class="col-md-2 control-label">User Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="username"  class="form-control" autocomplete="off" required="required" placeholder="User Name Of The Student">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Password :</label>
                    <div class="col-md-10">
                    <input type="password" name="passe"  class="form-control" autocomplete="off" required="required" placeholder="Password Of The Student">
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Age :</label>
                    <div class="col-md-10">
                    <input type="text" name="age" class="form-control"  placeholder="Age Of The Teacher">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Contact :</label>
                    <div class="col-md-10">
                    <input type="text" name="contact" class="form-control" required="required" placeholder="Contact of The Student">
                    </div>
                 </div>
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Email :</label>
                    <div class="col-md-10">
                    <input type="email" name="email" class="form-control" required="required" placeholder="Email Must Be Valid">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Address :</label>
                    <div class="col-md-10">
                    <input type="text" name="address" class="form-control" required="required" placeholder="Address Must Be Valid">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">City :</label>
                    <div class="col-md-10">
                    <input type="text" name="city" class="form-control" required="required" placeholder="City Must Be Valid">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Country :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" class="form-control" required="required" placeholder="Country Must Be Valid">
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
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Semester :</label>
                    <div class="col-md-10">
                    <input class="form-control" name="semester" type="text" placeholder="The Semester" readonly>
                    </div>
                 </div>
                 
                <!-- End Member Field -->


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Student" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>

           

    <?php 
    }elseif($do == 'Insert'){

     // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $namestd  =$_POST['namestd'];
          $username   =$_POST['username'];
          $passe      =$_POST['passe'];
          $pass       =sha1($passe);
          $age        =$_POST['age'];
          $contact    =$_POST['contact'];
          $email      =$_POST['email'];
          $address    =$_POST['address'];
          $city       =$_POST['city'];
          $country    =$_POST['country'];
          $classname  =$_POST['classname'];
          $sectionname    =$_POST['sectionname'];
          $semester    ='1st';
         
          
          //validate Form
           $formErrors =array();
           if(strlen($namestd)< 2){
              $formErrors[]= 'Name Cant Be Less Than <strong>4 character</strong>';
           }
           if(empty($namestd)){
              $formErrors[]= 'Name Cant Be Empty';
           }
           if(empty($age)){
              $formErrors[]= 'Age Cant Be Empty';
           }
           if(empty($contact)){
              $formErrors[]= 'Contact Cant Be Empty';
           }
           if(empty($email)){
              $formErrors[]= 'Email Cant Be Empty';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }

          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

            //Insert The DataBase Into Student
            
           $stmt = $con->prepare("INSERT INTO 
                                    student(Name , User_Name , Pass ,Semester ,Age , Add_Date , Contact , Email , Address , City , Country , Register_Date , Class_ID , Section_ID )
                                    VALUES(:znamestd, :zusername , :zpass ,:zsemester ,:zage, now() ,:zcontact, :zemail, :zaddress, :zcity, :zcountry , now(),:zclassname , :zsectionname )");
            $stmt->execute(array(

                'znamestd' => $namestd,
                'zusername' => $username,
                'zpass' => $pass,
                'zsemester' => $semester,
                'zage' => $age,
                'zcontact' => $contact,
                'zemail' => $email,
                'zaddress' => $address,
                'zcity' => $city,
                'zcountry' => $country,
                'zclassname' => $classname,
                'zsectionname' => $sectionname,

                
                
              ));



            //Insert The DataBase Into Users
            
           $stmt = $con->prepare("INSERT INTO 
                                    users(Username , Password , Email , FullName ,  GroupID )
                                    VALUES(:zusername , :zpass , :zemail, :znamestd, '1' )");
            $stmt->execute(array(

                'zusername' => $username,
                'zpass' => $pass,
                'zemail' => $email,
                'znamestd' => $namestd,


                
                
              ));



           

            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';
            $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Student Inserted </div>";

             redirectHome($theMsg);
          }

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg);

          echo "</div>";
        }

        echo "</div>";




    } elseif($do == 'Edit'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM student WHERE Student_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($studentid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Student</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="studentid" value="<?php echo $studentid ?>"/>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Student Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="firstname" value="<?php echo $row['Name'] ?>" class="form-control" autocomplete="off" required="required">
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Age :</label>
                    <div class="col-md-10">
                    <input type="text" name="age" value="<?php echo $row['Age'] ?>" class="form-control" autocomplete="off" required="required">
                    </div>
                 </div>
                 <div class="form-group">
                  <label class="col-md-2 control-label">Contact :</label>
                    <div class="col-md-10">
                    <input type="text" name="contact" value="<?php echo $row['Contact']; ?>" class="form-control" required="required">
                    </div>
                 </div>
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Email :</label>
                    <div class="col-md-10">
                    <input type="email" name="email" value="<?php echo $row['Email']; ?>" class="form-control" required="required">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Address :</label>
                    <div class="col-md-10">
                    <input type="text" name="address" value="<?php echo $row['Address']; ?>" class="form-control" required="required">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">City :</label>
                    <div class="col-md-10">
                    <input type="text" name="city" value="<?php echo $row['City']; ?>" class="form-control" required="required">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Country :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" value="<?php echo $row['Country']; ?>" class="form-control" required="required">
                    </div>
                 </div>

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
                             if($row['Class_ID'] == $cl['ID']){ echo 'selected';}
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
                            if($row['Section_ID'] == $sec['Sec_ID']){ echo 'selected';}
                            echo ">" . $sec['Sec_Name'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                 <!-- End Section Field -->
                 

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

     } elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Update Student</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
          $id    =$_POST['studentid'];
          $namestd    =$_POST['namestd'];
          $age          =$_POST['age'];
          $contact      =$_POST['contact'];
          $email        =$_POST['email'];
          $address      =$_POST['address'];
          $city         =$_POST['city'];
          $country      =$_POST['country'];
          $classname    =$_POST['classname'];
          $sectionname  =$_POST['sectionname'];

          //validate Form
             $formErrors =array();
           if(strlen($namestd)< 2){
              $formErrors[]= 'Name Cant Be Less Than <strong>4 character</strong>';
           }
           if(empty($namestd)){
              $formErrors[]= 'Name Cant Be Empty';
           }
           if(empty($email)){
              $formErrors[]= 'Email Cant Be Empty';
           }
           if(empty($contact)){
              $formErrors[]= 'Email Cant Be Empty';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }


          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

          //Update The DataBase
          $stmt=$con->prepare("UPDATE student SET Name=? , Age=? , Contact=? , Email= ? , Address= ? , City= ? , Country= ? , Class_ID=? , Section_ID=?  WHERE Student_ID=?");
            $stmt->execute(array($namestd , $age , $contact , $email , $address , $city , $country , $classname , $sectionname , $id));

          //Success Message

          $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Student Updated </div>";

          redirectHome($theMsg , 'back');

           }

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";


     }elseif($do == 'Delete'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Student</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;
         
      //Select all Data Depend On ID

       $check = checkItem('Student_ID' , 'student' , $studentid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM student WHERE Student_ID=:zuser");

         $stmt->bindParam(":zuser" , $studentid);

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

     }else{
          
          header('Location: index.php');
          
          exit();
        }
