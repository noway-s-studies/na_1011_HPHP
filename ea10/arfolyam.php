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

    print_r($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);

    require_once 'XML/Parser.php';
    class SajatParser extends XML_Parser {
        private $Penz;
        public $EUR;
        function SajatParser()
        {
            parent::XML_Parser();
        }
        function startHandler($xp,$name,$attribs) {
            $this->Penz=$attribs["CURR"];
            print "Start Name: $name<br>";
            print "&nbsp;";
            foreach ($attribs as $key => $value) {
                print $key."=".$value."  ";
            }
            print "<br>";
        }
        function endHandler($xp,$name) {
            print "End Name: $name<br>";
        }
        function cdataHandler($xp,$cdata) {
            print "&nbsp;&nbsp;&nbsp;CDATA: $cdata<br>";
            if($this->Penz=="EUR") $this->EUR=$cdata;
        }
    }
    $p=new SajatParser();
    $result=$p->setInputString($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);
    $p->parse();
    print "EUR=".$p->EUR;

    // adatabazis, tabla: Arfolyam: id,ft,datum(ev,honap,nap)
    // crontab: getarfolyam.php
    // 7-10

    $xml=simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);
    foreach ($xml->Day->Rate as $rate) {
        $a=$rate->attributes();
        print_r($rate);
        print "<br>";
        print_r($a);
        print "<br>";
    }

    // XPath
    print "<hr>";
    $xml=simplexml_load_string($client->GetCurrentExchangeRates()->GetCurrentExchangeRatesResult);
    $find=$xml->xpath("/MNBCurrentExchangeRates/Day/Rate[@curr='EUR']");
    print_r($find)



?>
</div>
<?php
    include_once 'inc/footer.php';
?>