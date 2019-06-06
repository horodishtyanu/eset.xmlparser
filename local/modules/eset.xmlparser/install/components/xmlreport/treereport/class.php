<?php
use Bitrix\Main\Loader;
use Bitrix\Main\SystemException;


/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 5:15
 */
class treereportComponents extends CBitrixComponent{


   protected function constructReport(){
        $vendor = \Eset\Xmlparser\Model\VendorTable::getByPrimary(1, ['select'=>['*', 'PROGRAMS']])->fetchObject();
        if ($vendor == null){
            $this->arResult = "База данных пуста, нечего показывать!";
            return;
        }
        $res['VENDOR_NAME'] = $vendor->getName();
        $res['VENDOR_COUNT'] = $vendor->getCount();
        $programs = $vendor->getPrograms(['select' => ['*', 'VERSIONS']]);
        foreach ($programs as $program){
            $resP[]['NAME'] = $program->getName();
            $resP[]['COUNT'] = $program->getCount();
            $resP[]['VERSIONS'] = $program->getVersions();
        }
        $res['VENDOR_PROGRAMS'] = $resP;
        $this->arResult = $res;
   }

    protected function checkModules()
    {
        if (!Loader::includeModule('iblock'))
            throw new SystemException("Модуль ESET не подключен!");
    }

    public function executeComponent()
    {
        $this->constructReport();
        $this->checkModules();
        $this->includeComponentTemplate();
    }
}