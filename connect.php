<?php

    $dsn= 'mysql:host=localhost;dbname=fci';
    $user= 'root';
    $pass= '';
    $option=array(
       PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' ,
    );

   try{
  	 $con = new PDO($dsn , $user , $pass , $option);
  	 $con->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  	// echo 'You Are Connected You Are Welcome To DataBase';
   }
   catch(PDOException $e){
     echo 'Failed To Connect To DataBase' . $e->getMessage();
   }  