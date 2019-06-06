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
//        $vendor = VendorTable::getList(['select' => ['*', 'PROGRAMS'], 'filter' => ['ID' => '1']])->fetchObject();
//        $i = 0;
//
//        $arRes['VNAME'] = $vendor->getName();
//        $arRes['ID'] = $vendor->getID();
//        foreach ($vendor->getPrograms() as $prog) {
//            $l = 0;
//            $arRes['PROGS'][$i]['PROG_ID'] = $prog->getID();
//            $arRes['PROGS'][$i]['PROG_NAME'] = $prog->getName();
//            foreach ($prog['VERSIONS'] as $ver) {
//                $arRes['PROGS'][$i]['VERSIONS'][$l] = $ver->getName();
//                $l++;
//            }
//            $i++;
//        }
        $arResult['test'] = 'asdasd';
        $this->arResult = $arResult;
    }

    public function uploadFilesAction($post){
        if ( 0 < $post['file']['error'] ) {
            return 'Error: ' . $post['file']['error'] . '<br>';
        }
        else {
            move_uploaded_file($post['file']['tmp_name'], '/upload/' . $post['file']['name']);
            return simplexml_load_file('/upload/' . $post['file']['name']);
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