 <?php

/*
=======================================
Template Page
=======================================
*/

   ob_start();

   session_start();

  

   $pageTitle = 'Make Distributed';

    if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){

         
          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT student.* , 
                                       manage_class.ClassName 
                                From 
                                       student
                                INNER JOIN 
                                       manage_class 
                                ON 
                                       manage_class.ID = student.Class_ID
");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


          //Select Section one And Class A

                  $stm =$con->prepare("SELECT student.* , 
                                       manage_class.ClassName
                                From 
                                       student
                                INNER JOIN 
                                       manage_class 
                                ON 
                                       manage_class.ID = student.Class_ID

                                WHERE 
                                  
                                      ClassName='one';
                                      
                                       ");


           //Execute The Statment

          $stm->execute();

          //ASSIGN TO VARIABLE

          $stms=$stm->fetchAll();


          //Select Class two 

            
                         $st =$con->prepare("SELECT student.* , 
                                       manage_class.ClassName
                                From 
                                       student
                                INNER JOIN 
                                       manage_class 
                                ON 
                                       manage_class.ID = student.Class_ID

                                WHERE   
                                      ClassName='Two';
                                      
                                       ");


           //Execute The Statment

          $st->execute();

          //ASSIGN TO VARIABLE

          $sts=$st->fetchAll();



            //Select Class three 

            
            $acxz =$con->prepare("SELECT student.* , 
                                       manage_class.ClassName
                        From 
                                       student
                        INNER JOIN 
                                       manage_class 
                        ON 
                                       manage_class.ID = student.Class_ID

                        WHERE   
                                      ClassName='Three';
                                      
                                       ");


           //Execute The Statment

          $acxz->execute();

          //ASSIGN TO VARIABLE

          $bvc=$acxz->fetchAll();




            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Make Distributed Subject</h1>   
 
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

       
                <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Choose Level" class="btn btn-primary btn-md">
                    </div>
                 </div>

            </form>
           </div>


            
        

  <?php  

     }elseif ($do == 'Edit'){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Add Subject</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $classname  =$_POST['classname'];


         # echo "$classname";
          #echo "<br>";
         # echo "$sectionname";


          //validate Form
           $formErrors =array();
           if($classname == 0){
              $formErrors[]= 'You Must Chosse Class From List';
           }
           foreach ($formErrors as  $error) {
              echo '<div class="alert alert-danger">' . $error . '</div>';
           }

            //Check If there Is no Error Proceed The Update Operation 
           if(empty($formErrors)){  

            ?>

            <?php //Select Class one And Section A

                  $stm =$con->prepare("SELECT manage_subject_one.* 
                                From 
                                       manage_subject_one;
                                      
                                       ");


           //Execute The Statment

          $stm->execute();

          //ASSIGN TO VARIABLE

          $stms=$stm->fetchAll();  

           //Select Class two

            $st =$con->prepare("SELECT manage_subject_two.*  
                                From 
                                       manage_subject_two; ");


           //Execute The Statment

          $st->execute();

          //ASSIGN TO VARIABLE

          $sts=$st->fetchAll();


        //Select Class three 

            $bgf =$con->prepare("SELECT manage_subject_three.*  
                                From 
                                       manage_subject_three; ");


           //Execute The Statment

          $bgf->execute();

          //ASSIGN TO VARIABLE

          $bvc=$bgf->fetchAll();



        //Select Class four 

          $mjd =$con->prepare("SELECT manage_subject_four.*  
                                From 
                                       manage_subject_four; ");


           //Execute The Statment

          $mjd->execute();

          //ASSIGN TO VARIABLE

          $kfd=$mjd->fetchAll();



             // Class one 
            
              if ($classname == 9 ) {  ?>

          <form action="take_attendance.php?do=Manage" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>ID Subject</td>
                   <td>Name Subject</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td>Control</td>
                  
                </tr>

              
      

                 <?php
                 
                 foreach ($stms as $ros) {

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Subj_One_ID']; ?> </td>
                      <td> <?php echo $ros['Subj_Name']; ?> </td>
                      <td> <?php echo $ros['Subj_Hour']; ?> </td>
                      <td> <?php echo $ros['Subj_Mark']; ?> </td>
<?php
                 echo"<td>
                      
                      <a href='stuffAddSubject.php?do=Ed&studentid=" .$ros['Subj_One_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                      <a href='stuffAddSubject.php?do=Delete&studentid=" .$ros['Subj_One_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                      
                echo"</td>";
?>                      
                      
                    </tr>
<?php
                
                 }
                ?>
              
              </table>
            </div>
            <a href="stuffAddSubject.php?do=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Subject </a>

        </form>

<?php

              }

              //  class equal two 

            elseif ($classname == 10) {  ?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>ID Subject</td>
                   <td>Name Subject</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td>Control</td>
                  
                </tr>

              
      

                 <?php
                 



                 foreach ($sts as $fgh) {


                    ?>

                    <tr>
                      
                      <td> <?php echo $fgh['Subj_Two_ID']; ?> </td>
                      <td> <?php echo $fgh['Subj_Name']; ?> </td>
                      <td> <?php echo $fgh['Subj_Hour']; ?> </td>
                      <td> <?php echo $fgh['Subj_Mark']; ?> </td>
<?php
                 echo"<td>
                      
                      <a href='stuffAddSubject.php?do=Edi&subid=" .$fgh['Subj_Two_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                      <a href='stuffAddSubject.php?do=Delete2&subid=" .$fgh['Subj_Two_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                      
                echo"</td>";
?>                      
                      
                    </tr>
<?php 
                 }



                  
                      
                     


                ?>
              
              </table>
            </div>
            <a href="stuffAddSubject.php?do=Add2" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Subject </a>

        </form>

<?php

              }

          // Three
            
              if ($classname == 11 ) {  ?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>ID Subject</td>
                   <td>Name Subject</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td>Control</td>
                  
                </tr>

              
      

                 <?php
                 
                 foreach ($bvc as $ros) {

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Subj_Three_ID']; ?> </td>
                      <td> <?php echo $ros['Subj_Name']; ?> </td>
                      <td> <?php echo $ros['Subj_Hour']; ?> </td>
                      <td> <?php echo $ros['Subj_Mark']; ?> </td>
<?php
                 echo"<td>
                      
                      <a href='stuffAddSubject.php?do=Ed3&svgid=" .$ros['Subj_Three_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                      <a href='stuffAddSubject.php?do=Delete3&svgid=" .$ros['Subj_Three_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                      
                echo"</td>";
?>                      
                      
                    </tr>
<?php
                
                 }
                ?>
              
              </table>
            </div>
            <a href="stuffAddSubject.php?do=Add3" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Subject </a>

        </form>

<?php

              }

              // Four
            
      if ($classname == 12 ) {  ?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>ID Subject</td>
                   <td>Name Subject</td>
                   <td>Subject Hour</td>
                   <td>Subject Mark</td>
                   <td>Control</td>
                  
                </tr>

              
      

                 <?php
                 
                 foreach ($kfd as $ros) {

                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Subj_Four_ID']; ?> </td>
                      <td> <?php echo $ros['Subj_Name']; ?> </td>
                      <td> <?php echo $ros['Subj_Hour']; ?> </td>
                      <td> <?php echo $ros['Subj_Mark']; ?> </td>
<?php
                 echo"<td>
                      
                      <a href='stuffAddSubject.php?do=Ed4&thfid=" .$ros['Subj_Four_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                      <a href='stuffAddSubject.php?do=Delete4&thfid=" .$ros['Subj_Four_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";
                      
                echo"</td>";
?>                      
                      
                    </tr>
<?php
                
                 }
                ?>
              
              </table>
            </div>
            <a href="stuffAddSubject.php?do=Add4" class="btn btn-primary"> <i class="fa fa-plus"></i> Add New Subject </a>

        </form>

<?php

              }



           }



        }

     }elseif($do == 'Ed'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= $_GET['studentid'];
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_subject_one WHERE Subj_One_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($studentid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="userid" value="<?php echo $studentid ?>"/>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname" value="<?php echo $row['Subj_Name']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjecthour" value="<?php echo $row['Subj_Hour']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectmark" value="<?php echo $row['Subj_Mark'] ?>" class="form-control" >
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

}elseif($do == 'Edi'){

//////////////////////////////Class B////////////////////////////

               //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $subid= $_GET['subid'];

       #echo $subid;
         
      //Select all Data Depend On ID

       $etrt =$con->prepare("SELECT * FROM manage_subject_two WHERE Subj_Two_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $etrt->execute(array($subid)); 
      
      //Fetch The Data
      
       $row =$etrt->fetch();
      
      //The Row Count

       $count = $etrt->rowCount();

        if($etrt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="subid" value="<?php echo $subid ?>"/>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname" value="<?php echo $row['Subj_Name']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjecthour" value="<?php echo $row['Subj_Hour']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectmark" value="<?php echo $row['Subj_Mark'] ?>" class="form-control" >
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

 





     }elseif($do == 'Ed3'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $svgid= $_GET['svgid'];
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_subject_three WHERE Subj_Three_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($svgid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="svgid" value="<?php echo $svgid ?>"/>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname" value="<?php echo $row['Subj_Name']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjecthour" value="<?php echo $row['Subj_Hour']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectmark" value="<?php echo $row['Subj_Mark'] ?>" class="form-control" >
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

}elseif($do == 'Ed4'){ //Edit Page 
        
       //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $thfid= $_GET['thfid'];
         
      //Select all Data Depend On ID

       $stmt =$con->prepare("SELECT * FROM manage_subject_four WHERE Subj_Four_ID=? LIMIT 1 ") ;
      
      //Execute Query
      
       $stmt->execute(array($thfid)); 
      
      //Fetch The Data
      
       $row =$stmt->fetch();
      
      //The Row Count

       $count = $stmt->rowCount();

        if($stmt->rowCount() > 0){   ?>

             

           <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Edit Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Update" method="POST">
                 <input type="hidden" name="thfid" value="<?php echo $thfid ?>"/>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Name Subject :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname" value="<?php echo $row['Subj_Name']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjecthour" value="<?php echo $row['Subj_Hour']?>" class="form-control" autocomplete="off" >
                    </div>
                 </div>


                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectmark" value="<?php echo $row['Subj_Mark'] ?>" class="form-control" >
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

}elseif($do == 'Update'){   //Update Page

       echo "<h1 class='text-center' style='margin-top: 100px;color:#888;font-size: 55px;font-weight: bold'>Update Observation</h1>";
       echo "<div class='container'>";
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
          //Get Variable From Form
          $userid    =$_POST['userid'];
          $observe    =$_POST['observe'];

          //Update The DataBase
          $stmt=$con->prepare("UPDATE student SET Observe=?    WHERE Student_ID=?");
            $stmt->execute(array($observe , $userid));

          //Success Message

          $theMsg= "<div class='alert alert-success'>" . $stmt->rowCount() . " Observation Updated </div>";

          redirectHome($theMsg , 'back');

      

        }else{

          $theMsg= "<div class='alert alert-danger'>Sorry You cant browse this page direct</div>";

          redirectHome($theMsg);

        }

        echo "</div>";


     }

     elseif ($do == 'Add') {  ?>

     
      <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject ID :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjctid"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject ID">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Name">
                    </div>
                 </div>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjecthour"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Hour">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjectmark"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Mark">
                    </div>
                 </div>

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
                            echo "<option value='" .$teach['Teacher_ID'] . "'>" . $teach['Name'] . "</option>";
                          }

                         ?>

                       </select>
                    </div>
                 </div>
                 <!-- End Teacher Field -->



                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Subject" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>
        
  



        ?>
      

       
 <?php    }elseif($do == 'Insert'){

     // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $subjctid        =$_POST['subjctid'];
          $subjectname     =$_POST['subjectname'];
          $subjecthour     =$_POST['subjecthour'];
          $subjectmark     =$_POST['subjectmark'];
          $teachname       =$_POST['teachname'];
        
            //Insert The DataBase Into Student
            
           $stmt = $con->prepare("INSERT INTO 
                                    manage_subject_one(Subj_One_ID , Subj_Name ,Teacher_Name, Subj_Hour , Subj_Mark)
                                    VALUES(:zsubjctid, :zsubjectname , :zteachname ,:zsubjecthour , :zsubjectmark)");
            $stmt->execute(array(

                'zsubjctid'     => $subjctid,
                'zsubjectname'  => $subjectname,
                'zteachname'    => $teachname,
                'zsubjecthour'  => $subjecthour,
                'zsubjectmark'  => $subjectmark,            
                
              ));


            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';
            $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg);
          

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg);

          echo "</div>";
        }

        echo "</div>";




    }elseif($do == 'Add2'){  ?>


      <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert2" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject ID :</label>
                    <div class="col-md-10">
                    <input type="text" name="subid"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject ID">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Name">
                    </div>
                 </div>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjecthour"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Hour">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjectmark"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Mark">
                    </div>
                 </div>


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Subject" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>
        
  



        ?>
      

       
 <?php





    }elseif($do == 'Insert2'){

         // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $subid        =$_POST['subid'];
          $subjectname     =$_POST['subjectname'];
          $subjecthour     =$_POST['subjecthour'];
          $subjectmark     =$_POST['subjectmark'];
        
            //Insert The DataBase Into Student
            
           $stmt = $con->prepare("INSERT INTO 
                                    manage_subject_Two(Subj_Two_ID , Subj_Name , Subj_Hour , Subj_Mark)
                                    VALUES(:zsubid, :zsubjectname , :zsubjecthour , :zsubjectmark)");
            $stmt->execute(array(

                'zsubid' => $subid,
                'zsubjectname' => $subjectname,
                'zsubjecthour' => $subjecthour,
                'zsubjectmark' => $subjectmark,            
                
              ));


            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';
            $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');
          

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg);

          echo "</div>";
        }

        echo "</div>";


    }elseif($do == 'Add3'){  ?>


      <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert3" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject ID :</label>
                    <div class="col-md-10">
                    <input type="text" name="svgid"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject ID">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Name">
                    </div>
                 </div>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjecthour"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Hour">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjectmark"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Mark">
                    </div>
                 </div>


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Subject" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>
        
  



        ?>
      

       
 <?php





    }elseif($do == 'Insert3'){

         // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $svgid        =$_POST['svgid'];
          $subjectname     =$_POST['subjectname'];
          $subjecthour     =$_POST['subjecthour'];
          $subjectmark     =$_POST['subjectmark'];
        
            //Insert The DataBase Into Student
            
           $stmt = $con->prepare("INSERT INTO 
                                    manage_subject_three(Subj_Three_ID , Subj_Name , Subj_Hour , Subj_Mark)
                                    VALUES(:zsvgid, :zsubjectname , :zsubjecthour , :zsubjectmark)");
            $stmt->execute(array(

                'zsvgid' => $svgid,
                'zsubjectname' => $subjectname,
                'zsubjecthour' => $subjecthour,
                'zsubjectmark' => $subjectmark,            
                
              ));


            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';
            $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');
          

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg);

          echo "</div>";
        }

        echo "</div>";


    }elseif($do == 'Add4'){  ?>


      <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Add New Subject</h1>   
 
           <div class="container">
               <form class="form-horizontal" action="?do=Insert4" method="POST">
                 
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject ID :</label>
                    <div class="col-md-10">
                    <input type="text" name="thfid"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject ID">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                    <input type="text" name="subjectname"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Name">
                    </div>
                 </div>

                  <div class="form-group">
                  <label class="col-md-2 control-label">Subject Hour :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjecthour"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Hour">
                    </div>
                 </div>

                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Mark :</label>
                    <div class="col-md-10">
                    <input type="number" name="subjectmark"  class="form-control" autocomplete="off" required="required" placeholder="Enter Subject Mark">
                    </div>
                 </div>


                 <div class="form-group">
                  
                    <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" value="Add Subject" class="btn btn-primary btn-lg">
                    </div>
                 </div>

               </form>
            </div>
        
  



        ?>
      

       
 <?php





    }elseif($do == 'Insert4'){

         // Insert Member Page
     
        
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Insert Student</h1>";
           echo "<div class='container'>";

          //Get Variable From Form
          $thfid        =$_POST['thfid'];
          $subjectname     =$_POST['subjectname'];
          $subjecthour     =$_POST['subjecthour'];
          $subjectmark     =$_POST['subjectmark'];
        
            //Insert The DataBase Into Student
            
           $stmt = $con->prepare("INSERT INTO 
                                    manage_subject_four(Subj_Four_ID , Subj_Name , Subj_Hour , Subj_Mark)
                                    VALUES(:zthfid, :zsubjectname , :zsubjecthour , :zsubjectmark)");
            $stmt->execute(array(

                'zthfid' => $thfid,
                'zsubjectname' => $subjectname,
                'zsubjecthour' => $subjecthour,
                'zsubjectmark' => $subjectmark,            
                
              ));


            //Success Message

          //  echo "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Insert </div>';
            $theMsg ="<br><br><br><div class='alert alert-success'>" . $stmt->rowCount() . " Subject Inserted </div>";

             redirectHome($theMsg , 'back');
          

           

        }else{

          echo "<div class='container'>";

          $theMsg ='<br><br><br><div class="alert alert-danger"> Sorry You cant browse this page direct</div>';

          redirectHome($theMsg);

          echo "</div>";
        }

        echo "</div>";


    }elseif($do == 'Delete'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Subject</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $studentid= $_GET['studentid'];
         
      //Select all Data Depend On ID

       $check = checkItem('Subj_One_ID' , 'manage_subject_one' , $studentid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM manage_subject_one WHERE Subj_One_ID=:zuser");

         $stmt->bindParam(":zuser" , $studentid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Record Deleted </div>';

           redirectHome($theMsg);  

        }else{

          $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

          redirectHome($theMsg);

        }
         
         echo '</div>';

     }elseif($do == 'Delete2'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Subject</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $subid= $_GET['subid'];
         
      //Select all Data Depend On ID

       $check = checkItem('Subj_Two_ID' , 'manage_subject_two' , $subid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM manage_subject_two WHERE Subj_Two_ID=:zuser");

         $stmt->bindParam(":zuser" , $subid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Record Deleted </div>';

           redirectHome($theMsg);  

        }else{

          $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

          redirectHome($theMsg);

        }
         
         echo '</div>';

     }elseif($do == 'Delete3'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Subject</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $svgid= $_GET['svgid'];
         
      //Select all Data Depend On ID

       $check = checkItem('Subj_Three_ID' , 'manage_subject_three' , $svgid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM manage_subject_three WHERE Subj_Three_ID=:zuser");

         $stmt->bindParam(":zuser" , $svgid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Record Deleted </div>';

           redirectHome($theMsg);  

        }else{

          $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

          redirectHome($theMsg);

        }
         
         echo '</div>';

     }elseif($do == 'Delete4'){   //Delete Member Page

      echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Delete Subject</h1>";
       echo "<div class='container'>";
 
      //Check If Get Request userid is numeric & GEt The Integer Value Of It

       $thfid= $_GET['thfid'];
         
      //Select all Data Depend On ID

       $check = checkItem('Subj_Four_ID' , 'manage_subject_four' , $thfid);

     //  $stmt =$con->prepare("SELECT * FROM users WHERE UserID=? LIMIT 1 ") ;
      
      //Execute Query
      
     //  $stmt->execute(array($userid)); 
      
      //The Row Count

     //  $count = $stmt->rowCount();

        if($check > 0){   
         
         $stmt = $con->prepare("DELETE  FROM manage_subject_four WHERE Subj_Four_ID=:zuser");

         $stmt->bindParam(":zuser" , $thfid);

         $stmt->execute();

      //   echo '<br>' . '<br>' . '<br>' . "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleted </div>';

         $theMsg ="<div class='alert alert-success'>" .$stmt->rowCount() .' Record Deleted </div>';

           redirectHome($theMsg);  

        }else{

          $theMsg = "<div class='alert alert-danger'>This ID Is Not Exist</div>";

          redirectHome($theMsg);

        }
         
         echo '</div>';
     }




    include $tpl . 'footer.php';

   } else{

      header('Location: index.php');

      exit();
   }

   ob_end_flush();

?>