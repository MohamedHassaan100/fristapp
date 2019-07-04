<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Questionnaire';
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

              <!-- Start Name Subject  Field -->
                 <div class="form-group">
                  <label class="col-md-2 control-label">Subject Name :</label>
                    <div class="col-md-10">
                     <input class="form-control" name="subjname" type="text" placeholder="Enter Name Of Subject" >
                    </div>
                 </div>
                <!-- End Name Subject Field -->
     
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
                
                  echo "<h1 class='text-center' style='color:#888;font-size: 55px;font-weight: bold'>Student Questionnaire</h1>";
                  echo "<div class='container'>";

                  //Get Variable From Form
                  $subjname  =$_POST['subjname'];

                  //Know Id Of Subject From Name Of Subject

                  $stmt =$con->prepare("SELECT Sub_ID FROM manage_subject WHERE Sub_Name=? ") ;

                        //Execute Query
      
			       $stmt->execute(array($subjname)); 
			      
			           //Fetch The Data
			       
			       $stm =$stmt->fetch();


			       //Get Student Name From ID Of Subject 

			        $aknk =$con->prepare("SELECT student.* , 
                                       register_subject.*
                                        FROM 
                                          student
                                        INNER JOIN 
                                         register_subject 
                                        ON 
                                       register_subject.Std_ID = student.Student_ID
                                        WHERE 
                                        Subject_ID=? OR Subject_ID_2=? ") ;

			        $aknk->execute(array($stm[0],$stm[0])); 

			        $akn =$aknk->fetchAll();

			  #      foreach ($akn as $rty) {
			        	
			  #      }


			  #      print_r($rty);

?>

          <form action="" method="post">  

              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <
                   <td>Student ID</td>
                   <td>Control</td>
                  
                </tr>

              
      

                 <?php
                 



                 foreach ($akn as $ros) {



                    ?>

                    <tr>
                      
                      <td> <?php echo $ros['Name']; ?> </td>
                      <td> <?php echo $ros['Degree']; ?> 

                      </td>
                  
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
