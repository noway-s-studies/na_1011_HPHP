<?php
    include_once '../inc/dbconn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="master.css">
    <title>Document</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript">
        $( function() {
            $( "#cikkek" ).accordion();
        } );
    </script>
</head>
<body>
    <div id="cikkek">
        <?php
            $sql = "select * from Forum ORDER BY ForumID DESC";
            $sql_result = mysqli_query($db_connect, $sql);
            while($row=mysqli_fetch_assoc($sql_result)){
                print '<a>'.$row['ForumID'].'. '.$row['User'].'</a>';
                print "<div>".$row['Uzenet']."</div>";
            }
        ?>
    </div>
</body>
</html>