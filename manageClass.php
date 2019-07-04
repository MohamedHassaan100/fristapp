<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Manage Class';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

         //Start manage page

          if($do == 'Manage'){ //Manage Members Page 

          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT * FROM manage_class");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Manage Class</h1>   
 
           <div class="container">
            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Class Name</td>
                   <td>Numeric Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['ID'] . "</td>";
                      echo "<td>" . $row['ClassName'] . "</td>";
                      echo "<td>" . $row['NumericName'] . "</td>";
                      echo "<td>
                              <a href='manageClass.php?do=Edit&userid=" . $row['ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='manageClass.php?do=Delete&userid=" . $row['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";

                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            <a href="manageClass.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Class </a>
           </div>
            
        

  <?php  }elseif ($do == 'Add') { //Add Members Page  ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Add New Class</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Class Name :</label>
                    <div class="col-md-10">
                  	<input type="text" name="name"  class="form-control" autocomplete="off" required="required" placeholder="Name Of The Class ">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Numeric Name :</label>
                    <div class="col-md-10">
                  	<input type="text" name="numeric" class="form-control"  placeholder="Number Of Class">
                  	
                    </div>
                 </div>
                


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                  	<input type="submit" value="Add Class" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>

           

    <?php 
    }elseif($do == 'Insert'){

     // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Insert Class</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
        	$name  =$_POST['name'];
        	$numeric  =$_POST['numeric'];


            //Insert The DataBase
          	
            $stmt = $con->prepare("INSERT INTO 
                                    manage_class(ClassName , NumericName)
                                    VALUES(:zname, :znumeric)");
            $stmt->execute(array(

                'zname' => $name ,
                'znumeric' => $numeric
              ));

            //Success Message

          //	echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';

            $theMsg ="<div class='alert alert-success'>" . $stmt->rowCount() . " Class Inserted </div>";

            redirectHome($theMsg , 'back');
          

           

        }else{

          echo "<div class='container'>";

        	$theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg , 'back');

          echo "</div>";
        }

        echo "</div>";


    } elseif($do == 'Edit'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_class WHERE ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($userid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Edit Class</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="userid" value="<?php echo $userid ?>"/>
                 <div class="form-group">
                  <label class="col-md-2 control-label">Class Name :</label>
                    <div class="col-md-10">
                  	<input type="text" name="name" value="<?php echo $row['ClassName']; ?>" class="form-control" autocomplete="off" required="required">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Numeric Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="numeric" value="<?php echo $row['NumericName']; ?>" class="form-control" autocomplete="off" required="required">
                    </div>
                                        

                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                  	<input type="submit" value="Save" class="btn btn-secondary btn-md" style="margin-top: 20px;">
                    </div>
                 </div>

               </form>


    <?php

                  //Select All User Expect Admin

          $stmt =$con->prepare("SELECT manage_section.* , 
                                       teacher.Name AS name 
                                       
                                From 
                                       manage_section
                                INNER JOIN 
                                       teacher 
                                ON 
                                       teacher.Teacher_ID = manage_section.Teach_ID;
                                       
                                WHERE  Class_Sec = ?

                                       ");
                              
 
          //Execute The Statment

          $stmt->execute(array($userid));

          //ASSIGN TO VARIABLE

          $sections=$stmt->fetchAll();


            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Manage Section [<?php echo $row['ClassName']; ?>]</h1>   
 
  
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
                      echo "<td>" . $section['name'] . "</td>";
                      
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

         }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger">Theres  No Such Class</div>';

          redirectHome($theMsg);

          echo "</div>";

         }

     } elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Update Class</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
        	$userid    =$_POST['userid'];
        	$name    =$_POST['name'];
        	$numeric  =$_POST['numeric'];

          //validate Form
             $formErrors =array();
           if(strlen($name)< 2){
           	  $formErrors[]= 'Name Cant Be Less Than <strong>4 character</strong>';
           }
           if(empty($name)){
              $formErrors[]= 'Name Cant Be Empty';
           }
           if(empty($numeric)){
              $formErrors[]= 'NumericName Cant Be Empty';
           }
           foreach ($formErrors as  $error) {
           	  echo '<div class="alert alert-danger">' . $error . '</div>';
           }


          //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){

          //Update The DataBase
        	$stmt=$con->prepare("UPDATE manage_class SET ClassName=? , NumericName=?  WHERE ID=?");
            $stmt->execute(array($name , $numeric , $userid));

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

      echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Delete Class</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $userid= isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;
         
      //Select all Data Depend On ID

       $check = checkItem('ID' , 'manage_class' , $userid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM manage_class WHERE ID=:zuser");

         $stmt->bindParam(":zuser" , $userid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Class Deleted </div>';

           redirectHome($theMsg , 'back' );  

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