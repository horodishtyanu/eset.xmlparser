<?php
namespace Eset\Xmlparser\Controller;

use Bitrix\Main\DB\Exception;
use Eset\Xmlparser\Model\CounterTable;
use Eset\Xmlparser\Model\ProgramTable;
use Eset\Xmlparser\Model\VendorTable;
use Eset\Xmlparser\Model\VersionTable;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

class File
{
    public static function addXmlFile($data){
        $arResult = [];
        foreach ($data->software->SoftwareProduct as $product){
            $vendor_name = (string)$product['Publisher'] == null ? 'Неопознанный производитель' : (string)$product['Publisher'];
            $program_name = (string)$product['Name'] == null ? 'Неопознанное ПО' : (string)$product['Name'];
            $version = (string)$product['Version'] == null ? '---' : (string)$product['Version'];

            $result['VENDOR_ID'] = $vendor_id = self::addVendor($vendor_name);
            $result['PROGRAM_ID'] = $program_id = self::addProgram($program_name,$vendor_id);
            $result['VERSION_ID'] = self::addVersion($version, $program_id);

            self::setRelations($result);



            $arResult[] = $result;

        }
        self::updateCounter();
        return $arResult;
    }

    public static function addVendor($vendor_name){
        $dbVendor = VendorTable::getList(['filter' => ['NAME' => $vendor_name]])->fetchObject();
        if ($dbVendor == null){
            $vendorId = VendorTable::add(['NAME' => $vendor_name, 'COUNT' => '1'])->getId();
            return $vendorId;
        }
        else{
            $c = $dbVendor->getCount();
            $c++;
            $dbVendor->setCount($c);
            $dbVendor->save();
            return $dbVendor->getID();
        }
    }
    public static function addProgram($program_name, $vendorId){
        $dbProgram = ProgramTable::getList(['filter' => ['NAME' => $program_name, 'VENDOR_ID' => $vendorId]])->fetchObject();
        if ($dbProgram == null){
            $programId = ProgramTable::add(['NAME' => $program_name, 'COUNT' => '1'])->getId();
            return $programId;
        }
        else{
            $c = $dbProgram->getCount();
            $c++;
            $dbProgram->setCount($c);
            $dbProgram->save();
            return $dbProgram->getId();
        }
    }
    public static function addVersion($version, $programId){
        $dbVersion = VersionTable::getList(['filter' => ['NAME' => $version, 'PROGRAM_ID' => $programId]])->fetchObject();
        if ($dbVersion == null){
            $versionId = VersionTable::add(['NAME' => $version, 'COUNT' => '1'])->getId();
            return $versionId;
        }
        else{
            $c = $dbVersion->getCount();
            $c++;
            $dbVersion->setCount($c);
            $dbVersion->save();
            return $dbVersion->getId();
        }
    }
    public static function setRelations($result){
        try {
            $oVendor = VendorTable::getByPrimary($result['VENDOR_ID'])->fetchObject();
            $oProgram = ProgramTable::getByPrimary($result['PROGRAM_ID'])->fetchObject();
            $oVersion = VersionTable::getByPrimary($result['VERSION_ID'])->fetchObject();

            $oProgram->addToVersions($oVersion);
            $oProgram->save();

            $oVendor->addToPrograms($oProgram);
            $oVendor->save();
        }catch (\Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }
    public static function updateCounter(){
        $dbCounter = CounterTable::getByPrimary(1)->fetchObject();
        $amount = $dbCounter->getAmount();
        $amount++;
        $dbCounter->setAmount($amount);
        $dbCounter->save();
    }
}
