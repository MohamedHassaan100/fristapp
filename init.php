<?php 

   include 'connect.php';

   //Routes

   $tpl  = "includes/templetes/";   //template directory
   $lang = "includes/languages/";
   $func = "includes/function/";
   $css  = "layout/css/";
   $js   = "layout/js/";
   

  //Includes The Important File
   include $func . 'functions.php';
   include $lang .'english.php';
   include $tpl . 'header.php'; 

  //Include Navbar On All PagesvExpect the one with $noNavbar  variable
   if(!isset($noNavbar)){  include $tpl . 'navbar.php';}
      
      

  
   
   