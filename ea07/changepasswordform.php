<?php

  include_once 'inc/init.php';
  
  usleep(500000);
  
  if(isset($_SESSION["user"])) {
    $isposted = isset($_POST["oldpassword"]);
    if($isposted) {
        User::ChangePasswordForm(true, $_POST["oldpassword"], $_POST["password"], $_POST["password2"]);
    } else User::ChangePasswordForm();
  }
  

  
  
