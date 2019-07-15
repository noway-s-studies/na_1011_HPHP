<?php
    include_once 'inc/dbconn.php';
    $sql = "select * from Forum";
    $sql_result = mysqli_query($db_connect, $sql);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../ea1/master.css">
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
<form action="kuldes.php" method="post">
    <table>
        <tr>
            <td>Nicknév</td>
            <td><input type="text" name="nick" id="nick"></td>
        </tr>
        <tr>
            <td>Üzenet</td>
            <td><textarea name="uzenet" id="uzenet" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Elküld" name="elkuld"></td>
        </tr>
    </table>
</form>

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