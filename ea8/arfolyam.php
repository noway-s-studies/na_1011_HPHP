<?php
    include_once 'inc/init.php';

    // ide jon a jogosultsagkezeles (lapszintu)
    // validalas

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

    $client= new SoapClient("http://www.mnb.hu/arfolyamok.asmx?WSDL",
            array(
                "trace"=>1,
                "exceptions"=>0,
                "cache_wsdl"=>0
            )
    );
    //print_r($client->GetCurrencies());
    print_r($client->GetCurrencies()->GetCurrenciesResult);

?>
</div>
<?php
    include_once 'inc/footer.php';
?>