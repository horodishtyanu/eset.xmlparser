<?php
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;
use Bitrix\Main\Engine\Contract\Controllerable;


/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 5:04
 */
class xmluploadComponents extends CBitrixComponent implements Controllerable {

    public function configureActions()
    {
        return [
            'uploadFile' => ['prefilters' => []]
        ];
    }

    protected function getResult(){
        $arResult['test'] = 'asdasd';
        $this->arResult = $arResult;
    }

    public function uploadFilesAction($file){
        CModule::IncludeModule('eset.xmlparser');
        if ( 0 < $file['file']['error'] ) {
            return 'Error: ' . $file['file']['error'] . '<br>';
        }
        else {
            move_uploaded_file($file['file']['tmp_name'], $_SERVER["DOCUMENT_ROOT"] . '/upload/' . $file['file']['name']);
            return \Eset\Xmlparser\Controller\File::addXmlFile(simplexml_load_file($_SERVER["DOCUMENT_ROOT"] . '/upload/' . $file['file']['name']));
        }
    }

    protected function checkModules()
    {
        if (!Loader::includeModule('iblock'))
            throw new SystemException("Модуль ESET не подключен!");
    }

    public function executeComponent()
    {
        $this->checkModules();
        $this->getResult();
        $this->includeComponentTemplate();
    }
}