<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\XML;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Application;

$http = new HttpClient();
$xml = new CDataXML();
$document_root= Application::getDocumentRoot();

$arCurrentRates = lib\MyHelper::myGetCurrentRates($http,$xml,$document_root);
$ratesList = lib\MyHelper::myRatesList($arCurrentRates);

$arComponentParameters = array(
    "PARAMETERS" => array(
        "RATE_LIST" => array(
            "NAME" => GetMessage("MY_CURRENCY_FROM"),
            "TYPE" => "LIST",
            "MULTIPLE" => "Y",
            "ADDITIONAL_VALUES" => "N",
            "VALUES" => $ratesList,
            "GROUP" => "BASE",
        ),
        "CACHE_TYPE" => array(),
        "CACHE_TIME" => array("DEFAULT" => "86400"),
    ),
);
?>
