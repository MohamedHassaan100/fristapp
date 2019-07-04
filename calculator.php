<?php

 /* Can Manage Member Page */
 /* You Can Edit | Delete Members From Here */

  session_start();

        $pageTitle = 'Create Student Payment';

        if (isset($_SESSION['Username'])){

           include 'init.php';

           $do=isset($_GET['do']) ? $_GET['do'] : 'Manage';

           if($do == 'Manage'){ ?>

           
<div class="one" style="background-color: #134977;padding: 45px;">
<div class="calc" style="width:350px ;height: 500px;background:#293751;padding:12 0;box-shadow: 0 25px 15px #39152e;transition:all .4s ease-in-out;margin:8px auto;">
		  <div class="madeBy" style="width:100%;height: 50px;color:#fff;font-weight:600;text-align:center;margin-top: 10px;">
		    <span style="color:#E63363;">Calculator</span> 
		  </div>
		    <input type="text" class="values" style="display:block;width: 90%;margin:0 auto;height:40px;line-height:30px;font-size:2rem;letter-spacing:5px;padding:10px 20px;font-weight:bolder;background:#241f34;color:#fcfcfc;border-bottom:2px solid #293751;" disabled>
		  <input type="text" class="result" style="display:block;width: 90%;height:80px;line-height:80px;padding-left:20px;margin:auto;font-size:2rem;font-weight:bolder;background:#242834;color:#26ff5c;box-shadow:0px 4px 1px #090;" disabled>  </input>
		  <div class="container" style="background:#27334d;width:350px;height:200px;padding:50px 5px;">
			    <div class="col-xs-3 char" id="c" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">C</button>
			    </div>
			     <div class="col-xs-3 char" id="parances" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			    <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">( )</button>
			    </div>
			     <div class="col-xs-3 operator" id="moduls" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">%</button>
			    </div>
			     <div class="col-xs-3 operator lp" id="divid" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" class="dived" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">/</button>
			    </div>
			    <div class="col-xs-3 num" id="seven" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">7</button>
			    </div>
			     <div class="col-xs-3 num" id="eight" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">8</button>
			    </div>
			     <div class="col-xs-3 num" id="nine" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">9</button>
			    </div>
			     <div class="col-xs-3 operator" id="multiply" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">*</button>
			    </div>
			    <div class="col-xs-3 num" id="four" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">4</button>
			    </div>
			     <div class="col-xs-3 num" id="five" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">5</button>
			    </div>
			     <div class="col-xs-3 num" id="six" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">6</button>
			    </div>
			     <div class="col-xs-3 operator" id="minus" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">-</button>
			    </div>
			    <div class="col-xs-3 num" id="one" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">1</button>
			    </div>
			     <div class="col-xs-3 num" id="two" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">2</button>
			    </div>
			     <div class="col-xs-3 num" id="three" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">3</button>
			    </div>
			     <div class="col-xs-3 operator" id="plus" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">+</button>
			    </div>
			    <div class="col-xs-3 char" id="plusminus" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">-/+</button>
			    </div>
			     <div class="col-xs-3 num" id="zero" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			     <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">0</button>
			    </div>
			     <div class="col-xs-3 operator" id="dot" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">.</button>
			    </div>
			     <div class="col-xs-3 equal" id="equal" style="height:(396px)/6;line-height:(396px)/6;margin-bottom:5px;color:#000;font-size:20px;text-align:center;">
			      <button type="button" style="background:#253149;color:#efefef;display:block;width:100%;height:100%;outline:none;border-radius:100%;box-shadow:1px 3px 2px #39152e;transition:all .6s ease-in-out;">=</button>
			    </div>
		  </div>
</div>


</div>
           
           

<?php }
           include $tpl . 'footer.php';

     }else{
        	
        	header('Location: index.php');
        	
        	exit();
        }