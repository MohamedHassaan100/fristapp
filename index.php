<?php
      session_start();
        $noNavbar = '';
        $pageTitle = 'Login';

     if (isset($_SESSION['Username'])){

            header('Location: dashboard.php');  //Direct To Teacher Page; 

        }   

include 'connect.php';
     //   Check If User Coming From HTTP REQUSET

    if(isset($_REQUEST['sign'])){

         $username =$_POST['user'];
         $password =$_POST['password'];
         $name =$_POST['name'];
         $email =$_POST['email'];
         $type =$_POST['type'];
         $hashedPass=sha1($password);
         
        
        $stmt =$con->prepare("SELECT UserID FROM users WHERE Username= '$username' ") ;
           $stmt->execute(array($username)); 
           $row =$stmt->fetch();
           $count = $stmt->rowCount();
       //  echo $hashedPass;
       // check if user exist in database
       if($count == 0){
           $stmt =$con->exec("insert into users (FullName,Email,Password,Username,GroupID) values ('$name','$email','$hashedPass','$username',$type)") ;

            $stmt =$con->prepare("SELECT UserID FROM users WHERE Username= ? ") ;
           $stmt->execute(array($username)); 
           $row =$stmt->fetch();
           $count = $stmt->rowCount();

           // If Count > 0 In This Mean The DataBae Contain Record About This UserName
            $_SESSION['Username']= $username;  //Register Session Name;
            $_SESSION['ID'] = $row['UserID'];   //Register Session ID;
            $_SESSION['Type'] = $type;   //Register Session Group ID;
            header('Location: dashboard.php');  //Direct To Dashboard Page;
            exit(); 
         
       } else {
           echo "<script>alert('This user name taken before, please enter another one.')</script>";
       }
}

if(isset($_REQUEST['login'])){

         $username =$_POST['user'];
         $password =$_POST['pass'];
         $hashedPass=sha1($password);
         
       //  echo $hashedPass;
       // check if user exist in database
       
       $stmt =$con->prepare("SELECT
                            UserID,Username, Password ,GroupID
                            FROM 
                            users 
                            WHERE 
                            Username= ? 
                            AND 
                            Password= ? 
                            LIMIT 1
                            ") ;
       $stmt->execute(array($username , $hashedPass)); 
       $row =$stmt->fetch();
       $count = $stmt->rowCount();


       // If Count > 0 In This Mean The DataBae Contain Record About This UserName

       if($count > 0){

       	$_SESSION['Username']= $username;  //Register Session Name;
        $_SESSION['ID'] = $row['UserID'];   //Register Session ID;
        $_SESSION['Type'] = $row['GroupID'];   //Register Session Group ID;
       	header('Location: dashboard.php');  //Direct To Dashboard Page;
       	exit(); 
         
       } 
}

?>
<!DOCTYPE html>
 <html>
   <head>
      <meta charset="utf-8">
      <meta name="description" content="">
	  <link rel="stylesheet" href="layout/css/normalize.css"/>
	  <link rel="stylesheet" href="layout/css/font-awesome.min.css"/>
      <link rel="stylesheet" href="layout/css/mohamed.css"type="text/css">
   </head>
   <body>
	  <!-- Start Contact Form -->
        
        <div class="contact">
            <div class="overlay">
				<div class="container">
					
				<!-- start button-->	
				    <div class="buttons">
					   <button class=" us active">Register</button>
				       <button class="sign">Log In</button>
				    </div> 
				<!-- end button-->	
				
				<!-- start register-->	
				    <form class="with"  action="index.php" method="post">
                        <input type="text" name="user" placeholder="user name" required>
                        <input type="text" name="name" placeholder="full name" required>
						<input type="email" name="email" placeholder="your email" required>
						<input type="password" name="password" placeholder="password" required>
						<div>
						  <select  class="type" name="type" required>       
<!--                            <option disabled selected>type</option>-->
                            <option value="1">student</option>
                            <option value="2">doctor</option>
                            <option value="3">staff</option>  
                          </select>
						  <span class="empty">you must to choose !</span>
						</div>	
                        <div class="info">
							<input type="submit" name="sign" value="Sign In">
<!--
                            <span class="form-icons">
								 <i class="fa fa-facebook fa-lg"></i>
                                <i class="fa fa-twitter fa-lg"></i>
                                <i class="fa fa-google-plus fa-lg"></i>
                            </span>
-->
                        </div>
                     </form>
				<!-- end register-->

				<!-- start sig in-->	
				     <form class="in block" action="index.php" method="post">
				        <input type="text" name="user" placeholder="your email" required>
					    <input type="password" name="pass" placeholder="password" required>
						<div> 
<!--
						  <select  class="type">       
                             <option>type</option>
                             <option>student</option>
                             <option>doctor</option>
                          </select>
-->
						  <span class="empty">you must to choose !</span>
						</div>	
	                   <input type="submit" name="login" value="Log In">
<!--						<div class="link"><button type="submit" >Log In</button></div>-->
				     </form>
				<!-- end sign in-->
	
				  </div>
				</div>
			<div class="clear-fix"></div>
        </div>
        
        <!-- End Contact Form -->
       <script src="layout/js/jquery-3.3.1.min.js"></script>
     <script src="layout/js/mohamed.js"></script>  


     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
   </body>
  </html>


