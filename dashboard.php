<?php

   session_start();

        if (isset($_SESSION['Username'])){
           
           $pageTitle = 'Dashboard';

           include 'init.php'; 
           
          /* Start Dashboard Page */

          $latestUsers = 5; //The Number Of LatestUser 

          $theLatest =getLatest("*","teacher","Teacher_ID", $latestUsers); //LatestUsers array Teacher


          $theLatestStudent =getLatest("*","student","Student_ID", $latestUsers); //LatestUsers array
   
          ?>


          <br><br>
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ul class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ul>
          
          <!-- The slideshow -->
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="header1.png" alt="Los Angeles" width="1500" height="515">
              <div class="carousel-caption text-center" style="position: absolute;top: 100px;background: rgba(10,30,20,0.2);margin-bottom: 100px;border-radius: 38%;">
              <main id="container" class="daymode" >
                  <time id="date" class="clocktext" style="display:block;margin:0;padding:1px 0 0 0;width:100%;text-align:center;line-height:1.2;white-space:nowrap;font-size: -webkit-xxx-large;color: #f5a111;margin-top: 30px;">Someday, Anymonth 15, 20XX</time>
                  <time id="time" class="clocktext" style="display:block;margin:0;padding:1px 0 0 0;width:100%;text-align:center;line-height:1.2;white-space:nowrap;font-size: -webkit-xxx-large;margin-top: 50px;color: #0ef743;">12:00<span>:00 PM</span></time>
              </main>
              </div>
            </div>
            <div class="carousel-item">
              <img src="header3.png" alt="Chicago" width="1500" height="515">
              <div class="carousel-caption text-center" style="position: absolute;top: 100px;background: rgba(10,30,20,0.2);margin-bottom: 100px;border-radius: 38%;">
                <h3 style="font-weight: bold;color: #2975c7;background-color: #ddd;margin-right: 45px;margin-left: 35px;border-radius: 45px;">Message of the Faculty</h3>
                <p style="letter-spacing: 2px ;padding: 2px 5px;line-height: 30px;margin-top: 20px; font-weight: bold;font-size: 15px;font-family: arial;color: #71633b;">Consolidating the principle of citizenship and strengthening religious values ​​in. Memory and heart of each student living life for all different national occasions.
                Develop the spirit of responsibility and initiative by clarifying the rights and duties that students must practice within the faculty and community environment.
               </p>
              </div>
            </div>
         
          </div>
          
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
          </a>
          <a class="carousel-control-next" href="#myCarousel" data-slide="next">
            <span class="carousel-control-next-icon"></span>
          </a>
        </div><br><br>

<script >
  
  //NOTE: ES5 chosen instead of ES6 for compatibility with older mobile devices
var now, dd, td;
var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

document.addEventListener("DOMContentLoaded", init, false);
function init(){
  dd = document.getElementById("date");
  td = document.getElementById("time");
  updateTime();
  setInterval(updateTime,1000);
}
function updateTime(){
  var clockdata = getClockStrings();
  dd.innerHTML = clockdata.datehtml;
  td.innerHTML = clockdata.timehtml;
  dd.dateTime = now.toISOString();
  td.dateTime = now.toISOString();
}
function getClockStrings(){
  now = new Date();
  var year = now.getFullYear();
  var month = months[now.getMonth()];
  var date = now.getDate();
  var day = days[now.getDay()];
  var hour = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds();
  var meridian = hour < 12 ? "AM" : "PM";
  var clockhour = hour > 12 ? hour - 12 : hour;
  if (hour === 0) {clockhour = 12;}
  var clockminutes = minutes < 10 ? "0" + minutes : minutes;
  var clockseconds = seconds < 10 ? "0" + seconds : seconds;
  var datehtml = day + ", " + month + " " + date + ", " + year;
  var timehtml = clockhour + ":" + clockminutes + "<span>:" + clockseconds + " " + meridian + "</span>";
  return {"datehtml":datehtml,"timehtml":timehtml};
}
</script>













          <div class="home-stats">
          <div class="container text-center" >
            
            <div class="row">
               <div class="col-md-3">
                 <div class="stat" style="background-color: #3498db;padding: 20px;font-size: 15px;color: #FFF;border-radius: 10px;position: relative;overflow: hidden;">
                  <i class="fa fa-suitcase" style="position: absolute;font-size: 80px;top: 35px;left: 30px;"></i>
                  <div class="info" style="float: right;">
                   Total Teachers
                   <span style="display: block;font-size: 60px;"><a href='teacher.php' style="color: #FFF;text-decoration: none;"><?php echo countItems('Teacher_ID' , 'teacher') ?></a></span>
                  </div>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="stat" style="background-color: #c0392b;padding: 20px;font-size: 15px;color: #FFF;border-radius: 10px;position: relative;overflow: hidden;">
                  <i class="fa fa-group" style="position: absolute;font-size: 80px;top: 35px;left: 30px;"></i>
                 <div class="info" style="float: right;">
                   Total Students
                   <span style="display: block;font-size: 60px;"><a href='student.php?' style="color: #FFF;text-decoration: none;"><?php echo countItems('Student_ID' , 'student') ?></a></span>
                   </div>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="stat" style="background-color: #d35400;padding: 20px;font-size: 15px;color: #FFF;border-radius: 10px;position: relative;overflow: hidden;">
                 <i class="fa fa-laptop" style="position: absolute;font-size: 80px;top: 35px;left: 30px;"></i>
                 <div class="info" style="float: right;">
                   Total Class
                   <span style="display: block;font-size: 60px;"><a href='manageClass.php' style="color: #FFF;text-decoration: none;"><?php echo countItems('ID' , 'manage_class') ?></a></span>
                   </div>
                 </div>
               </div>
               <div class="col-md-3">
                 <div class="stat" style="background-color: #8e44ad;padding: 20px;font-size: 15px;color: #FFF;border-radius: 10px;">
                   Total Marksheet
                   <span style="display: block;font-size: 60px;">288</span>
                 </div>
               </div>
               </div>

            </div>
          </div>
          <div class="latest" style="margin-top: 40px">
          <div class="container" >
            <div class="row">

              <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                       <i class="fa fa-users"></i> Latest <?php echo $latestUsers ?> Registers Teachers
                    </div>
                    <div class="card-footer">
                    <ul class="list-unstyled latest-users">
                    <?Php

                        foreach ($theLatest as $user) {

                        echo '<li style="overflow:hidden;padding:5px 0;">';
                           echo  $user['Name'];
                           echo '<a href="teacher.php?do=Edit&teacherid='. $user['Teacher_ID'] . '">';
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

              <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel panel-heading">
                       <i class="fa fa-tag"></i> Latest <?php echo $latestUsers ?> Registers Students
                    </div>
                    <div class="card-footer">
                     <ul class="list-unstyled latest-users">
                     <?Php

                        foreach ($theLatestStudent as $user) {

                        echo '<li style="overflow:hidden;padding:5px 0;">';
                           echo  $user['Name'];
                           echo '<a href="student.php?do=Edit&studentid=' . $user['Student_ID'] . '">';
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

            </div>
          </div>
          </div>


    <!-- Start section Feature -->
    <section class="features text-center" style="background:#EEE;padding-top:50px;padding-bottom:50px;">
  <div class="container">
     <h1>Our Feature</h1>
   <div class="row">
   
     <div class="col-lg-3 col-md-6">
      <div class="feat">
    
        <i class="fa fa-snowflake-o" style="font-size: 20px;margin-bottom: 8px;color: coral"></i>
      <h4 style="color: lawngreen;">Retina Ready </h4>
      <p style="font-family: cursive;color: cadetblue;margin-top: 15px;">This Is Our Pragraph My Name Is Mohamed Talaat And I am A Web devloper And I Like This So Much</p>
      
      </div>
     </div>
    
     <div class="col-lg-3 col-md-6" >
      <div class="feat">
    
        <i class="fa fa-code" style="font-size: 20px;margin-bottom: 8px;color: coral"></i>
      <h4 style="color: lawngreen;">Awesome Display</h4>
      <p style="font-family: cursive;color: cadetblue;margin-top: 15px;">This Is Our Pragraph My Name Is Mohamed Talaat And I am A Web devloper And I Like This So Much</p>
      
      </div>
     </div>
    
     <div class="col-lg-3 col-md-6">
      <div class="feat">
    
        <i class="fa fa-check" style="font-size: 20px;margin-bottom: 8px;color: coral"></i>
      <h4 style="color: lawngreen;">100% Responsive</h4>
      <p style="font-family: cursive;color: cadetblue;margin-top: 15px;">This Is Our Pragraph My Name Is Mohamed Talaat And I am A Web devloper And I Like This So Much</p>
      
      </div>
     </div>
     
     <div class="col-lg-3 col-md-6">
      <div class="feat">
    
        <i class="fa fa-folder" style="font-size: 20px;margin-bottom: 8px;color: coral"></i>
      <h4 style="color: lawngreen;">Well Documented</h4>
      <p style="font-family: cursive;color: cadetblue;margin-top: 15px;">This Is Our Pragraph My Name Is Mohamed Talaat And I am A Web devloper And I Like This So Much</p>
      
      </div>
    </div>
    
     </div>
   
   </div>
  </div>
    </section>
  <!-- End Section feature -->


  <!-- Start Testminoals -->
    <section class="testimonials text-center" style="padding-bottom:50px;padding-top:50px;">
   <div class="container">
    <h1>What Are Parent Say ?</h1>
  
  
  <div id="carousel_testimonials" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->


  <!-- Wrapper for slides -->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
  
    <div class="carousel-item active">
      <p class="lead" style="font-family: cursive;">This Is My First Paragraph This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat</p>
      <span style="font-weight: bold;color: red;margin-top: 2px;">"Mohamed Talaat"</span>
  </div>
  
    <div class="carousel-item">
      <p class="lead" style="font-family: cursive;">This Is My First Paragraph This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat</p>
      <span style="font-weight: bold;color: red;margin-top: 2px;">"Ahmed Talaat"</span>
   </div>
  
    <div class="carousel-item">
      <p class="lead" style="font-family: cursive;">This Is My First Paragraph This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat</p>
      <span style="font-weight: bold;color: red;margin-top: 2px;">"Mohamed Abdallah"</span>
  </div>
  
  <div class="carousel-item">
      <p class="lead" style="font-family: cursive;">This Is My First Paragraph This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat This Is My First Paragraph To Talk About My Self Hello Every Body My NAme Is Mohamed Talaat</p>
      <span style="font-weight: bold;color: red;margin-top: 2px;">"Ahmed AbdElrhem"</span>
  </div>
  
  </div>
  
    <ol class="carousel-indicators">
    <li data-target="#carousel_testimonials" data-slide-to="0" class="active">
    <img src="avatar01.jpg" alt="Mohamed">
  </li>
    <li data-target="#carousel_testimonials" data-slide-to="1">
    <img src="avatar02.jpeg" alt="Ahmed">
  </li>
    <li data-target="#carousel_testimonials" data-slide-to="2">
    <img src="avatar03.jpg" alt="Mohamed">
  </li>
  <li data-target="#carousel_testimonials" data-slide-to="3">
    <img src="avatar04.jpg" alt="Ahmed">
  </li>
    </ol>
 
  
</div>
   </div>
  
  </div>
  </section>
  
  
  <!-- End Testminoals -->

  

  <!-- Start Contact Form -->
   <div class="contact text-center">
      <div class="overlay">
        <div class="container">
          <h2 class="upper">Say <span class="main-color">Hello</span></h2>
          
          <form>
            <input type="email" name="mail" placeholder="Your Email">
            <input type="text" name="subject" placeholder="Subject">
            <textarea placeholder="Message"></textarea>
            <div class="info">
                <button class="upper">Here Us</button>
            </div>
          </form>
        </div>
      </div>
   </div>


  <!-- End Contact Form -->

  <!-- start footer -->
      <div class="footer" style="background-color: #232323;color: #EEE;padding: 40px 0;">
         <div class="container">
           
              <div class="col" style="width: 25%;float: left;overflow: hidden;">
                 <h2 style="color: #FFF;font-weight: normal;font-size: 18px;margin-bottom: 20px;">About Classic</h2>
                 <p style="margin-bottom: 30px;line-height: 1.6;">Our Team Work Very Hard To Achieve A Specific Goal To Make Others Proud Of Us</p>
                 <i class="fab fa-facebook-f fa-lg fa-fw" style="display: inline-block;color: #979797;width: 40px;padding: 10px;border:1px solid #979797"></i>
                 <i class="fab fa-google-plus-g fa-lg fa-fw" style="display: inline-block;color: #979797;width: 40px;padding: 10px;border:1px solid #979797"></i>
                 <i class="fab fa-twitter fa-lg fa-fw" style="display: inline-block;color: #979797;width: 40px;padding: 10px;border:1px solid #979797"></i>
              </div>
              <div class="col" style="width: 25%;float: left;overflow: hidden;">
                <h2 style="color: #FFF;font-weight: normal;font-size: 18px;margin-bottom: 20px;">Tags</h2>
                <span style="display: inline-block;color: #979797;padding: 10px;margin-right: 5px;margin-bottom: 10px;border:1px solid #979797">Html</span>
                <span style="display: inline-block;color: #979797;padding: 10px;margin-right: 5px;margin-bottom: 10px;border:1px solid #979797">Css</span>
                <span style="display: inline-block;color: #979797;padding: 10px;margin-right: 5px;margin-bottom: 10px;border:1px solid #979797">Php</span>
                <span style="display: inline-block;color: #979797;margin-right: 5px;margin-bottom: 10px;padding: 10px;border:1px solid #979797">JavaScript</span>
                <span style="display: inline-block;color: #979797;margin-right: 5px;margin-bottom: 10px; padding: 10px;border:1px solid #979797">Bootstrap</span>
              </div>
              <div class="col" style="width: 25%;float: left;overflow: hidden;">
                <h2 style="color: #FFF;font-weight: normal;font-size: 18px;margin-bottom: 20px;">Recent Posts</h2>
                <div style="overflow: hidden;margin-bottom: 15px;">
                  <img src="images/p1.png" alt="" style="float: left;margin-right:10px; ">
                  <h4 style="margin: 8px 0;color: #CCC;font-weight: normal;">How To Get Ride</h4>
                  <span style="color: gray;">June, 2019</span>
                </div>
                <div style="overflow: hidden;margin-bottom: 15px;">
                  <img src="images/p2.jpg" alt=""  style="float: left;margin-right:10px;">
                  <h4 style="margin: 8px 0;color: #CCC;font-weight: normal;">Why I'm Running</h4>
                  <span style="color: gray;">July, 2019</span>
                </div>
                <div style="overflow: hidden;margin-bottom: 15px;">
                  <img src="images/p3.png" alt="" style="float: left;margin-right:10px; ">
                  <h4 style="margin: 8px 0;color: #CCC;font-weight: normal;">Cassela Waste</h4>
                  <span style="color: gray;">August, 2019</span>
                </div>
              </div>
              <div class="col" style="width: 25%;float: left;overflow: hidden;">
                <h2 style="color: #FFF;font-weight: normal;font-size: 18px;margin-bottom: 20px;">Blog Categories</h2>
                <ul style="list-style-type: none;">
                  <li style="padding: 15px;border-bottom: 1px solid #979797;">Agency</li>
                  <li style="padding: 15px;border-bottom: 1px solid #979797;">Business</li>
                  <li style="padding: 15px;border-bottom: 1px solid #979797;">Multi Purpose</li>
                  <li style="padding: 15px;border-bottom: 1px solid #979797;">Audio</li>
                </ul>
              </div>
              <div class="clearfix"></div>
              <div class="copyright" style="margin-top: 30px;">copyright &copy; 2019 All Right Reserved</div>
         </div>
      </div>
   <!--// end footer -->


<?php

  echo $_SESSION['Username'];
?>


          <?php
          /* End Dashboard Page */
           
           include $tpl . 'footer.php';

        }else{
        	
        	header('Location: index.php');
        	
        	exit();
        }
?>