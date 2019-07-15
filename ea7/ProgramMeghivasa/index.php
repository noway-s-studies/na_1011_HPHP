<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        
            // exec("notepad.exe");
            exec("dir c:\\", $lines);
            //print_r($lines);
            
            print "<table border=1>";
            foreach ($lines as $value) {
                print "<tr>";
                print "<td>$value</td>";
                print "</tr>";
            }
            
            print "</table>";
        
        ?>
    </body>
</html>
