<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Teachers';
        

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $flag=0;
           

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

         //Start manage page

          if($do == 'Manage'){ //Manage Members Page 

          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT * FROM teacher");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


            ?>

        
         
         
          <div class="container">
           
            
            <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Manage Teachers</h1> 

          
            <div class="panel-body">
            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Name</td>
                   <td>Age</td>
                   <td>Contact</td>
                   <td>Email</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Teacher_ID'] . "</td>";
                      echo "<td>" . $row['Name'] . "</td>";
                      echo "<td>" . $row['Age'] . "</td>";
                      echo "<td>" . $row['Contact'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>
                              <a href='teacher.php?do=Edit&teacherid=" .$row['Teacher_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='teacher.php?do=Delete&teacherid=" .$row['Teacher_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            <a href="teacher.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Teacher </a>
            </div>
         
          </div>
            
        

  <?php  }elseif ($do == 'Add') { //Add Members Page  ?>

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Teacher</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Name :</label>
                    <div class="col-md-10">
                  	<input type="text" name="firstname"  class="form-control" autocomplete="off" required="required" placeholder="FirstName Of The Teacher">
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
                  	<input type="text" name="contact" class="form-control" required="required" placeholder="Contact of The Teacher">
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

                  <div class="form-group">
                  <label class="col-md-2 control-label">Job_Type :</label>
                    <div class="col-md-10">
                       <select name="jobType" class="form-control">
                         <option value="0">Select an option</option>
                         <option value="1">Full Time</option>
                         <option value="2">Part Time</option>
                       </select>
                    </div>
                 </div>


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                  	<input type="submit" value="Add Teacher" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>

           

    <?php 
    }elseif($do == 'Insert'){

     // Insert Member Page
      
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
          
           
           
           echo "<h1 class='text-center' style='color:#888;font-size: 35px;font-weight: bold'>Insert Teacher</h1>";   
           
           echo "<div class='container'>";

          //Get Variable From Form
        	$firstname  =$_POST['firstname'];
        	$age  =$_POST['age'];
        	$contact =$_POST['contact'];
        	$email  =$_POST['email'];
          $address  =$_POST['address'];
          $city  =$_POST['city'];
          $country  =$_POST['country'];
          $jobtype   =$_POST['jobType'];
          

        	
          //validate Form
           $formErrors =array();
           if(strlen($firstname)< 2){
           	  $formErrors[]= 'Name Cant Be Less Than <strong>4 character</strong>';
           }
           if(empty($firstname)){
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
           if($jobtype == 0){
              $formErrors[]= 'You Must Choose<strong> Job Type</strong>';
           }
           foreach ($formErrors as  $error) {
           	  echo '<div class="alert alert-danger">' . $error . '</div>';
           }

          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

            //Insert The DataBase
          	
            $stmt = $con->prepare("INSERT INTO 
                                    teacher(Name ,Age , Contact , Email , Address , City , Country , Job_Type )
                                    VALUES(:zfirstname,:zage, :zcontact, :zemail, :zaddress, :zcity, :zcountry , :zjobtype)");

             

            $stmt->execute(array(

                'zfirstname' => $firstname,
                'zage' => $age,
                'zcontact' => $contact,
                'zemail' => $email,
                'zaddress' => $address,
                'zcity' => $city,
                'zcountry' => $country,
                'zjobtype' => $jobtype,
                
              ));

              

            //Success Message

          //	echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';


            $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Teacher Inserted </div>";

            redirectHome($theMsg , 'back');
          }

           

        }else{

          echo "<div class='container'>";

        	$theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg , 'back');

          echo "</div>";
        }

        echo "</div>";
        


    } elseif($do == 'Edit'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $teacherid= isset($_GET['teacherid']) && is_numeric($_GET['teacherid']) ? intval($_GET['teacherid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM teacher WHERE Teacher_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($teacherid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Teacher</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="userid" value="<?php echo $teacherid ?>"/>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Name :</label>
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

       echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Update Teacher</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
        	$userid    =$_POST['userid'];
        	$firstname    =$_POST['firstname'];
        	$age  =$_POST['age'];
        	$contact  =$_POST['contact'];
        	$email =$_POST['email'];
          $address =$_POST['address'];
          $city =$_POST['city'];
          $country =$_POST['country'];

          //validate Form
             $formErrors =array();
           if(strlen($firstname)< 2){
           	  $formErrors[]= 'Name Cant Be Less Than <strong>4 character</strong>';
           }
           if(empty($firstname)){
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
        	$stmt=$con->prepare("UPDATE teacher SET First_Name=? ,Age=? , Contact=? , Email= ? , Address= ? , City= ? , Country= ?   WHERE Teacher_ID=?");
            $stmt->execute(array($firstname ,$age , $contact , $email , $address , $city , $country , $teacherid));

          //Success Message

        	$theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Teacher Updated </div>";

          redirectHome($theMsg , 'back');

           }

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";


     }elseif($do == 'Delete'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Teacher</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $teacherid= isset($_GET['teacherid']) && is_numeric($_GET['teacherid']) ? intval($_GET['teacherid']) : 0;
         
      //Select all Data Depend On ID

       $check = checkItem('Teacher_ID' , 'teacher' , $teacherid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM teacher WHERE Teacher_ID=:zuser");

         $stmt->bindParam(":zuser" , $teacherid);

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