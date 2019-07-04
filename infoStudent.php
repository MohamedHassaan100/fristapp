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

 ?>              
           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Make Distributed Subject</h1>   
 
           <div class="container">
            <form class="form-horizontal" action="?do=Edit" method="POST">

              <!-- Start Class Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Student Name :</label>
                    <div class="col-md-10">
	                   <input class="form-control" name="stdname" type="text" placeholder="Enter Name Of Student" >
                    </div>
                 </div>
                <!-- End Class Field -->

       
                <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Get Information" class="btn btn-primary btn-md">
                    </div>
                 </div>

            </form>
           </div>



<?php  }elseif($do == 'Edit'){ //Edit Page 
        
       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

         	echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'> Student Information</h1>";
            echo "<div class='container'>";
      
           $stdname  =$_POST['stdname'];

           $stmt =$con->prepare("SELECT * FROM student WHERE Name=? LIMIT 1 ") ;

           $stmt->execute(array($stdname)); 

           $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

              
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="stdname" value="<?php echo $stdname ?>"/>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Student Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="stdname" value="<?php echo $row['Name'] ?>" class="form-control" autocomplete="off" required="required">
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
                  <label class="col-md-2 control-label">UserName :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" value="<?php echo $row['User_Name']; ?>" class="form-control" required="required">
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
                  <label class="col-md-2 control-label">Date Register :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" value="<?php echo $row['Add_Date']; ?>" class="form-control" required="required">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Semester :</label>
                    <div class="col-md-10">
                    <input type="text" name="country" value="<?php echo $row['Semester']; ?>" class="form-control" required="required">
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

         
        

          $stmt =$con->prepare("SELECT Student_ID FROM student WHERE Name=? LIMIT 1 ") ;

          $stmt->execute(array($stdname));

          $row =$stmt->fetch();

          #print_r($row) ;

          #echo $row[0];


         $lnln =$con->prepare("SELECT Subject_ID,Subject_ID_2
                               FROM 
                                       register_subject 
                               WHERE 
                                       Std_ID=?") ;

          $lnln->execute(array($row[0]));

          $lnl =$lnln->fetchAll();



  ?>        

          <h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Subject Register</h1>
          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>Semester1</td>
                   <td>Semester2</td>
                  
                </tr>

                 <?php
                 
                 foreach ($lnl as $ln) {

                    ?>

                    <tr>         
                      <td> <?php echo $ln['Subject_ID']; ?> </td>
                      <td> <?php echo $ln['Subject_ID_2']; ?> </td>
                    </tr>
<?php
              
                 }

                ?>
              
              </table>
            </div>
            
        </form>


   <?php

        }

         

     }


 include $tpl . 'footer.php';

     }else{
          
          header('Location: index.php');
          
          exit();
        }
