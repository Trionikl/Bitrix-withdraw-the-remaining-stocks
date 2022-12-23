<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('catalog');

//получить товар на складе
$rsStoreProduct = \Bitrix\Catalog\StoreProductTable::getList(array(
    'filter' => array(),
    'select' => array('STORE_ID', 'PRODUCT_ID', 'STORE_TITLE' => 'STORE.TITLE', 'PRODUCT_NAME' => 'PRODUCT.IBLOCK_ELEMENT.NAME', 'TRADE_OFFER' => 'PRODUCT.IBLOCK_ELEMENT.ID', 'AMOUNT'),
));
while($arStoreProduct=$rsStoreProduct->fetch())
{
    $warehouse[] = $arStoreProduct;
}
?>
<h2>Остатки товара на складах</h2>
<table border = "1">
    <tr>
        <th>Название товара</th>
        <th>Склад</th>
        <th>Количество на складе</th>
    </tr>
    <?php
    foreach ($warehouse as $key => $value) {
     ?>
        <tr>
            <td><?=$value['PRODUCT_NAME'] . ", торговое предложение: " . $value['TRADE_OFFER']?></td>
            <td><?=$value['STORE_TITLE']?></td>
            <td><?=$value['AMOUNT']?></td>
        </tr>
        <?php
    } //end foreach ($warehouse as $key => $value) {
    ?>
</table>