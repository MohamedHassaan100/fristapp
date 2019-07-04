<?php
  include 'init.php';
  ?>

  <div class='container login-page'>
  <br><br>
    <h1 class="text-center">
  	  <span class="login">Login</span> | <span class="signup">SignUp</span>
    </h1>
  	<form class="login">
  		 <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Type Your UserName">
         <input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Type Your Password">
         <input class="btn btn-primary form-control" type="submit" value="Login">

  	</form>
  	<form class="signup" style="margin: 100px;">
  		 <input class="form-control" type="text" name="username" autocomplete="off" placeholder="Type Your UserName">
         <input class="form-control" type="password" name="password" autocomplete="new-password" placeholder="Type A Complex Password">
         <input class="form-control" type="password" name="password2" autocomplete="new-password" placeholder="Type Password Again">
         <input type="email" name="email" placeholder="Type A Valid Email" class="form-control" />
         <input class="btn btn-success btn-block" type="submit" value="SignUp"/>

  	</form>
  </div>

<?php
  include $tpl . 'footer.php';
?>