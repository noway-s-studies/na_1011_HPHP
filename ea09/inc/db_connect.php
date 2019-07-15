<?php

  require_once('Doctrine.php');
  spl_autoload_register(array('Doctrine', 'autoload'));
  spl_autoload_register(array('Doctrine_Core', 'modelsAutoload'));
  $manager = Doctrine_Manager::getInstance();
  $manager->setAttribute(Doctrine_Core::ATTR_MODEL_LOADING, Doctrine_Core::MODEL_LOADING_CONSERVATIVE);
  $conn = Doctrine_Manager::connection("$dbengine://$dbuser:$dbpass@$dbhost/$dbname",'blogconn');
  // echo Doctrine_Core::getPath();

  $stmt = $conn->prepare('SET NAMES UTF8;');
  $stmt->execute();

  Doctrine_Core::loadModels('models');

  function add_log($event,$details) {
      if(@getenv("HTTP_X_FORWARDED_FOR"))
          $ipcim=@getenv("HTTP_X_FORWARDED_FOR");
      else
          $ipcim=@getenv("REMOTE_ADDR");
      global $glob_usernev;
      // $hostname=gethostbyaddr($ipcim);
      $log=new Log();
      $log->event=$event;
      $log->username=$glob_usernev;
      $log->details=$details;
      $log->ip=$ipcim;
      $log->datum=date("Y-m-d H:i:s");
      $log->save();
  }


?>