<?php
namespace Eset\Xmlparser\Model;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Query\Join;

Loc::loadMessages(__FILE__);

class ProgramTable extends DataManager
{

    private $vendor;

    public static function getTableName()
    {
        return 'xml_program_table';
    }

    public static function getMap()
    {
        return array(
            new Entity\IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new Entity\StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('NAME'),
                'default_value' => function () {
                    return Loc::getMessage('NAME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Entity\Validator\Length(null, 255),
                    );
                },
            )),
            new Entity\StringField('COUNT', array(
                'required' => true,
            )),
            new IntegerField('VENDOR_ID'),
            new Reference(
                    'VENDOR',
                    VendorTable::class,
                    Join::on('this.VENDOR_ID', 'ref.ID')
                ),

            new OneToMany('VERSIONS', VersionTable::class, 'PROGRAM')
        );
    }

    /**
     * @return mixed
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param mixed $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }


}
