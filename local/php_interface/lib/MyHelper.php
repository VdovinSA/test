<?php
namespace lib;
class MyHelper
{
     public static function wordsDeclension($value,$words,$show = true){
        $num = $value % 100;
        if ($num > 19) {
            $num = $num % 10;
        }

        $out = ($show) ?  $value . ' ' : '';
        switch ($num) {
            case 1:  $out .= $words[0]; break;
            case 2:
            case 3:
            case 4:  $out .= $words[1]; break;
            default: $out .= $words[2]; break;
        }

        return $out;
    }

    public static function showArguments($str){
        echo '<pre>';
        print_r($str);
        echo'</pre>';
    }


    public static function myGetCurrentRates($httpClient,$xml,$document_root)
    {
        $httpClient->setHeader('Content-Type', 'application/xml; charset=UTF-8', true);
        $httpClient->query("GET", "https://www.cbr.ru/scripts/XML_daily.asp?d=0", $entityBody = null);
        $status=$httpClient->getStatus();
        if($status==200)
        {
            $XML_file=$httpClient->getResult();
            file_put_contents($document_root.'/local/components/mycurrentrates/MyCurrentRates.XML',$XML_file);
        }else{
            $XML_file=file_get_contents('./MyCurrentRates.XML');
        }
        $xml->LoadString($XML_file);
        $arCurrentRates = [];
        $node = $xml->GetArray();
        $Value = $xml->SelectNodes('/ValCurs/Valute/CharCode');
        if ($node = $xml->SelectNodes('/ValCurs')) {
            foreach ($node->children() as $arTabNode) {
                $id = $arTabNode->getAttribute('ID');
                foreach ($arTabNode->children() as $el) {
                    $arCurrentRates[$id][$el->name()] = iconv("windows-1251", "UTF-8", $el->textContent());
                }
            }
        }
        return $arCurrentRates;
    }

    public static function myRatesList($arCurrentRates)
    {
        $ratesList=[];
        foreach ($arCurrentRates as $val) {
            $ratesList[$val['CharCode']] = $val['Name'];
        }
        return $ratesList;
    }
}
