<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();


       $pageTitle = 'Recommender Time';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

           if($do == 'Manage'){ ?>

        <div class="timer_re" style="margin-top: 0px;padding-top: 0px ;background-image: url('https://res.cloudinary.com/hegeryfiles/image/upload/v1550235192/bg.jpg');height: 680px;background-repeat: no-repeat;background-position: center;background-size: cover;display: grid;justify-content: center;align-items: center;"> 
            <div class="container" style="height: 600px;width:  600px;text-align: center;">
                <div class="timer" style=" display: grid;justify-content: center;grid-template-columns: 1fr;align-items: center;margin: 100px 0px;">
                                <h2 style="color: #fff;font-size: 30px;">Work</h2>
                                <div class="counter" style="  font-size: 80px;font-family: 'digital-font';border:  1px solid #D3DEF2;border-radius: 15px;background-color: #D2E0F3;margin: 10px 0px;color: #008BCA;">
                                                <span id="WorkTime"></span>
                                </div>
                                <h2 style="color: #fff;font-size: 30px;">Break</h2>
                                <div class="counter" style="  font-size: 80px;font-family: 'digital-font';border:  1px solid #D3DEF2;border-radius: 15px;background-color: #D2E0F3;margin: 10px 0px;color: #008BCA;">
                                                <span id="breakTime"></span>
                                </div>
                </div>
                <div class="btns" style="  display: grid;grid-template-columns: 20% 20% 20% 20%;align-items: center;justify-content: space-between;">
                                <button id="start" class="btn" style=" padding: 10px 12px;font-size: 14px;font-weight: bold;color: #fff;border: 0;text-transform: capitalize;border-radius: 25px;background-color: #008BCA;cursor: pointer;outline: none;">Start Work</button>
                                <button id="resume"  class="btn" style=" padding: 10px 12px;font-size: 14px;font-weight: bold;color: #fff;border: 0;text-transform: capitalize;border-radius: 25px;background-color: #008BCA;cursor: pointer;outline: none;" disabled>Resume Work</button>
                                <button id="startBreak" class="btn" style=" padding: 10px 12px;font-size: 14px;font-weight: bold;color: #fff;border: 0;text-transform: capitalize;border-radius: 25px;background-color: #008BCA;cursor: pointer;outline: none;" disabled>Start Break</button>
                                <button id="reset"  class="btn" style=" padding: 10px 12px;font-size: 14px;font-weight: bold;color: #fff;border: 0;text-transform: capitalize;border-radius: 25px;background-color: #008BCA;cursor: pointer;outline: none;" disabled>End Work</button>
                </div>


        </div>
       </div> 

<script >
	
	// SELECT THE WORK TIME FROM HTML 
var WorkTime = document.getElementById('WorkTime');
// SELECT THE BREAK TIME FROM HTML 
var breakTime = document.getElementById('breakTime');
// SELECT THE HTML BUTTONS FROM HTML
var start = document.getElementById('start');
var resume = document.getElementById('resume');
var startBreak = document.getElementById('startBreak');
var reset = document.getElementById('reset');
// VARIABLES THAT WE WILL HOLD TIME FUNCTION
var workTimer;
var breakTimer;
var resumeTimer;
// MAKE OUR WORK COUNTER
var counterWork  =  0;
// MAKE OUR BREAK COUNTER
var counterBreak  = 0;
// START-WORK CLICK LISTENER
start.addEventListener('click' , function(e){
    e.preventDefault;
     WorkTimer =  setInterval(() => {
        counterWork++;
        WorkTime.innerHTML = timeFormat(counterWork);
    }, 1000);
    start.disabled       = true; // DON'T COUNT
    resume.disabled      = true;
    startBreak.disabled  = false;
    reset.disabled       = false;    
} );
// START-BREAK CLICK LISTENER
startBreak.addEventListener('click' , function(e){
    e.preventDefault;
    clearInterval (WorkTimer);
    clearInterval (resumeTimer);
     breakTimer =  setInterval(() => {
        counterBreak++;
        breakTime.innerHTML = timeFormat(counterBreak);
    }, 1000);
    start.disabled       = true;
    resume.disabled      = false;
    startBreak.disabled  = true;
    reset.disabled       = false;
} );
// START-RESUME CLICK LISTENER
resume.addEventListener('click' , function(e){
    e.preventDefault;
    clearInterval (breakTimer);
    resumeTimer =  setInterval(() => {
        counterWork++;
        WorkTime.innerHTML = timeFormat(counterWork);
    }, 1000);
    start.disabled       = true;
    resume.disabled      = true;
    startBreak.disabled  = false;
    reset.disabled       = false;
} );
// END-WORK CLICK LISTENER
reset.addEventListener('click' , function(e){
    e.preventDefault;
    counterWork  = 0;
    counterBreak = 0;
    WorkTime.innerHTML  = "00 : 00 : 00";
    breakTime.innerHTML = "00 : 00 : 00";
    clearInterval (WorkTimer);
    clearInterval (breakTimer);
    clearInterval (resumeTimer);
    start.disabled       = false;
    resume.disabled      = true;
    startBreak.disabled  = true;
    reset.disabled       = true;
} );
// DISPLAY THE TIMEFORMAT
var timeFormat = function (counter) {
    var displayTime = function (counter) {
        if (counter < 10){
            return "0"+counter;
        }
        else{
            return counter;
        }
    }
    return [
        displayTime(Math.floor(counter / 3600)),      // HOURS FORMAT
        displayTime(Math.floor(counter % 3600 / 60)), // MINUTES FORMAT
        displayTime(Math.floor(counter % 60))         // SECONDES FORMAT
    ].join(' : '); 
}
</script>
 
           

<?php }
           include $tpl . 'footer.php';

     }else{
        	
        	header('Location: index.php');
        	
        	exit();
        }