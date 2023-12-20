<?php
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'lib\MyHelper' => '/local/php_interface/lib/MyHelper.php',
]);

const MY_DELIVERY=3;
const MY_POINT_ADDRESS='Орел, Кромское шоссе, 4';

\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnOrderNewSendEmail',
    'OrderNewSendEmailMyHandler'
);
function OrderNewSendEmailMyHandler($orderID, &$eventName, &$arFields){
    \Bitrix\Main\Loader::IncludeModule('sale');
    $order = \Bitrix\Sale\Order::load($orderID);
    $deliveryIds = $order->getDeliverySystemId();
    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/test.txt',print_r([$arFields,$eventName,$orderID],1));
    if(in_array(MY_DELIVERY,$deliveryIds)){
        $arFields["MY_POINT_ADDRESS"] = 'Способ доставки: Самовывоз Адрес доставки: '.MY_POINT_ADDRESS;
    }else{
        $arFields["MY_POINT_ADDRESS"] = '';
    }
}

\Bitrix\Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleStatusOrderChange',
    'OnSaleStatusOrderChangeMyHandler'
);
function OnSaleStatusOrderChangeMyHandler ( \Bitrix\Main\Event $event )
{
    $status = $event->getParameter("VALUE");
    /**
     * @var \Bitrix\Sale\Order $order
     */
    $order = $event->getParameter("ENTITY");
    $userID = $order->getUserId();
    $arPersonalFields = array(
        'PERSONAL_COUNTRY' => 0,
        'PERSONAL_CITY' => '',
        'PERSONAL_STREET' => '',
        'PERSONAL_STATE' => '',
        'PERSONAL_ZIP' => '',
        'PERSONAL_NOTES' => '',
        'PERSONAL_MAILBOX' => '',
    );

    if($status=='F'){
        $user = new CUser;
        $user->Update($userID,$arPersonalFields);
        lib\MyHelper::showArguments($user->LAST_ERROR);
    }
}

?>