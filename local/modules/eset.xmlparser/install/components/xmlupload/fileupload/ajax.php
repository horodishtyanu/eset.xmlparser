<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CBitrixComponent::includeComponentClass("xmlupload:fileupload");
$cl = new xmluploadComponents();
$cl->uploadFilesAction($_FILES);
print_r($cl->uploadFilesAction($_FILES));
exit;