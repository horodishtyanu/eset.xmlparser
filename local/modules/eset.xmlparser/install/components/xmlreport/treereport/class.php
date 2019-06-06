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
        $vendors = \Eset\Xmlparser\Model\VendorTable::getList(['select'=>['*', 'PROGRAMS']])->fetchCollection();
        if ($vendors == null){
            $this->arResult = "База данных пуста, нечего показывать!";
            return;
        }
        $res = [];
        $l = 0;
        foreach ($vendors as $vendor){
            $res[$l]['VENDOR_NAME'] = $vendor['NAME'];
            $res[$l]['VENDOR_COUNT'] = $vendor['COUNT'];
            $programs = $vendor->getPrograms(['select' => ['*', 'VERSIONS']]);
            $i = 0;
            $resP =[];
            foreach ($programs as $program){
                $resP[$i]['NAME'] = $program->getName();
                $resP[$i]['COUNT'] = $program->getCount();
                $resP[$i]['VERSIONS'] = \Eset\Xmlparser\Model\VersionTable::getList(['select'=>['*'], 'filter'=>['PROGRAM_ID' => $program->getId()]])->fetchAll();
                $i++;
            }
            $res[$l]['VENDOR_PROGRAMS'] = $resP;
            $l++;
        }

        $allAmount = \Eset\Xmlparser\Model\CounterTable::getByPrimary(1,['select' => ['*']])->fetchObject()->getAmount();

        $this->arResult['VENDORS'] = $res;
        $this->arResult['ALL_AMOUNT'] = $allAmount;
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