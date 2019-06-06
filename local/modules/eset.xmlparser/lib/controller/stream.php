<?php
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 06.06.2019
 * Time: 18:49
 */
namespace Eset\Xmlparser\Controller;

use Bitrix\Main\DB\Exception;

class Stream extends File
{
    public static function loadStream($stream){
        $data = simplexml_load_string($stream);
        if ($data !== null){
            return self::addXmlFile($data);
        }
        else{
            throw new Exception("Неверный формат файла!");
        }
    }
}