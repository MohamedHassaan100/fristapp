 <?php

/*
=======================================
Template Page
=======================================
*/

   ob_start();

   session_start();

  

   $pageTitle = 'Observation';

    if(isset($_SESSION['Username'])){

     include 'init.php';

     $do =isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if($do == 'Manage'){

          $studentid= isset($_GET['studentid']) && is_numeric($_GET['studentid']) ? intval($_GET['studentid']) : 0;
        
          //Select All User Expect Admin

          $stmt =$con->prepare("SELECT * FROM register_subject WHERE Std_ID='$studentid'");
 
          //Execute The Statment

          $stmt->execute();

          //ASSIGN TO VARIABLE

          $rows=$stmt->fetchAll();


            ?>

        
         
         
          <div class="container">
           
            
            <h1 class="text-center" style="color:#888;font-size: 55px;font-weight: bold">Manage Subject</h1> 

          
            <div class="panel-body">
            <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Semester 1</td>
                   <td>Semester 2</td>
                   <td>Degree</td>
    <!--           <td>Control</td>   -->
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Std_ID'] . "</td>";
                      echo "<td>" . $row['Subject_ID'] . "</td>";
                      echo "<td>" . $row['Subject_ID_2'] . "</td>";
                      echo "<td>" . $row['Degree'] . "</td>";
        /*              echo "<td>
                              <a href='viewSubject.php?do=Edit&studentid=" .$row['Std_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='viewSubject.php?do=Delete&studentid=" .$row['Std_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";  */
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            </div>
         
          </div>
            
        

  <?php

            
        

 

     }elseif ($do == 'Edit'){



     }elseif($do == 'Ed'){ //Edit Page 
        


     }elseif($do == 'Update'){   //Update Page



     }

     elseif ($do == 'Add') {  ?>

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