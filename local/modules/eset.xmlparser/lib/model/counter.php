<?php
namespace Eset\Xmlparser\Model;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;

Loc::loadMessages(__FILE__);

class CounterTable extends DataManager
{
    public static function getTableName()
    {
        return 'xml_counter_table';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new Entity\StringField('AMOUNT', array())
        );
    }




}
