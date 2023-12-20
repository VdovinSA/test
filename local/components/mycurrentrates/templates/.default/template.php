<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<table class="current-tbl">
    <?foreach ($arResult["CURRENT_RATES"] as $key => $currentRate):?>
        <tr>
            <td><?=$key?></td>
            <td><?=$currentRate["NAME"]?></td>
            <td><?=$currentRate["VALUE"]?></td>
        </tr>
    <?endforeach?>
</table>