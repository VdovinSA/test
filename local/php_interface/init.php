<?php
Bitrix\Main\Loader::registerAutoLoadClasses(null, [
    'lib\MyHelper' => '/local/php_interface/lib/MyHelper.php',
]);

const MY_DELIVERY=3;
const MY_POINT_ADDRESS='Орел, Кромское шоссе, 4';

AddEventHandler("sale", "OnOrderNewSendEmail", "OrderNewSendEmailMyHandler");
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

//AddEventHandler( "sale" , "OnSaleStatusOrderChange" , "OnSaleStatusOrderChangeMyHandler" );
function OnSaleStatusOrderChangeMyHandler ( \Bitrix\Main\Event $event )
{
    $status = $event->getParameter("VALUE");
    /**
     * @var \Bitrix\Sale\Order $order
     */
    $order = $event->getParameter("ENTITY");
    $userID = $order->getUserId();
    if($status=='F'){

    }
    lib\MyHelper::showArguments($event->getParameters());
    die('121342');
    if (! $order ->isPaid() or $order ->isPaid()== false ) return ; // Обрабатываем только оплаченные заказы
    //Тут происходит какая то логика для оплаченного заказа
    //ID заказа: $order->getId()
    //ID пользователя: $order->getUserId()
    //Сумма заказа: $order->getPrice()
    //Размер скидки: $order->getDiscountPrice()
    //Стоимость доставки: $order->getDeliveryPrice()
    //Оплаченная сумма: $order->getSumPaid()
    //Сумма заказа: $order->getPrice()
}

?>