<?php
namespace Eset\Xmlparser\Model;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;

Loc::loadMessages(__FILE__);

class VendorTable extends DataManager
{
    public static function getTableName()
    {
        return 'xml_vendor_table';
    }

    private $name;

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
            new OneToMany('PROGRAMS', ProgramTable::class, 'VENDOR')

        );
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}
