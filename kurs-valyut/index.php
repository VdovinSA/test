<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Курс Валют");
?><pre><?$APPLICATION->IncludeComponent(
	"mycurrentrates", 
	".default", 
	array(
		"CACHE_TIME" => "86400",
		"CACHE_TYPE" => "A",
		"RATE_LIST" => array(
			0 => "QAR",
			1 => "KGS",
			2 => "CNY",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?></pre><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>