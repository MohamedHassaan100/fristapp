 <?php

/*
=======================================
Template Page
=======================================
*/

   ob_start();

   session_start();

  

   $pageTitle = 'Attendance';

    if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){

         
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


          //Select Section one And Class A

                  $stm =$con->prepare("SELECT student.* , 
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
                                       manage_section.Sec_ID = student.Section_ID

                                WHERE 
                                      Sec_Name='A' 
                                AND   
                                      ClassName='one';
                                      
                                       ");


           //Execute The Statment

          $stm->execute();

          //ASSIGN TO VARIABLE

          $stms=$stm->fetchAll();

          //Select Class one And Section B

            
                         $st =$con->prepare("SELECT student.* , 
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
                                       manage_section.Sec_ID = student.Section_ID

                                WHERE 
                                      Sec_Name='B' 
                                AND   
                                      ClassName='one';
                                      
                                       ");


           //Execute The Statment

          $st->execute();

          //ASSIGN TO VARIABLE

          $sts=$st->fetchAll();



            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Take Attendance Student</h1>   
 
           <div class="container">
            <form class="form-horizontal" action="?do=Edit" method="POST">

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

       
                <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Take Attendance" class="btn btn-primary btn-md">
                    </div>
                 </div>

            </form>
           </div>


            
        

  <?php  

     }elseif ($do == 'Edit'){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 /*   

          if(isset($_POST['submit'])){

          foreach($_POST['attendence_status'] as $id=>$attendence_status ){
           $student_name= $_POST['First_Name'][$id];
           $roll_number= $_POST['Student_ID'][$id];
        
     
          $stmt = $con->prepare("INSERT INTO 
                                    attendance(id , Name_Student , attendence_status ,roll_number  )
                                    VALUES(:zattendid, :znamestudent ,:zstatusstudent,:zrollnumber)");



          $stmt->execute(array(

                'zattendid' => $id,
                'zlastname' => $student_name,
                'zstatusstudent' => $attendence_status,
                'zrollnumber' => $roll_number,
                  
              ));


          if($stmt){
           $flag=1;
         }

  } 

}

*/
           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Take Attendance</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $classname  =$_POST['classname'];
          $sectionname    =$_POST['sectionname'];

          #echo "$classname";
          #echo "<br>";
          #echo "$sectionname";


          //validate Form
           $formErrors =array();
           if($classname == 0){
              $formErrors[]= 'You Must Chosse Class From List';
           }
           if($sectionname == 0){
              $formErrors[]= 'You Must Chosse Section From List';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }

            //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){  

            ?>

            <?php //Select Class one And Section A

                  $stm =$con->prepare("SELECT student.* , 
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
                                       manage_section.Sec_ID = student.Section_ID

                                WHERE 
                                      Sec_Name='B' 
                                AND   
                                      ClassName='one';
                                      
                                       ");


           //Execute The Statment

          $stm->execute();

          //ASSIGN TO VARIABLE

          $stms=$stm->fetchAll();  

           //Select Class one And Section B

            $st =$con->prepare("SELECT student.* , 
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
                                       manage_section.Sec_ID = student.Section_ID

                                WHERE 
                                      Sec_Name='A' 
                                AND   
                                      ClassName='Two';
                                      
                                       ");


           //Execute The Statment

          $st->execute();

          //ASSIGN TO VARIABLE

          $sts=$st->fetchAll();


             // one , B
            
              if ($classname == 9 && $sectionname == 20) {  ?>

          <form action="take_attendance.php?do=Manage" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Name</td>
                   <td>Control</td>
                   <td>Numer</td>
                  
                </tr>

              
      

                 <?php
                 
                 $serialnumber=0;
                 $counter=0;


                 foreach ($stms as $ros) {

                    $serialnumber++;

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> 
                      <input type="hidden" value="<?php echo $ros['Name']; ?>" name="Name[]">
                      </td>

                      <td> <?php echo $ros['Student_ID']; ?> 
                      <input type="hidden" value="<?php echo $ros['Student_ID']; ?>" name="Student_ID[]">
                      </td>

                      <td>
                      <input type="radio" name="Status_Student[<?php echo $counter ?>]" value="Present"  >Present
                      <input type="radio" name="Status_Student[<?php echo $counter ?>]" value="Absent">Absent
                      </td>
                      
                      
                    </tr>
<?php
                  $counter++; 
                 }



                  
                      
                     


                ?>
              
              </table>
            </div>
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
            <a href="attendance.php?do=Edit" class="btn btn-primary"> Edit Info </a>
        </form>

<?php

              }

              // two , A

            elseif ($classname == 10 && $sectionname == 11) {  ?>

          <form action="take_at_B.php?do=Manage" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Name</td>
                   <td>Control</td>
                   <td>Numer</td>
                  
                </tr>

              
      

                 <?php
                 
                 $serialnumber=0;
                 $counter=0;


                 foreach ($sts as $ros) {

                    $serialnumber++;

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> 
                      <input type="hidden" value="<?php echo $ros['Name']; ?>" name="Name[]">
                      </td>

                      <td> <?php echo $ros['Student_ID']; ?> 
                      <input type="hidden" value="<?php echo $ros['Student_ID']; ?>" name="Student_ID[]">
                      </td>

                      <td>
                      <input type="radio" name="Status_Student[<?php echo $counter ?>]" value="Present"  >Present
                      <input type="radio" name="Status_Student[<?php echo $counter ?>]" value="Absent">Absent
                      </td>
                      
                      
                    </tr>
<?php
                  $counter++; 
                 }



                  
                      
                     


                ?>
              
              </table>
            </div>
            <input type="submit" name="submit" value="submit" class="btn btn-primary">
            <a href="attendance.php?do=Edit" class="btn btn-primary"> Edit Info </a>
        </form>

<?php

              }



           }



        }

     }elseif ($do == 'Add') {  ?>

        <?php

        
    
        
  



        ?>
      

       
 <?php    }






    include $tpl . 'footer.php';

   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>