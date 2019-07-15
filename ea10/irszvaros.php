<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    include_once 'inc/head.php';
?>
<script type="text/javascript">
    function letolt() {
        var o = new Object();
        o.irsz=$("#irsz").val();
        $.post("ajaxirszvaros.php",o,
            function(data) {
                //alert(data);
                $("#varos").val(data);
            }
        );
    }

    jQuery().ready(
        function() {
            $("#irsz").numeric(true);
            $("#irsz").blur(
                function() {
                    //alert('mi van elhagytal?');
                    var irsz=$("#irsz").val();
                    if(irsz.length==4)
                        letolt();
                    else $("#varos").val('hibas irsz');
                }
            );
        }
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
    Irsz:<input type="text" id="irsz" name="irsz" /><br />
    Város:<input type="text" id="varos" name="varos" /><br />
    <input type="button" onclick="letolt()" value="Mehet" />
</div>
<?php
    include_once 'inc/footer.php';
?>