<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Add Bulk Student';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $latestUsers = 20;

           $theLatestStudent =getLatest("*","manage_class","ID", $latestUsers);

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

         //Start manage page

          if($do == 'Manage'){ //Manage Members Page 

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



          //Select Section A

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
                                      Sec_Name='A';
                                       ");

           $stm->execute();

           $ro=$stm->fetchAll();


          //Select Section B

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
                                      Sec_Name='B';
                                       ");

           $st->execute();

           $rw=$st->fetchAll();


            ?>

           <h1 class="text-center" style="margin-top: 100px;color:#888;font-size: 55px;font-weight: bold">Manage Students</h1>   

        
          <div class="container">
            


              <div class="col-sm-8">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                       <i class="fa fa-tag"></i> all Registers Classes
                    </div>
                    <div class="card-footer">
                     <ul class="list-unstyled latest-users">
                     <?Php

                        foreach ($theLatestStudent as $user) {

                        echo '<li style="overflow:hidden;padding:5px 0;">';
                           echo  $user['ClassName'];
                           echo '<a data-toggle="collapse" data-target="#demo">';
                              echo '<span class="btn btn-success pull-right" style="padding: 2px 8px;">';
                                  echo '<i class="fa fa-edit"></i> Edit';
                              echo '</span>';
                           echo '</a>';
                        echo '</li>';
 
                          }
                      ?>
                      </ul>
                    </div>
                </div>
              </div>

            

            
            <br><br>
             <div id="demo" class="collapse">
               <button class="btn btn-info" data-toggle="collapse" data-target="#dem">All Student</button>
               <button class="btn btn-info" data-toggle="collapse" data-target="#de">Section (A)</button>
               <button class="btn btn-info" data-toggle="collapse" data-target="#da">Section (B)</button>
             </div>
             <br><br>

             <!-- Table All Student responsive    -->
            
            <div class="col-lg-12 col col-sm-12">
            <div id="dem" class="collapse">
              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Name</td>
                   <td>Age</td>
                   <td>Contact</td>
                   <td>Email</td>
                   <td>Class Name</td>
                   <td>Section Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Student_ID'] . "</td>";
                      echo "<td>" . $row['Name'] ."</td>";
                      echo "<td>" . $row['Age'] . "</td>";
                      echo "<td>" . $row['Contact'] . "</td>";
                      echo "<td>" . $row['Email'] . "</td>";
                      echo "<td>" . $row['ClassName'] . "</td>";
                      echo "<td>" . $row['Sec_Name'] . "</td>";
                      echo "<td>
                              <a href='student.php?do=Edit&studentid=" .$row['Student_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='student.php?do=Delete&studentid=" .$row['Student_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            </div>
          </div>


           <div class="col-lg-12 col col-sm-12">
            <div id="de" class="collapse">
              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Name</td>
                   <td>Class Name</td>
                   <td>Section Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($ro as $ra) {
                    echo "<tr>";
                      echo "<td>" . $ra['Student_ID'] . "</td>";
                      echo "<td>" . $ra['Name'] ."</td>";
                      echo "<td>" . $ra['ClassName'] . "</td>";
                      echo "<td>" . $ra['Sec_Name'] . "</td>";
                      echo "<td>
                              <a href='student.php?do=Edit&studentid=" .$ra['Student_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='student.php?do=Delete&studentid=" .$ra['Student_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            </div>
          </div>
          


          <div class="col-lg-12 col col-sm-12">
            <div id="da" class="collapse">
              <div class="table-responsive">
              <table class="main-table text-center table table-bordered">
                <tr>
                   <td>ID</td>
                   <td>Name</td>
                   <td>Class Name</td>
                   <td>Section Name</td>
                   <td>Control</td>
                </tr>
                <?php
                 foreach ($rw as $rs) {
                    echo "<tr>";
                      echo "<td>" . $rs['Student_ID'] . "</td>";
                      echo "<td>" . $rs['Name'] ."</td>";
                      echo "<td>" . $rs['ClassName'] . "</td>";
                      echo "<td>" . $rs['Sec_Name'] . "</td>";
                      echo "<td>
                              <a href='student.php?do=Edit&studentid=" .$rs['Student_ID'] . "' class='btn btn-success'><i class='fa fa-edit' style='margin-right:3px;'></i>Edit</a>
                              <a href='student.php?do=Delete&studentid=" .$rs['Student_ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close' style='margin-right:4px;'></i>Delete </a>";


                      echo   "</td>";
                    echo "</tr>";
                 }


                ?>
              
              </table>
            </div>
            </div>
          </div>





         </div> 
        
            

             

  <?php  }
         include $tpl . 'footer.php';

     }else{
          
          header('Location: index.php');
          
          exit();
        }