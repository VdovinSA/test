<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arComponentDescription = array(
    "NAME"			=> GetMessage("MY_CURRENT_SHOW_RATES_COMPONENT_NAME"),
    "DESCRIPTION"	=> GetMessage("MY_CURRENT_SHOW_RATES_COMPONENT_DESCRIPTION"),
    "CACHE_PATH" => "Y",
    "PATH" => array(
        "ID" => "lib",
        "CHILD" => array(
            "ID" => "myCurrentRates",
            "NAME" => GetMessage("MY_CURRENT_GROUP_NAME"),
        ),
    ),
);
?>