<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Eset\Xmlparser\Model;



if (class_exists('Eset_Xmlparser')) {
    return;
}


Loc::loadMessages(__FILE__);

class Eset_Xmlparser extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;


    public function __construct()
    {
        $this->MODULE_ID = 'eset.xmlparser';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2019-06-05 0:23:14';
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Eset";
        $this->PARTNER_URI = "http://www.eset.ru";
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
//        $this->installDB();
        $this->installFiles();
    }

    public function doUninstall()
    {
//        $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            Model\VendorTable::getEntity()->createDbTable();
            Model\ProgramTable::getEntity()->createDbTable();
            Model\VersionTable::getEntity()->createDbTable();
            Model\CounterTable::getEntity()->createDbTable();
        }
        try {
            Model\CounterTable::add(['ID' => 1, 'AMOUNT' => 0]);
        }catch (\Exception $exception){
            throw new Exception($exception->getMessage());
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(Model\VendorTable::getTableName());
            $connection->dropTable(Model\ProgramTable::getTableName());
            $connection->dropTable(Model\VersionTable::getTableName());
            $connection->dropTable(Model\CounterTable::getTableName());
        }
    }

    public function installFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/eset.xmlparser/install/components", $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
    }
}
