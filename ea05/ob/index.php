<?php

print "ob elott\n";

ob_start();

print "ob start utan 1\n";
$c=ob_get_contents();
file_put_contents("1.txt", $c);

print "ob start utan 2\n";
$c=ob_get_contents();
file_put_contents("2.txt", $c);

print "ob start utan 3\n";
$c=ob_get_clean();
file_put_contents("3.txt", $c);

ob_start();
print "ujravan kezdve ob start utan 4\n";
$c=ob_get_clean();
file_put_contents("4.txt", $c);


ob_end_flush();

?>
