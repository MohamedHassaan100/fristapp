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





                  

          ////////////////////////////////

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

          //////////////////////////
  
  
  if(isset($_POST['submit'])){
	  
	   foreach($_POST['Status_Student'] as $id=>$Status_Student ){
           $student_name= $_POST['First_Name'][$id];
           $roll_number= $_POST['Student_ID'][$id];

           echo $student_name;
        
     
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


  
 
  <div class="alert alert-primary" role="alert" style="margin-top: 80px;"> TAke absent Successfuly </div>




<?php

   }
    include $tpl . 'footer.php';

   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>