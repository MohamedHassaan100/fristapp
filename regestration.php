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

          if($do == 'Manage'){


            $er=$_SESSION['Username'];

     #       echo $er;

            $stu = array();
          //Get Information From Student Such Id

          $stmt =$con->prepare("SELECT Student_ID
                                FROM student WHERE User_Name='$er' ;");
 
          //Execute The Statment

          $stmt->execute(array($er));

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();



          $stu[]  = $rows;

        #  print "{allstudents :".json_encode($stu,JSON_UNESCAPED_UNICODE)."}";

         

?>
               
      <div style="width: 100%;height: 100%;padding: 50px;color: #FFF;text-shadow: 1px 1px 1px #333;background-image: linear-gradient( 135deg, #9f05ff69 10%, #fd5e086b 100%);border-radius: 0 0 85% 85% / 30%;">
            <h1 style="font-family: 'Dancing Script', cursive;font-size: 65px;margin-bottom: 30px;text-align: center;color: #e3efe4;">Simply The Best for Registration</h1>
            <h3 style="font-family: 'Open Sans', sans-serif;margin-bottom: 30px;text-align: center;">Reasons for Choosing US</h3>
            <p style="font-family: 'Open Sans', sans-serif;margin-bottom: 30px;text-align: center;">Simply make the recording method more clear and easier by following the instructions and guidances laid out on you for <span style="font-size: 15px;color: red;"> Registration </span> before That Make sure The information about you is correct.</p>
            <br>
<?php        
          foreach ($rows as $row) {
             echo "<a href='regestration.php?do=Edit&studentid=" . $row['Student_ID'] . "' class='badge badge-success' style='border: none;padding: 10px 20px;border-radius: 50px;color: #333;background: #fff;box-shadow: 0 3px 20px 0 #0000003b;margin-bottom: 50px;margin-left:500px;'>Click Here</a> " ;
          }
 ?>     
      </div>


<?php
          	 }elseif($do == 'Edit'){ //Edit Page 
        
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
                    <input type="text" name="address" value="<?php echo $row['Address']; ?>" class="form-control" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">City :</label>
                    <div class="col-md-10">
                    <input type="text" name="city" value="<?php echo $row['City']; ?>" class="form-control">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Country :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" value="<?php echo $row['Country']; ?>" class="form-control" >
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
                    <input type="submit" value="Save" class="btn btn-success btn-lg">

<?php

         $er=$_SESSION['Username'];

          $stmt =$con->prepare("SELECT Student_ID
                                FROM student WHERE User_Name='$er' ;");
 
          //Execute The Statment

          $stmt->execute(array($er));

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();






                    foreach ($rows as $row) {
             echo "<a href='subject_student.php?do=Manage&studentid=" . $row['Student_ID'] . "'  class='btn btn-info btn-lg '>Registration</a>" ;
          }
          
                   foreach ($rows as $row) {
             echo "<a href='viewSubject.php?do=Manage&studentid=" . $row['Student_ID'] . "'  class='btn btn-danger btn-lg ' style='margin-left:4px;'>View Subject</a>" ;
          }
              


?>

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

     } 


           include $tpl . 'footer.php';

     }else{
          
          header('Location: index.php');
          
          exit();
        }