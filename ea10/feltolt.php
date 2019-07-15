<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

    include_once 'inc/head.php';
?>
<script src="uploadify/js/jquery.uploadify.js"></script>
<script type="text/javascript">
    jQuery().ready(
        function() {
            $("#fileupload").fileUpload(
                {
                    'uploader': 'uploadify/uploadify/uploader.swf',
                    'script': 'uploadify/uploadify/upload.php',
                    'cancelImg' : 'uploadify/uploadify/cancel.png',
                    'multi' : false,
                    'folder': 'uploadify/files',
                    'buttonText': 'Fajl valasztas'

                }
            )
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
    <div id="fileupload"></div>
    <a href="javascript:$('#fileupload').fileUploadStart()">tolhatod</a>

</div>
<?php
    include_once 'inc/footer.php';
?>