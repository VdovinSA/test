<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)  die();

use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use Bitrix\Main\XML;
use Bitrix\Main\Web\HttpClient;
use Bitrix\Main\Application;
class CMyCurrentRates extends CBitrixComponent
{
    protected function MyCurrentRate()
    {
        $http = new HttpClient();
        $xml = new CDataXML();
        $document_root= Application::getDocumentRoot();
        $arCurrentRates = lib\MyHelper::myGetCurrentRates($http,$xml,$document_root);
        foreach ($arCurrentRates as $val) {
            if(in_array($val['CharCode'],$this->arParams['RATE_LIST']))
            $rates[$val['CharCode']] = array(
                'NAME' => $val['Name'],
                'CODE' => $val['CharCode'],
                'VALUE' => str_replace(',', '.', $val['Value']),
            );
        }
        return $rates;
    }

    public function executeComponent()
    {
        try
        {
            if($this->startResultCache())
            {
                $this->arResult['CURRENT_RATES']=$this->MyCurrentRate();
                $this->includeComponentTemplate();
            }
        }
        catch(SystemException $e)
        {
            ShowError($e->getMessage());
        }
    }
}