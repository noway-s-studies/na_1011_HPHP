    <form method="get" action="sqlinject.php">
    <div>
        <div id="rendelesek" style="float: left;">
            
        </div>
        <div>
            <div style="margin-left: 300px">
                <input type="text" name="param" style='width: 700px' />
                <input type="submit" value="Send" />
                <br />
                <div id="resdiv">
                </div>
            </div>
        </div>
    </div>
    </form>

<?php

  $param=trim($_GET["param"]);
  
  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = '';
  $dbname = 'webshop';
  $conn=mysql_connect($dbhost,$dbuser,$dbpass);
  if(!$conn) die("MySQL connect error: ".mysql_error());
  mysql_select_db($dbname) or die("Database connect error: ".mysql_error()); 
  mysql_query('SET NAMES utf8');

  $param=mysql_real_escape_string($param);

  if(strlen($param)>0) {
    $sql="SELECT id,nev,kep FROM termekek WHERE id IN (".$param.")";
    print $sql;
    $sqlresult=mysql_query($sql);
    $html="<table border=1>";
    while($row=mysql_fetch_row($sqlresult)) {
      $html.="<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
    }
    $html.="</table>";
    print $html;
  }
  
?>


