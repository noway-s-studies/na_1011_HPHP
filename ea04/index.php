<?php
    include_once 'inc/init.php';
    include_once 'inc/head.php';
?>
<script type="text/javascript">
    jQuery().ready(
        function() { }
    )
</script>
<title>blogmotor</title>
<?php
    include_once 'inc/header.php';
    include_once 'inc/menu.php';
?>
<div id="middle">
    <?php
        show_uzenet();
        // ide jon a kod
    ?>
</div>
<?php
    include_once 'inc/footer.php';
?>