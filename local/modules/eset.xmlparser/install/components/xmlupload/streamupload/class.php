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
class xmlstreamComponents extends CBitrixComponent implements Controllerable {

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

    public function uploadStreamAction($stream){
        CModule::IncludeModule('eset.xmlparser');
        return \Eset\Xmlparser\Controller\Stream::loadStream($stream);
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