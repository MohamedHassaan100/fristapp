 <?php

/*
=======================================
Template Page
=======================================
*/

   ob_start();

   session_start();

  

   $pageTitle = 'Teacher Mark';

    if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){



            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Make Distributed Subject</h1>   
 
           <div class="container">
            <form class="form-horizontal" action="?do=Edit" method="POST">

              <!-- Start Name Subject  Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                     <input class="form-control" name="subjname" type="text" placeholder="Enter Name Of Subject" >
                    </div>
                 </div>
                <!-- End Name Subject Field -->

                <!-- Start Number Semester  Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Number Semester :</label>
                    <div class="col-md-10">
                     <input class="form-control" name="numsem" type="text" placeholder="Enter Number Of Semester" >
                    </div>
                 </div>
                <!-- End Number Semester Field -->

       
                <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Get Information" class="btn btn-primary btn-md">
                    </div>
                 </div>

            </form>
           </div>


            
        

  <?php  

     }elseif ($do == 'Edit'){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


           echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Student Mark</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $subjname  =$_POST['subjname'];
          $numsem    =$_POST['numsem'];

      //Know The Id Of Semester one of Subject From Name of Subject 


      $ghgh =$con->prepare("SELECT Subj_One_ID FROM manage_subject_one WHERE Subj_Name=? ") ;
      
      //Execute Query
      
       $ghgh->execute(array($subjname)); 
      
      //Fetch The Data
      
       $kl =$ghgh->fetch();


          echo $subjname;
          echo $numsem;

          echo $kl[0];
            //Know The Id Of Semester one of Subject From Name of Subject 


      $klkl =$con->prepare("SELECT Subj_Two_ID FROM manage_subject_Two WHERE Subj_Name=? ") ;
      
      //Execute Query
      
       $klkl->execute(array($subjname)); 
      
      //Fetch The Data
      
       $fn =$klkl->fetch();

       echo $fn[0];


    
            ?>

            <?php //Select Subject For Semester One 

                  $stm =$con->prepare("SELECT student.* , 
                                       register_subject.*   
                                From 
                                       student
                                INNER JOIN 
                                       register_subject 
                                ON 
                                       register_subject.Std_ID = student.Student_ID

                                WHERE 
                                      Subject_ID='$kl[0]';
                                      
                                       ");


               //Execute The Statment

                $stm->execute();

                //ASSIGN TO VARIABLE

               $stms=$stm->fetchAll();  

               //Select Subject For Semester Two

                $mnmn =$con->prepare("SELECT student.* , 
                                       register_subject.*   
                                From 
                                       student
                                INNER JOIN 
                                       register_subject 
                                ON 
                                       register_subject.Std_ID = student.Student_ID

                                WHERE 
                                      Subject_ID_2='$fn[0]';
                                      
                                       ");


               //Execute The Statment

                $mnmn->execute();

                //ASSIGN TO VARIABLE

               $mns=$mnmn->fetchAll(); 


            
      if ($numsem == '1st') {  ?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Name</td>
                   <td>Control</td>
                   <td>Numer</td>
                  
                </tr>

              
      

                 <?php
                 



                 foreach ($stms as $ros) {



                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> </td>
                      <td> <?php echo $ros['Subject_ID']; ?> 

                      </td>
<?php
                      echo "<td>
                              <a href='teacher_mark.php?do=Ed&studentid=" .$ros['Student_ID'] . "&subjectid=".$ros['Subject_ID'] ." ' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>";

                      echo   "</td>";
                      
?>                    
                    </tr>
<?php
              
                 }

                ?>
              
              </table>
            </div>
            
        </form>

<?php

              }
     elseif ($numsem == '2st') {  ?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Name</td>
                   <td>Control</td>
                   <td>Numer</td>
                  
                </tr>

              
      

                 <?php
                 



                 foreach ($mns as $ros) {



                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> </td>
                      <td> <?php echo $ros['Subject_ID_2']; ?> 

                      </td>
<?php
                      echo "<td>
                              <a href='teacher_mark.php?do=Edi&studentid=" .$ros['Student_ID'] . "&subjectid=".$ros['Subject_ID_2'] ." ' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>";

                      echo   "</td>";
                      
?>                    
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

     }elseif ($do == 'Ed') {  

 
        //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;


       $subjectid= $_GET['subjectid'];
         
      #   echo $studentid;
        
      #  echo "<br>";
         
      #   echo $subjectid;

      //////////////////// //Get Degree Of Student //////////////////

          $st =$con->prepare("SELECT  register_subject.Subject_ID,register_subject.Degree,student.Name From student INNER JOIN register_subject  ON register_subject.Std_ID = student.Student_ID  WHERE Std_ID=? and Subject_ID=? LIMIT 1");

          $st->execute(array($studentid,$subjectid));


          $deg=$st->fetchAll(); 


      #    print_r($deg) ;

          foreach ($deg as $de ) {
          
          

       /////////////////////////////////////////////

       $count = $st->rowCount();

        if($st->rowCount() > 0){   ?>


        <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Degree Student</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="studentid" value="<?php echo $studentid ?>"/>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Degree :</label>
                    <div class="col-md-10">
                    <input type="text" name="degree" value="<?php echo $de['Degree'] ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Name Student :</label>
                    <div class="col-md-10">
                    <input type="text" name="name" value="<?php echo $de['Name'] ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="ftyt" value="<?php echo $de['Subject_ID']  ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                <input type="hidden" name="subid" value="<?php echo $subjectid ?>"/>

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


         }

       
    }elseif ($do == 'Edi') {  

 
        //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;


       $subjectid= $_GET['subjectid'];
         
      #   echo $studentid;
        
      #  echo "<br>";
         
      #   echo $subjectid;

      //////////////////// //Get Degree Of Student //////////////////

          $st =$con->prepare("SELECT  register_subject.Subject_ID_2,register_subject.Degree,student.Name From student INNER JOIN register_subject  ON register_subject.Std_ID = student.Student_ID  WHERE Std_ID=? and Subject_ID_2=? LIMIT 1");

          $st->execute(array($studentid,$subjectid));


          $deg=$st->fetchAll(); 


      #    print_r($deg) ;

          foreach ($deg as $de ) {
          
          

       /////////////////////////////////////////////

       $count = $st->rowCount();

        if($st->rowCount() > 0){   ?>


        <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Degree Student</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="studentid" value="<?php echo $studentid ?>"/>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Degree :</label>
                    <div class="col-md-10">
                    <input type="text" name="degree" value="<?php echo $de['Degree'] ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                <div class="form-group">
                  <label class="col-md-2 control-label">Name Student :</label>
                    <div class="col-md-10">
                    <input type="text" name="name" value="<?php echo $de['Name'] ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="ftyt" value="<?php echo $de['Subject_ID_2']  ?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                <input type="hidden" name="subid" value="<?php echo $subjectid ?>"/>

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


         }

       
    }elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Update Degree</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
          $studentid    =$_POST['studentid'];
          $degree       =$_POST['degree'];
          $name         =$_POST['name'];
          $subid        =$_POST['subid'];
 
          //Update The DataBase
          $stmt=$con->prepare("UPDATE register_subject SET Degree=?  WHERE Subject_ID=? and Std_ID=?");
            $stmt->execute(array($degree ,$subid ,$studentid));

          //Success Message

          $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Degree Updated </div>";

          redirectHome($theMsg , 'back');

        

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";


     }






    include $tpl . 'footer.php';

   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>