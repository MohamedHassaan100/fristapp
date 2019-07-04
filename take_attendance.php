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

     $flag=0;

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

     if($do == 'Manage'){





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

  
  
  if(isset($_POST['submit'])){
    
     foreach($_POST['Status_Student'] as $id=>$Status_Student ){
           $student_name= $_POST['Name'][$id];
           $roll_number= $_POST['Student_ID'][$id];
        
         
        
           
        
     
         $srt = $con->prepare("INSERT INTO 
                                    attendance(id , Name_Student , attendence_status ,roll_number  )
                                    VALUES(:zattendid,:znamestudent ,:zstatusstudent,:zrollnumber)");



          $srt->execute(array(

                'zattendid' => $id,
                'znamestudent' => $student_name,
                'zstatusstudent' => $Status_Student,
                'zrollnumber' => $roll_number,
                  
              ));


          if($srt){
           $flag=1;
         }

  }  
  }
 

?>

<div class="panel panel-default">
  <div class="panel-heading">
    
  <?php if($flag){ ?>
  <div class="alert alert-success">
   Attendence Date Insert Successfully
  </div>
  <?php } ?>
  </div>
  
 
  
  <div class="panel-body">
  <form action="take_attendance.php" method="Post"> 
     <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Name</td>
                   <td>Control</td>
                   <td>BGTY</td>
                  
                </tr>

              
      

                 <?php
                 
                 $serialnumber=0;
                 $counter=0;


                 foreach ($stms as $ros) {

                    $serialnumber++;

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> 
                      <input type="hidden" value="<?php echo $ros['Name']; ?>" name="First_Name[]">
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
  
  <input type="submit" name="submit" value="submit" class="btn btn-primary">
  
  </form>
  </div>
</div>





<?php

   }
    include $tpl . 'footer.php';

   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>