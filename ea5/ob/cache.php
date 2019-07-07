<?php
  $cache_time=10; // sec
  $cache_folder="cache/";
  $uri=basename($_SERVER["REQUEST_URI"]);
  //print $uri;
  $cache_filename=$cache_folder.md5($uri).".cache";
  if(file_exists($cache_filename))
      $cache_created=filemtime($cache_filename);
  else $cache_created=0;
  if(time()-$cache_created<=$cache_time) {
      // felolvasom, mert abban van az anyag
      readfile($cache_filename);
      exit();
  }
  ob_start();
  // -----------------------------------------------------

  // ide jon a szokasos oldal
  print date("Y-m-d  H:i:s",strtotime("now"));
  print "<br>";
  print date("Y-m-d  H:i:s");


  // -----------------------------------------------------
  $c=ob_get_contents();
  file_put_contents($cache_filename, $c);
  ob_end_flush();
?>
