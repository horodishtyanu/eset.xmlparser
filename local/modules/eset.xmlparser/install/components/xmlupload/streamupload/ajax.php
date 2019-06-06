<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 18:32
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CBitrixComponent::includeComponentClass("xmlupload:streamupload");
$class = new xmlstreamComponents();
print_r($class->uploadStreamAction($_POST['streamXml']));
exit;